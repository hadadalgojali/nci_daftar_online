Ext.define('App.content.pel2.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'pel2.search',
	modal:false,
	title:'Promo - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'pel2.search.btnSearch',
			handler: function() {
				Ext.getCmp('pel2.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('pel2.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('pel2.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'pel2.search.panel',
			items:[
				new Ext.create('App.cmp.Input', {
					label : 'Tanggal Promo',
					items : [
						new Ext.create('App.cmp.DateField', {
							id : 'pel2.search.f1',
							name : 'f1',
							submit:'pel2.search.btnSearch',
							emptyText: 'Dari'
						}),
						new Ext.create('Ext.form.DisplayField', {
							value:' &nbsp; - &nbsp; '
						}),
						new Ext.create('App.cmp.DateField', {
							id : 'pel2.search.f2',
							name : 'f2',
							submit:'pel2.search.btnSearch',
							emptyText: 'Sampai'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Tanggal Berakhir',
					items : [
						new Ext.create('App.cmp.DateField', {
							id : 'pel2.search.f3',
							name : 'f3',
							submit:'pel2.search.btnSearch',
							emptyText: 'Dari'
						}),
						new Ext.create('Ext.form.DisplayField', {
							value:' &nbsp; - &nbsp; '
						}),
						new Ext.create('App.cmp.DateField', {
							id : 'pel2.search.f4',
							name : 'f4',
							submit:'pel2.search.btnSearch',
							emptyText: 'Sampai'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Judul Promo',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f5',
							width: 200,
							emptyText:'Judul Promo',
							submit:'pel2.search.btnSearch',
							id:'pel2.search.f5'
						})
					]
				})
			]
		})
	]
})