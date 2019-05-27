Ext.define('App.system.a4.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'a4.search',
	modal:false,
	title:'Parameter - Searching',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'a4.search.btnSearch',
			handler: function() {
				Ext.getCmp('a4.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('a4.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('a4.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'a4.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Parameter Code',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							emptyText:'Parameter Code',
							id:'a4.search.f1',
							submit:'a4.search.btnSearch'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Parameter Name',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							name:'f2',
							emptyText:'Parameter Name',
							id:'a4.search.f2',
							submit:'a4.search.btnSearch'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Resume',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							name:'f3',
							emptyText:'Resume',
							id:'a4.search.f3',
							submit:'a4.search.btnSearch'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Active',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a4.search.f4',
							name : 'f4',
							emptyText: 'Active'
						})
					]
				}) 
			]
		})
	]
})