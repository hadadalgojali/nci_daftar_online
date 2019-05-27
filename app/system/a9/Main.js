Ext.define('App.system.a9.Main', {
	extend : 'App.cmp.Panel',
	id : 'a9.main',
	layout:'fit',
	items : [
		new Ext.create('App.system.a9.Search'),
		new Ext.create('App.system.a9.List'),
		new Ext.create('App.system.a9.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'a9.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabA9').setLoading(false);
		this.callParent();
	}
});