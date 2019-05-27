Ext.define('App.content.s3.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'s3.search',
	modal:false,
	title:'Tentang Klinik - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'s3.search.btnSearch',
			handler: function() {
				Ext.getCmp('s3.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('s3.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('s3.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 's3.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nama Klinik',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Klinik',
							submit:'s3.search.btnSearch',
							id:'s3.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Judul',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Judul',
							submit:'s3.search.btnSearch',
							id:'s3.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Email',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f3',
							width: 200,
							emptyText:'Email',
							submit:'s3.search.btnSearch',
							id:'s3.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Alamat',
					items : [
						new Ext.create('App.cmp.TextField', {
							id : 's3.search.f4',
							width: 200,
							emptyText:'Alamat',
							name : 'f4',
							submit:'s3.search.btnSearch'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Telepon',
					items : [
						new Ext.create('App.cmp.TextField', {
							id : 's3.search.f5',
							width: 200,
							emptyText:'Telepon',
							name : 'f5',
							submit:'s3.search.btnSearch'
						})
					]
				})
			]
		})
	]
})