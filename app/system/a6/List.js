Ext.define('App.system.a6.List',{
	extend:'App.cmp.Table',
	id:'a6.list',
	params:function(){
		return Ext.getCmp('a6.search.panel').qParams();
	},
	url:url + 'app/a6/getList',
	result:function(response){
		if(session.tenant == null)
			Ext.getCmp('a6.list').columns[1].setVisible(true);
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
		            text: 'Add SysProp',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a6.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/a6/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a6.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a6.input.panel').qReset();
									Ext.getCmp('a6.input.f1').enable();
									Ext.getCmp('a6.input.p').setValue('ADD');
									Ext.getCmp('a6.input').closing = false;
									Ext.getCmp('a6.input').show();
									Ext.getCmp('a6.input').setTitle('System Property - Add');
									if(r.data.tl != undefined){
										Ext.getCmp('a6.label.t').show();
										r.data.tl.unshift ({id:'',text:'Owner'});
										Ext.getCmp('a6.input.t').addReset(r.data.tl);
										Ext.getCmp('a6.input.t').setValue('');
										Ext.getCmp('a6.input.t').enable();
										Ext.getCmp('a6.input.t').focus();
									}else{
										Ext.getCmp('a6.input.t').setValue(session.tenant);
										Ext.getCmp('a6.label.t').hide();
										Ext.getCmp('a6.input.f1').focus();
									}
									Ext.getCmp('a6.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a6.list').setLoading(false);
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
		            	Ext.getCmp('a6.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a6.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/a6/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a6.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a6.search.f5').addReset(r.data.l);
									Ext.getCmp('a6.search').show();
									Ext.getCmp('a6.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a6.list').setLoading(false);
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
		{ text: 'Tenant',hideable:false,width: 150,sortable :false,hidden:true, dataIndex: 't' },
		{ hidden:true, hideable:false,dataIndex: 'i' },
		{ text: 'Property Code',width: 120, dataIndex: 'f1' },
		{ text: 'Property Name',width: 200,dataIndex: 'f2'},
		{ text: 'Property Value',width: 150,dataIndex: 'f3' },
		{ text: 'Description',flex:1,dataIndex: 'f4' },
		{ text: 'Active',width: 50,sortable :false,dataIndex: 'f5',align:'center',
			renderer: function(value){
				if(value==true)
					return '<img src="' + icon('t') + '" style="margin: -5px;" />';
				else
					return '<img src="' + icon('f') + '" style="margin: -5px;" />';
			}
		},{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a6.list').setLoading('Getting System Property Code '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/a6/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('a6.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('a6.input.panel').qReset();
							Ext.getCmp('a6.label.t').hide();
							Ext.getCmp('a6.input.f1').disable();
							Ext.getCmp('a6.input.i').setValue(record.data.i);
							Ext.getCmp('a6.input.f1').setValue(o.f1);
							Ext.getCmp('a6.input.f2').setValue(o.f2);
							Ext.getCmp('a6.input.f3').setValue(o.f3);
							Ext.getCmp('a6.input.f4').setValue(o.f4);
							Ext.getCmp('a6.input.f5').setValue(o.f5);
							Ext.getCmp('a6.input.p').setValue('UPDATE');
							Ext.getCmp('a6.input').closing = false;
							Ext.getCmp('a6.input').setTitle('System Property - Update');
							Ext.getCmp('a6.input').show();
							Ext.getCmp('a6.input.f2').focus();
							Ext.getCmp('a6.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a6.list').setLoading(false);
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
				Ext.getCmp('a6.confirm').confirm({
					msg : "Are you sure Delete System Property Code '"+record.raw.f1+"' ?",
					allow : 'a6.delete',
					onY : function() {
						Ext.getCmp('a6.list').setLoading('Deleting System Property Code '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/a6/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('a6.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('a6.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a6.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});