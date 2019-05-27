Ext.define('App.system.a3.List',{
	extend:'App.cmp.Table',
	id:'a3.list',
	params:function(){
		return Ext.getCmp('a3.search.panel').qParams();
	},
	url:url + 'app/A3/getList',
	result:function(response){
		if(session.tenant == null)
			Ext.getCmp('a3.list').columns[1].setVisible(true);
		return {list:response.data,total:response.total};
	},
	tbar:[
		Ext.create('Ext.panel.Panel', {
		    flex: 1,
		    border:false,
		    tbar: [{
		        xtype: 'buttongroup',
		        columns: 3,
		        title: 'Menu',
		        items: [{
		            text: 'Add Role',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a3.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/A3/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a3.input.roleCode').enable();
									Ext.getCmp('a3.input.panel').qReset();
									Ext.getCmp('a3.input.pageType').setValue('ADD');
									Ext.getCmp('a3.input').closing = false;
									Ext.getCmp('a3.input').show();
									Ext.getCmp('a3.input').setTitle('Role - Add');
									if(r.data.tenantList != undefined){
										Ext.getCmp('a3.label.tenant').show();
										r.data.tenantList.unshift ({id:'',text:'Owner'});
										Ext.getCmp('a3.input.tenant').addReset(r.data.tenantList);
										Ext.getCmp('a3.input.tenant').setValue('');
										Ext.getCmp('a3.input.tenant').enable();
										Ext.getCmp('a3.input.tenant').focus();
									}else{
										Ext.getCmp('a3.input.tenant').setValue(session.tenant);
										Ext.getCmp('a3.label.tenant').hide();
										Ext.getCmp('a3.input.roleCode').focus();
									}
									Ext.getCmp('a3.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a3.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        },{
		            text: 'Refresh',
		            scale: 'large',
		            iconCls: 'i-refresh-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	Ext.getCmp('a3.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a3.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/a3/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a3.search.f4').addReset(r.data.l);
									Ext.getCmp('a3.search').show();
									Ext.getCmp('a3.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a3.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    }]
		})
	],
	columns:[
		{xtype: 'rownumberer'},
		{ text: 'Tenant',width: 150,hideable:false, sortable :false,hidden:true, dataIndex: 'tenant_name' },
		{ hidden:true, hideable:false,dataIndex: 'tenant_id' },
		{ hidden:true, hideable:false,dataIndex: 'id' },
		{ text: 'Role Code',width: 100, dataIndex: 'role_code'},
		{ text: 'Role Name',width: 150, dataIndex: 'role_name'},
		{ text: 'Description',width: 150,dataIndex: 'description', flex: 1 },
		{ text: 'Active',width: 50,sortable :false,dataIndex: 'active_flag',align:'center',
			renderer: function(value){
				if(value==true)
					return '<img src="' + icon('t') + '" style="margin: -5px;" />';
				else
					return '<img src="' + icon('f') + '" style="margin: -5px;" />';
			}
		},{
			text: 'Menu',
			width: 55,
			hideable:false,
			menuDisabled: true,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-menu',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a3.list').setLoading('Getting Data Role Menu Code '+record.data.role_code);
				Ext.getCmp('a3.inputMenu.id').setValue(record.raw.id);
				Ext.getCmp('a3.inputMenu.roleCode').setValue(record.raw.role_code);
				Ext.Ajax.request({
					url : url + 'app/A3/getForMenu',
					method : 'GET',
					params : {
						roleCode : record.raw.role_code,
						id : record.raw.id
					},
					success : function(response) {
						Ext.getCmp('a3.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var treeNode = Ext.getCmp('a3.input.tree').getRootNode();
							treeNode.removeAll();
							treeNode.expandChildren(true);
							treeNode.appendChild(r.data);
							Ext.getCmp('a3.inputMenu').show();
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a3.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		},{
			text: 'Update',
			width: 55,
			hideable:false,
			menuDisabled: true,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a3.list').setLoading('Getting Data Role Code '+record.data.role_code);
				Ext.Ajax.request({
					url : url + 'app/A3/initUpdate',
					method : 'GET',
					success : function(response) {
						Ext.getCmp('a3.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							Ext.getCmp('a3.label.tenant').hide();
							Ext.getCmp('a3.input.panel').qReset();
							Ext.getCmp('a3.input.roleCode').disable();
							Ext.getCmp('a3.input.pageType').setValue('UPDATE');
							Ext.getCmp('a3.input.id').setValue(record.data.id);
							Ext.getCmp('a3.input.roleCode').setValue(record.data.role_code);
							Ext.getCmp('a3.input.roleName').setValue(record.data.role_name);
							Ext.getCmp('a3.input.description').setValue(record.data.description);
							Ext.getCmp('a3.input.activeFlag').setValue(record.data.active_flag);
							Ext.getCmp('a3.input').show();
							Ext.getCmp('a3.input').setTitle('Role - Update');
							Ext.getCmp('a3.input').closing = false;
							Ext.getCmp('a3.input.roleName').focus();
							Ext.getCmp('a3.input.panel').qSetForm();
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a3.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		},{
			text: 'Delete',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-del',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a3.confirm').confirm({
					msg : "Are you sure Delete data Role Code '"+record.data.role_code+"' ?",
					allow : 'a3.delete',
					onY : function() {
						Ext.getCmp('a3.list').setLoading('Deleting data Role Code '+record.data.role_code);
						Ext.Ajax.request({
							url : url + 'app/A3/delete',
							method : 'POST',
							params : {
								pid : record.raw.id
							},
							success : function(response) {
								Ext.getCmp('a3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('a3.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('main.tabA3').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});