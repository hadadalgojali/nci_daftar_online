Ext.define('App.content.drh3.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'drh3.search',
	modal:false,
	title:'City - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'drh3.search.btnSearch',
			handler: function() {
				Ext.getCmp('drh3.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('drh3.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('drh3.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'drh3.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nama Provinsi',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Provinsi',
							submit:'drh3.search.btnSearch',
							id:'drh3.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Kota',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Nama Kota',
							submit:'drh3.search.btnSearch',
							id:'drh3.search.f2'
						})
					]
				})
			]
		})
	]
})