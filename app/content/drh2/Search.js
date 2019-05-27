Ext.define('App.content.drh2.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'drh2.search',
	modal:false,
	title:'Provinsi - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'drh2.search.btnSearch',
			handler: function() {
				Ext.getCmp('drh2.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('drh2.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('drh2.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'drh2.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nama Negara',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Negara',
							submit:'drh2.search.btnSearch',
							id:'drh2.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Provinsi',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Nama Provinsi',
							submit:'drh2.search.btnSearch',
							id:'drh2.search.f2'
						})
					]
				})
			]
		})
	]
})