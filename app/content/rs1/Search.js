Ext.define('App.content.rs1.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'rs1.search',
	modal:false,
	title:'Pasien - Pencarian',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'rs1.search.btnSearch',
			handler: function() {
				Ext.getCmp('rs1.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('rs1.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('rs1.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'rs1.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Nomor Medrec',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Nomor Medrec',
							submit:'rs1.search.btnSearch',
							id:'rs1.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nomor KTP',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f8',
							width: 200,
							emptyText:'Nomor KTP',
							submit:'rs1.search.btnSearch',
							id:'rs1.search.f8'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Pasien',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Nama Pasien',
							submit:'rs1.search.btnSearch',
							id:'rs1.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Jenis Kelamin',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'rs1.search.f3',
							name : 'f3',
							submit:'rs1.search.btnSearch',
							emptyText: 'Gender'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Tanggal Lahir',
					items : [
						new Ext.create('App.cmp.DateField', {
							id : 'rs1.search.f4',
							name : 'f4',
							submit:'rs1.search.btnSearch',
							emptyText: 'Start'
						}),
						new Ext.create('Ext.form.DisplayField', {
							value:' &nbsp; - &nbsp; '
						}),
						new Ext.create('App.cmp.DateField', {
							id : 'rs1.search.f5',
							name : 'f5',
							submit:'rs1.search.btnSearch',
							emptyText: 'End'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'No. Telepon',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f7',
							width: 200,
							emptyText:'No. Telepon',
							submit:'rs1.search.btnSearch',
							id:'rs1.search.f7'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Alamat',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f6',
							width: 200,
							emptyText:'Address',
							submit:'rs1.search.btnSearch',
							id:'rs1.search.f6'
						})
					]
				})
			]
		})
	]
})