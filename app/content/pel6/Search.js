Ext.define('App.content.pel6.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'pel6.search',
	modal:false,
	title:'Artikel - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'pel6.search.btnSearch',
			handler: function() {
				Ext.getCmp('pel6.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('pel6.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('pel6.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'pel6.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Judul Apotek',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f5',
							width: 200,
							emptyText:'Judul Apotek',
							submit:'pel6.search.btnSearch',
							id:'pel6.search.f5'
						})
					]
				})
			]
		})
	]
})