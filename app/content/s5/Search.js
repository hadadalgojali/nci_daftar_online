Ext.define('App.content.s5.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'s5.search',
	modal:false,
	title:'Poliklinik - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'s5.search.btnSearch',
			handler: function() {
				Ext.getCmp('s5.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('s5.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('s5.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 's5.search.panel',
			items:[
				new Ext.create('App.cmp.Input', {
					label : 'Customer',
					items : [
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Customer',
							submit:'s5.search.btnSearch',
							id:'s5.search.f1'
						})
					]
				}), 
				new Ext.create('App.cmp.Input',{
					label:'Jenis Customer',
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 's5.search.f2',
							width: 150,
							emptyText:'Jenis Customer',
							name : 'f2',
							submit:'s5.search.btnSearch'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Kontak',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f3',
							width: 200,
							emptyText:'Kontak',
							submit:'s5.search.btnSearch',
							id:'s5.search.f3'
						})
					]
				})
			]
		})
	]
})