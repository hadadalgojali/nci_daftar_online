Ext.define('App.system.a10.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'a10.search',
	modal:false,
	title:'Banner - Searching',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'a10.search.btnSearch',
			handler: function() {
				Ext.getCmp('a10.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('a10.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('a10.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'a10.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Judul',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Judul',
							submit:'a10.search.btnSearch',
							id:'a10.search.f1'
						})
					]
				})
			]
		})
	]
})