Ext.define('App.content.pel4.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'pel4.search',
	modal:false,
	title:'Simulasi Pembayaran - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'pel4.search.btnSearch',
			handler: function() {
				Ext.getCmp('pel4.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('pel4.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('pel4.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'pel4.search.panel',
			items:[
				new Ext.create('App.cmp.Input', {
					label : 'Customer',
					items : [
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Customer',
							submit:'pel4.search.btnSearch',
							id:'pel4.search.f1'
						})
					]
				})
			]
		})
	]
})