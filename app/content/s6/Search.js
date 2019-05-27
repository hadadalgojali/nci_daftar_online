Ext.define('App.content.s6.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'s6.search',
	modal:false,
	title:'Dokter Klinik - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'s6.search.btnSearch',
			handler: function() {
				Ext.getCmp('s6.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('s6.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('s6.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 's6.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nama Klinik',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Klinik',
							submit:'s6.search.btnSearch',
							id:'s6.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Dokter',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Nama Dokter',
							submit:'s6.search.btnSearch',
							id:'s6.search.f2'
						})
					]
				})
			]
		})
	]
})