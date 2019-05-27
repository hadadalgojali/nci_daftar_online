Ext.define('App.content.pel1.List',{
	extend:'App.cmp.Table',
	id:'pel1.list',
	params:function(){
		return Ext.getCmp('pel1.search.panel').qParams();
	},
	url:url + 'app/pel1/getList',
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
		            text: 'Refresh',
		            scale: 'large',
		            iconCls: 'i-refresh-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	Ext.getCmp('pel1.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('pel1.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/pel1/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('pel1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel1.search').show();
									Ext.getCmp('pel1.search.f7').addReset(r.data.l);
									Ext.getCmp('pel1.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel1.list').setLoading(false);
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
		{ text: 'Tanggal',width: 100, dataIndex: 'f1',align:'center' },
		{ text: 'Email',width: 150, dataIndex: 'f2' },
		{ text: 'Nama',width: 150, dataIndex: 'f3' },
		{ text: 'Telp',width: 150, dataIndex: 'f6' },
		{ text: 'Deskripsi',flex: 1, dataIndex: 'f4' },
		{ text: 'Status',width: 100, dataIndex: 'f5' },
		{
			text: 'Status',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('pel1.list').setLoading('Mengambil Feedback '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/pel1/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('pel1.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('pel1.input.panel').qReset();
							Ext.getCmp('pel1.input.i').setValue(record.data.i);
							Ext.getCmp('pel1.input.f1').addReset(r.data.l);
							Ext.getCmp('pel1.input.f1').setValue(o.f1);
							Ext.getCmp('pel1.input').closing = false;
							Ext.getCmp('pel1.input').setTitle('Feedback - Status');
							Ext.getCmp('pel1.input').show();
							Ext.getCmp('pel1.input.f1').focus();
							Ext.getCmp('pel1.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('pel1.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		}
	]
});