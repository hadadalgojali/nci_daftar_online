Ext.define('App.content.s1.Main', {
	extend : 'App.cmp.Panel',
	id : 's1.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.s1.Search'),
		new Ext.create('App.content.s1.List'),
		new Ext.create('App.content.s1.Input'),
		new Ext.create('App.cmp.Confirm', {id : 's1.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabS1').setLoading(false);
		this.callParent();
	}
});