Ext.define('App.content.rs2.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'rs2.search',
	modal:false,
	title:'Kunjungan - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'rs2.search.btnSearch',
			handler: function() {
				Ext.getCmp('rs2.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('rs2.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('rs2.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'rs2.search.panel',
			width: 400,
			items:[
				new Ext.create('App.cmp.Input',{
					label:'No. Medrec',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'No. Medrec',
							submit:'rs2.search.btnSearch',
							id:'rs2.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'No. Pendaftaran',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'No. Pendaftaran',
							submit:'rs2.search.btnSearch',
							id:'rs2.search.f2'
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
							submit:'rs2.search.btnSearch',
							id:'rs2.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Klinik',
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 'rs2.search.f4',
							name : 'f4',
							submit:'rs2.search.btnSearch',
							emptyText: 'Klinik',
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Dokter',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f5',
							width: 200,
							emptyText:'Nama Dokter',
							submit:'rs2.search.btnSearch',
							id:'rs2.search.f5'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Tgl. Berobat',
					items : [
						new Ext.create('App.cmp.DateField', {
							id : 'rs2.search.f6',
							name : 'f6',
							submit:'rs2.search.btnSearch',
							emptyText: 'Dari',
						}),
						new Ext.create('Ext.form.DisplayField', {
							value:' &nbsp; - &nbsp; '
						}),
						new Ext.create('App.cmp.DateField', {
							id : 'rs2.search.f7',
							name : 'f7',
							submit:'rs2.search.btnSearch',
							emptyText: 'Sampai',
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'No. Antrian',
					items:[
						new Ext.create('App.cmp.NumberField',{
							name:'f8',
							width: 50,
							emptyText:'No. Antrian',
							submit:'rs2.search.btnSearch',
							id:'rs2.search.f8'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Status Dilayani',
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 'rs2.search.f9',
							name : 'f9',
							submit:'rs2.search.btnSearch',
							emptyText: 'Status',
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Hadir',
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 'rs2.search.f10',
							name : 'f10',
							submit:'rs2.search.btnSearch',
							emptyText: 'Hadir',
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Klmpk. Pasien',
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 'rs2.search.f11',
							name : 'f11',
							submit:'rs2.search.btnSearch',
							emptyText: 'Klmpk. Pasien',
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'No. SEP',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f12',
							width: 200,
							emptyText:'No. SEP',
							submit:'rs2.search.btnSearch',
							id:'rs2.search.f12'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Jns. Daftar',
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 'rs2.search.f13',
							name : 'f13',
							submit:'rs2.search.btnSearch',
							emptyText: 'Jns. Daftar',
						})
					]
				}),
			]
		})
	]
})