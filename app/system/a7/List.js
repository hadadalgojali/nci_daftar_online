Ext.define('App.system.a7.List',{
	extend:'App.cmp.Table',
	id:'a7.list',
	params:function(){
		return Ext.getCmp('a7.search.panel').qParams();
	},
	url:url + 'app/a7/getList',
	result:function(response){
		if(session.tenant == null)
			Ext.getCmp('a7.list').columns[1].setVisible(true);
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
		            text: 'Add User',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a7.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/a7/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a7.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a7.input.panel').qReset();
									Ext.getCmp('a7.input.role').addReset(r.data.roleList);
									Ext.getCmp('a7.input.userCode').enable();
									Ext.getCmp('a7.input.password').enable();
									Ext.getCmp('a7.input.retryPassword').enable();
									Ext.getCmp('a7.input.role').enable();
									Ext.getCmp('a7.input.employee').enable();
									Ext.getCmp('a7.input.activeFlag').enable();
									Ext.getCmp('a7.input.activeFlag').setValue(true);
									Ext.getCmp('a7.input.pageType').setValue('ADD');
									Ext.getCmp('a7.input').closing = false;
									Ext.getCmp('a7.input.activeFlag').enable();
									Ext.getCmp('a7.input').show();
									Ext.getCmp('a7.input').setTitle('User - Add');
									if(r.data.tenantList != undefined){
										Ext.getCmp('a7.label.tenant').show();
										r.data.tenantList.unshift ({id:'',text:'Owner'});
										Ext.getCmp('a7.input.tenant').addReset(r.data.tenantList);
										Ext.getCmp('a7.input.tenant').setValue('');
										Ext.getCmp('a7.input.tenant').enable();
										Ext.getCmp('a7.input.tenant').focus();
									}else{
										Ext.getCmp('a7.input.tenant').setValue(session.tenant);
										Ext.getCmp('a7.label.tenant').hide();
										Ext.getCmp('a7.input.userCode').focus();
									}
									Ext.getCmp('a7.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a7.list').setLoading(false);
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
		            	Ext.getCmp('a7.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a7.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/a7/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a7.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a7.search.f7').addReset(r.data.l);
									Ext.getCmp('a7.search').show();
									Ext.getCmp('a7.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a7.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    }]
		}) 
	],
	columns:[
		{ xtype: 'rownumberer'},
		{ text: 'Tenant',width: 150,hideable:false,sortable :false,hidden:true, dataIndex: 't' },
		{ hidden:true,hideable:false,dataIndex: 'pid' },
		{ text: 'User Code',width: 100, dataIndex: 'user_code' },
		{ text: 'ID Number',width: 100, dataIndex: 'id_number' },
		{ text: 'Name',width: 150,dataIndex: 'name'},
		{ text: 'Role',width: 100,align:'center',dataIndex: 'role'},
		{ text: 'Birth Date',width: 100, align:'center',dataIndex: 'birthDate' },
		{ text: 'Active',width: 50,sortable :false,dataIndex: 'active_flag',align:'center',
			renderer: function(value){
				if(value==true)
					return '<img src="' + icon('t') + '" style="margin: -5px;" />';
				else
					return '<img src="' + icon('f') + '" style="margin: -5px;" />';
			}
		},{
			text: 'Update',
			width: 50,
			hideable:false,
			menuDisabled: true,
			xtype: 'actioncolumn',
			tooltip:'<b>Update</b>/Ubah',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a7.list').setLoading('Getting data User Code '+record.data.user_code);
				Ext.Ajax.request({
					url : url + 'app/a7/initUpdate',
					params:{pid:record.data.pid},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('a7.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.user;
							Ext.getCmp('a7.label.tenant').hide();
							Ext.getCmp('a7.input.panel').qReset();
							Ext.getCmp('a7.input.role').addReset(r.data.roleList);
							Ext.getCmp('a7.input.userCode').enable();
							Ext.getCmp('a7.input.userCode').setValue(o.userCode);
							Ext.getCmp('a7.input.role').setValue(o.role);
							Ext.getCmp('a7.input.role').enable();
							Ext.getCmp('a7.input.password').disable();
							Ext.getCmp('a7.input.retryPassword').disable();
							Ext.getCmp('a7.input.employee').setRawValue(o.employee);
							Ext.getCmp('a7.input.employee').disable()
							Ext.getCmp('a7.input.pid').setValue(record.data.pid);
							Ext.getCmp('a7.input.activeFlag').setValue(o.activeFlag);
							Ext.getCmp('a7.input.pageType').setValue('UPDATE');
							Ext.getCmp('a7.input.activeFlag').enable();
							Ext.getCmp('a7.input').closing = false;
							Ext.getCmp('a7.input').setTitle('User - Update');
							Ext.getCmp('a7.input').show();
							Ext.getCmp('a7.input.userCode').focus();
							Ext.getCmp('a7.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a7.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		},{
			text: 'Change Password',
			width: 100,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			tooltip:'<b>Change Password</b>/Ubah Password',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a7.list').setLoading('Getting data User Code '+record.data.user_code);
				Ext.Ajax.request({
					url : url + 'app/a7/initUpdate',
					params:{pid:record.data.pid},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('a7.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.user;
							Ext.getCmp('a7.label.tenant').hide();
							Ext.getCmp('a7.input.panel').qReset();
							Ext.getCmp('a7.input.role').addReset(r.data.roleList);
							Ext.getCmp('a7.input.userCode').disable();
							Ext.getCmp('a7.input.userCode').setValue(o.userCode);
							Ext.getCmp('a7.input.role').setValue(o.role);
							Ext.getCmp('a7.input.role').disable();
							Ext.getCmp('a7.input.password').enable();
							Ext.getCmp('a7.input.retryPassword').enable();
							Ext.getCmp('a7.input.employee').setRawValue(o.employee);
							Ext.getCmp('a7.input.employee').disable()
							Ext.getCmp('a7.input.pid').setValue(record.data.pid);
							Ext.getCmp('a7.input.activeFlag').disable();
							Ext.getCmp('a7.input.activeFlag').setValue(o.activeFlag);
							Ext.getCmp('a7.input.pageType').setValue('CHANGE');
							Ext.getCmp('a7.input').closing = false;
							Ext.getCmp('a7.input').setTitle('User - Change Password');
							Ext.getCmp('a7.input').show();
							Ext.getCmp('a7.input.password').focus();
							Ext.getCmp('a7.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a7.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		},{
			text: 'Delete',
			width: 50,
			hideable:false,
			menuDisabled: true,
			xtype: 'actioncolumn',
			tooltip:'<b>Delete</b>/Hapus',
			align: 'center',
			iconCls: 'i-del',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a7.confirm').confirm({
					msg : "Are you sure Delete data User Code '"+record.data.user_code+"' ?",
					allow : 'a7.delete',
					onY : function() {
						Ext.getCmp('a7.list').setLoading('Deleting Data User Code '+record.data.user_code);
						Ext.Ajax.request({
							url : url + 'app/a7/delete',
							method : 'POST',
							params : {
								pid : record.raw.pid
							},
							success : function(response) {
								Ext.getCmp('a7.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('a7.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a7.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			},
			isDisabled : function(view, rowIdx, colIdx, item, record) {
				if(record.data.user_code==session.userName)
					return true;
				else
					return false;
			}
		}
	]
});