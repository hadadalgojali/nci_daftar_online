Ext.define('App.content.pel4.List',{
	extend:'App.cmp.Table',
	id:'pel4.list',
	params:function(){
		return Ext.getCmp('pel4.search.panel').qParams();
	},
	url:url + 'app/pel4/getList',
	result:function(response){
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
		            text: 'Tambah',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('pel4.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/pel4/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('pel4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel4.input.panel').qReset();
									Ext.getCmp('pel4.input.f1').addReset(r.data.l);
									Ext.getCmp('pel4.input.p').setValue('ADD');
									Ext.getCmp('pel4.input').closing = false;
									Ext.getCmp('pel4.input').show();
									Ext.getCmp('pel4.input').setTitle('Simulasi Pembayaran - Tambah');
									Ext.getCmp('pel4.input.f1').focus();
									Ext.getCmp('pel4.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel4.list').setLoading(false);
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
		            	Ext.getCmp('pel4.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('pel4.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/pel4/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('pel4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel4.search').show();
									Ext.getCmp('pel4.search.f2').addReset(r.data.l);
									Ext.getCmp('pel4.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel4.list').setLoading(false);
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
		{ hidden:true, hideable:false,dataIndex: 'i' },
		{ text: 'Customer',flex:1, dataIndex: 'f1' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('pel4.list').setLoading('Mengambil Kontraktor '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/pel4/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('pel4.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('pel4.input.panel').qReset();
							Ext.getCmp('pel4.input.i').setValue(record.data.i);
							Ext.getCmp('pel4.input.f1').addReset(r.data.l);
							Ext.getCmp('pel4.input.f1').setValue(o.f1);
							Ext.getCmp('pel4.input.f2').setValue(o.f2);
							Ext.getCmp('pel4.input.p').setValue('UPDATE');
							Ext.getCmp('pel4.input').closing = false;
							Ext.getCmp('pel4.input').setTitle('Simulasi Pembayaran - Ubah');
							Ext.getCmp('pel4.input').show();
							Ext.getCmp('pel4.input.f1').focus();
							Ext.getCmp('pel4.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('pel4.list').setLoading(false);
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
				Ext.getCmp('pel4.confirm').confirm({
					msg : "Are you sure Delete Kontraktor '"+record.raw.f1+"' ?",
					allow : 'pel4.delete',
					onY : function() {
						Ext.getCmp('pel4.list').setLoading('Deleting Kontraktor '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/pel4/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('pel4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('pel4.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel4.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});