Ext.define('App.content.fs1.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'fs1.search',
	modal:false,
	title:'Jadwal Dokter - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'fs1.search.btnSearch',
			handler: function() {
				Ext.getCmp('fs1.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('fs1.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('fs1.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'fs1.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Kode Faskes',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Kode Faskes',
							submit:'fs1.search.btnSearch',
							id:'fs1.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Faskes',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Nama Faskes',
							submit:'fs1.search.btnSearch',
							id:'fs1.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Alamat',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f3',
							width: 200,
							emptyText:'Alamat',
							submit:'fs1.search.btnSearch',
							id:'fs1.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Telepon',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f4',
							width: 200,
							emptyText:'Telepon',
							submit:'fs1.search.btnSearch',
							id:'fs1.search.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Email',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f5',
							width: 200,
							emptyText:'Email',
							submit:'fs1.search.btnSearch',
							id:'fs1.search.f5'
						})
					]
				})
			]
		})
	]
})