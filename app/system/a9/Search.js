Ext.define('App.system.a9.Search',{
	extend : 'App.cmp.Window',
	iconCls:'i-search',
	id:'a9.search',
	modal:false,
	title:'System Property - Searching',
	fbar: [
		{
			text: 'Search',
			iconCls:'i-search',
			id:'a9.search.btnSearch',
			handler: function() {
				Ext.getCmp('a9.list').refresh();
			}
		},{
			text: 'Reset',
			iconCls:'i-reset',
			handler: function() {
				Ext.getCmp('a9.search.panel').qReset();
			}
		},{
			text: 'Close',
			iconCls:'i-close',
			handler: function() {
				Ext.getCmp('a9.search').close();
			}
		}
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'a9.search.panel',
			items:[
				new Ext.create('App.cmp.Input',{
					label:'Prop Code',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							width: 200,
							emptyText:'Prop Code',
							submit:'a9.search.btnSearch',
							id:'a9.search.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Prop Name',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f2',
							width: 200,
							emptyText:'Prop Name',
							submit:'a9.search.btnSearch',
							id:'a9.search.f2'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Prop Value',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f3',
							width: 200,
							emptyText:'Prop Value',
							submit:'a9.search.btnSearch',
							id:'a9.search.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Description',
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f4',
							width: 200,
							emptyText:'Description',
							submit:'a9.search.btnSearch',
							id:'a9.search.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Active',
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a9.search.f5',
							name : 'f5',
							submit:'a9.search.btnSearch',
							emptyText: 'Active',
						})
					]
				})
			]
		})
	]
})