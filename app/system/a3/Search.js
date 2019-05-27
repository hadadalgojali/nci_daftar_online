Ext.define('App.system.a3.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'a3.search',
	modal:false,
	title:'Role -  Searching',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'a3.search.btnSearch',
			handler: function() {
				Ext.getCmp('a3.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('a3.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('a3.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'a3.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Role Code',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							submit:'a3.search.btnSearch',
							emptyText:'Role Code',
							id:'a3.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Role Name',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							submit:'a3.search.btnSearch',
							name:'f2',
							emptyText:'Role Name',
							id:'a3.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Description',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							submit:'a3.search.btnSearch',
							name:'f3',
							emptyText:'Description',
							id:'a3.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Active',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a3.search.f4',
							submit:'a3.search.btnSearch',
							name : 'f4',
							emptyText: 'Active'
						})
					]
				})
			]
		})
	]
})