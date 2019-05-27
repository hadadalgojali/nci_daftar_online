Ext.define('App.content.drh5.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'drh5.search',
	modal:false,
	title:'Kelurahan - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'drh5.search.btnSearch',
			handler: function() {
				Ext.getCmp('drh5.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('drh5.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('drh5.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'drh5.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nama Kecamatan',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Kecamatan',
							submit:'drh5.search.btnSearch',
							id:'drh5.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Kelurahan',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Nama Kelurahan',
							submit:'drh5.search.btnSearch',
							id:'drh5.search.f2'
						})
					]
				})
			]
		})
	]
})