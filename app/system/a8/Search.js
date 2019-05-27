Ext.define('App.system.a8.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'a8.search',
	modal:false,
	title:'Sequence - Searching',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'a8.search.btnSearch',
			handler: function() {
				Ext.getCmp('a8.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('a8.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('a8.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'a8.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Sequence Code',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Sequence Code',
							submit:'a8.search.btnSearch',
							id:'a8.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Sequence Name',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Sequence Name',
							submit:'a8.search.btnSearch',
							id:'a8.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Repeat Type',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a8.search.f3',
							name : 'f3',
							submit:'a8.search.btnSearch',
							emptyText: 'Repeat Type',
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Format',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f4',
							width: 200,
							emptyText:'Format',
							submit:'a8.search.btnSearch',
							id:'a8.search.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Active',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a8.search.f5',
							name : 'f5',
							submit:'a8.search.btnSearch',
							emptyText: 'Active',
						})
					]
				})
			]
		})
	]
})