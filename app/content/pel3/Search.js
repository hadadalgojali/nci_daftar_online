Ext.define('App.content.pel3.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'pel3.search',
	modal:false,
	title:'Jadwal Dokter - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'pel3.search.btnSearch',
			handler: function() {
				Ext.getCmp('pel3.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('pel3.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('pel3.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'pel3.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nama Klinik',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nama Klinik',
							submit:'pel3.search.btnSearch',
							id:'pel3.search.f1'
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
							submit:'pel3.search.btnSearch',
							id:'pel3.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Hari',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'pel3.search.f3',
							width: 150,
							emptyText:'Hari',
							name : 'f3',
							submit:'pel3.search.btnSearch'
						})
					]
				}), 
				new Ext.create('App.cmp.Input',{
					label:'Pukul',
					items:[
						new Ext.create('App.cmp.TimeField',{
							emptyText:'Pukul',
							name:'f4',
							width: 100,
							submit:'pel3.search.btnSearch',
							id:'pel3.search.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Max Antrian',
					items:[
						new Ext.create('App.cmp.NumberField',{
							emptyText:'Max Antrian',
							name:'f5',
							submit:'pel3.search.btnSearch',
							id:'pel3.search.f5'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Durasi(menit)',
					items:[
						new Ext.create('App.cmp.NumberField',{
							emptyText:'Durasi',
							name:'f6',
							submit:'pel3.search.btnSearch',
							id:'pel3.search.f6'
						})
					]
				})
			]
		})
	]
})