Ext.define('App.content.pel2.List',{
	extend:'App.cmp.Table',
	id:'pel2.list',
	params:function(){
		return Ext.getCmp('pel2.search.panel').qParams();
	},
	url:url + 'app/pel2/getList',
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
						Ext.getCmp('pel2.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/pel2/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('pel2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel2.input.panel').qReset();
									Ext.getCmp('pel2.input.p').setValue('ADD');
									Ext.getCmp('pel2.input').closing = false;
									Ext.getCmp('pel2.input').show();
									Ext.getCmp('pel2.input').setTitle('Promo - Tambah');
									Ext.getCmp('pel2.input.f1').focus();
									Ext.getCmp('pel2.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel2.list').setLoading(false);
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
		            	Ext.getCmp('pel2.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('pel2.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/pel2/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('pel2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel2.search').show();
									Ext.getCmp('pel2.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel2.list').setLoading(false);
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
		{ hidden:true,hideable:false,dataIndex: 'i' },
		{ text: 'Tanggal Promo',width: 100, dataIndex: 'f1',align:'center' },
		{ text: 'Tanggal Berlaku',width: 100, dataIndex: 'f3',align:'center' },
		{ text: 'Judul Promo',flex:1, dataIndex: 'f2' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('pel2.list').setLoading('Mengambil Promo '+record.data.f2);
				Ext.Ajax.request({
					url : url + 'app/pel2/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('pel2.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('pel2.input.panel').qReset();
							Ext.getCmp('pel2.input.i').setValue(record.data.i);
							Ext.getCmp('pel2.input.f1').setValue(o.f1);
							Ext.getCmp('pel2.input.f2').setValue(o.f2);
							Ext.getCmp('pel2.input.f3').setValue(o.f3);
							Ext.getCmp('pel2.input.f4').setValue(o.f4);
							Ext.getCmp('pel2.input.p').setValue('UPDATE');
							Ext.getCmp('pel2.input').closing = false;
							Ext.getCmp('pel2.input').setTitle('Promo - Ubah');
							Ext.getCmp('pel2.input').show();
							Ext.getCmp('pel2.input.f1').focus();
							Ext.getCmp('pel2.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('pel2.list').setLoading(false);
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
				Ext.getCmp('pel2.confirm').confirm({
					msg : "Are you sure Delete Promo '"+record.raw.f2+"' ?",
					allow : 'pel2.delete',
					onY : function() {
						Ext.getCmp('pel2.list').setLoading('Deleting Promo '+record.raw.f2);
						Ext.Ajax.request({
							url : url + 'app/pel2/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('pel2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('pel2.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});