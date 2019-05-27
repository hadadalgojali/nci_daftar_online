Ext.define('App.content.drh1.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'drh1.search',
	modal:false,
	title:'Negara - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'drh1.search.btnSearch',
			handler: function() {
				Ext.getCmp('drh1.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('drh1.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('drh1.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'drh1.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nama Negara',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Negara',
							submit:'drh1.search.btnSearch',
							id:'drh1.search.f1'
						})
					]
				})
			]
		})
	]
})