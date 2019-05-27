Ext.define('App.system.a7.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'a7.search',
	modal:false,
	title:'User -  Searching',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'a7.search.btnSearch',
			handler: function() {
				Ext.getCmp('a7.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('a7.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('a7.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'a7.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'User Code',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							name:'f1',
							submit:'a7.search.btnSearch',
							emptyText:'User Code',
							id:'a7.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'ID Number',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							submit:'a7.search.btnSearch',
							emptyText:'ID Number',
							id:'a7.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Name',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							name:'f3',
							emptyText:'Name',
							submit:'a7.search.btnSearch',
							id:'a7.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Role',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							name:'f4',
							emptyText:'Role',
							submit:'a7.search.btnSearch',
							id:'a7.search.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Birth Date',
					items : [
						new Ext.create('App.cmp.DateField', {
							id : 'a7.search.f5',
							name : 'f5',
							submit:'a7.search.btnSearch',
							emptyText: 'Start',
						}),
						new Ext.create('Ext.form.DisplayField', {
							value:' &nbsp; - &nbsp; '
						}),
						new Ext.create('App.cmp.DateField', {
							id : 'a7.search.f6',
							name : 'f6',
							submit:'a7.search.btnSearch',
							emptyText: 'End',
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Active',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a7.search.f7',
							name : 'f7',
							submit:'a7.search.btnSearch',
							emptyText: 'Active',
						})
					]
				})
			]
		})
	]
})