Ext.define('App.content.s1.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'s1.search',
	modal:false,
	title:'Poliklinik - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'s1.search.btnSearch',
			handler: function() {
				Ext.getCmp('s1.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('s1.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('s1.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 's1.search.panel',
			items:[
				new Ext.create('App.cmp.Input', {
					label : 'Jenis Unit',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 's1.search.f1',
							width: 150,
							emptyText:'Jenis Unit',
							name : 'f1',
							submit:'s1.search.btnSearch'
						})
					]
				}), 
				new Ext.create('App.cmp.Input',{
					label:'Kode Unit',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Kode Unit',
							submit:'s1.search.btnSearch',
							id:'s1.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Unit',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f3',
							width: 200,
							emptyText:'Nama Unit',
							submit:'s1.search.btnSearch',
							id:'s1.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Aktif',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 's1.search.f4',
							width: 150,
							emptyText:'Aktif',
							name : 'f4',
							submit:'s1.search.btnSearch'
						})
					]
				})
			]
		})
	]
})