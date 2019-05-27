Ext.define('App.content.s2.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'s2.search',
	modal:false,
	title:'Penyakit - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'s2.search.btnSearch',
			handler: function() {
				Ext.getCmp('s2.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('s2.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('s2.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 's2.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Kode Penyakit',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Kode Penyakit',
							submit:'s2.search.btnSearch',
							id:'s2.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Parent',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Parent',
							submit:'s2.search.btnSearch',
							id:'s2.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Penyakit',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f3',
							width: 200,
							emptyText:'Nama Penyakit',
							submit:'s2.search.btnSearch',
							id:'s2.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Non Rujukan',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 's2.search.f4',
							width: 150,
							emptyText:'Aktif',
							name : 'f4',
							submit:'s2.search.btnSearch'
						})
					]
				})
			]
		})
	]
})