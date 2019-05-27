Ext.define('App.content.fs2.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'fs2.search',
	modal:false,
	title:'Poliklinik - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'fs2.search.btnSearch',
			handler: function() {
				Ext.getCmp('fs2.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('fs2.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('fs2.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'fs2.search.panel',
			items:[
				new Ext.create('App.cmp.Input', {
					label : 'Nama Faskes',
					items : [
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Faskes',
							submit:'fs2.search.btnSearch',
							id:'fs2.search.f1'
						})
					]
				}), 
				new Ext.create('App.cmp.Input', {
					label : 'Nama Akun',
					items : [
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Nama Akun',
							submit:'fs2.search.btnSearch',
							id:'fs2.search.f2'
						})
					]
				}), 
				new Ext.create('App.cmp.Input', {
					label : 'Email',
					items : [
						new Ext.create('App.cmp.TextField',{
							name:'f3',
							width: 200,
							emptyText:'Email',
							submit:'fs2.search.btnSearch',
							id:'fs2.search.f3'
						})
					]
				}), 
				new Ext.create('App.cmp.Input', {
					label : 'Nama Pengguna',
					items : [
						new Ext.create('App.cmp.TextField',{
							name:'f4',
							width: 200,
							emptyText:'Nama Pengguna',
							submit:'fs2.search.btnSearch',
							id:'fs2.search.f4'
						})
					]
				})
			]
		})
	]
})