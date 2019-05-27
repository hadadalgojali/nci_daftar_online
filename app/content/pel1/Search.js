Ext.define('App.content.pel1.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'pel1.search',
	modal:false,
	title:'Feedback - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'pel1.search.btnSearch',
			handler: function() {
				Ext.getCmp('pel1.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('pel1.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('pel1.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'pel1.search.panel',
			items:[
				new Ext.create('App.cmp.Input', {
					label : 'Tanggal',
					items : [
						new Ext.create('App.cmp.DateField', {
							id : 'pel1.search.f1',
							name : 'f1',
							submit:'pel1.search.btnSearch',
							emptyText: 'Dari'
						}),
						new Ext.create('Ext.form.DisplayField', {
							value:' &nbsp; - &nbsp; '
						}),
						new Ext.create('App.cmp.DateField', {
							id : 'pel1.search.f2',
							name : 'f2',
							submit:'pel1.search.btnSearch',
							emptyText: 'Sampai'
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
							submit:'pel1.search.btnSearch',
							id:'pel1.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f4',
							width: 200,
							emptyText:'Nama',
							submit:'pel1.search.btnSearch',
							id:'pel1.search.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Telp',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f5',
							width: 200,
							emptyText:'Telp',
							submit:'pel1.search.btnSearch',
							id:'pel1.search.f5'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Deskripsi',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f6',
							width: 200,
							emptyText:'Deskripsi',
							submit:'pel1.search.btnSearch',
							id:'pel1.search.f6'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Status',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'pel1.search.f7',
							width: 150,
							emptyText:'Status',
							name : 'f7',
							submit:'pel1.search.btnSearch'
						})
					]
				})
			]
		})
	]
})