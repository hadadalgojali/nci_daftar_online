Ext.define('App.content.rs3.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'rs3.search',
	modal:false,
	title:'Rujukan - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'rs3.search.btnSearch',
			handler: function() {
				Ext.getCmp('rs3.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('rs3.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('rs3.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'rs3.search.panel',
			width: 350,
			items:[
				new Ext.create('App.cmp.Input',{
					label:'No. Rujukan',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'No. Rujukan',
							submit:'rs3.search.btnSearch',
							id:'rs3.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Faskes',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Faskes',
							submit:'rs3.search.btnSearch',
							id:'rs3.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Pasien',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f3',
							width: 200,
							emptyText:'Nama Pasien',
							submit:'rs3.search.btnSearch',
							id:'rs3.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Dokter Perujuk',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f4',
							width: 200,
							emptyText:'Dokter Perujuk',
							submit:'rs3.search.btnSearch',
							id:'rs3.search.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Tgl. Rujukan',
					items : [
						new Ext.create('App.cmp.DateField', {
							id : 'rs3.search.f5',
							name : 'f5',
							submit:'rs3.search.btnSearch',
							emptyText: 'Dari',
						}),
						new Ext.create('Ext.form.DisplayField', {
							value:' &nbsp; - &nbsp; '
						}),
						new Ext.create('App.cmp.DateField', {
							id : 'rs3.search.f6',
							name : 'f6',
							submit:'rs3.search.btnSearch',
							emptyText: 'Sampai',
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Diagnosa',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f7',
							width: 200,
							emptyText:'Diagnosa',
							submit:'rs3.search.btnSearch',
							id:'rs3.search.f7'
						})
					]
				}),
			]
		})
	]
})