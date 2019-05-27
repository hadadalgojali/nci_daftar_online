Ext.define('App.system.a5.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'a5.search',
	modal:false,
	title:'Employee - Searching',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'a5.search.btnSearch',
			handler: function() {
				Ext.getCmp('a5.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('a5.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('a5.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'a5.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'ID Number',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'ID Number',
							submit:'a5.search.btnSearch',
							id:'a5.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Name',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							name:'f2',
							width: 200,
							emptyText:'Name',
							submit:'a5.search.btnSearch',
							id:'a5.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Gender',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a5.search.f3',
							name : 'f3',
							submit:'a5.search.btnSearch',
							emptyText: 'Gender'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Birth Date',
					items : [
						new Ext.create('App.cmp.DateField', {
							id : 'a5.search.f4',
							name : 'f4',
							submit:'a5.search.btnSearch',
							emptyText: 'Start'
						}),
						new Ext.create('Ext.form.DisplayField', {
							value:' &nbsp; - &nbsp; '
						}),
						new Ext.create('App.cmp.DateField', {
							id : 'a5.search.f5',
							name : 'f5',
							submit:'a5.search.btnSearch',
							emptyText: 'End'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Job',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f7',
							width: 200,
							emptyText:'Job',
							submit:'a5.search.btnSearch',
							id:'a5.search.f7'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Address',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f8',
							width: 200,
							emptyText:'Address',
							submit:'a5.search.btnSearch',
							id:'a5.search.f8'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Active',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a5.search.srchActiveFlag',
							name : 'f6',
							submit:'a5.search.btnSearch',
							emptyText: 'Active'
						})
					]
				})
			]
		})
	]
})