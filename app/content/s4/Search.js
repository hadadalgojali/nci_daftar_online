Ext.define('App.content.s4.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'s4.search',
	modal:false,
	title:'Customer - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'s4.search.btnSearch',
			handler: function() {
				Ext.getCmp('s4.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('s4.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('s4.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 's4.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nama Customer',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Customer',
							submit:'s4.search.btnSearch',
							id:'s4.search.f1'
						})
					]
				}),
			]
		})
	]
})