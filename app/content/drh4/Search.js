Ext.define('App.content.drh4.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'drh4.search',
	modal:false,
	title:'Kecamatan - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'drh4.search.btnSearch',
			handler: function() {
				Ext.getCmp('drh4.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('drh4.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('drh4.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'drh4.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nama Kota',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Kota',
							submit:'drh4.search.btnSearch',
							id:'drh4.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Kecamatan',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Nama Kecamatan',
							submit:'drh4.search.btnSearch',
							id:'drh4.search.f2'
						})
					]
				})
			]
		})
	]
})