Ext.define('App.system.a8.Main', {
	extend : 'App.cmp.Panel',
	id : 'a8.main',
	layout:'fit',
	items : [
		new Ext.create('App.system.a8.Search'),
		new Ext.create('App.system.a8.List'),
		new Ext.create('App.system.a8.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'a8.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabA8').setLoading(false);
		this.callParent();
	}
});