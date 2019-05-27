Ext.define('App.system.a5.Main', {
	extend : 'App.cmp.Panel',
	id : 'a5.main',
	layout:'fit',
	items : [
		new Ext.create('App.system.a5.Search'),
		new Ext.create('App.system.a5.List'),
		new Ext.create('App.system.a5.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'a5.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabA5').setLoading(false);
		this.callParent();
	}
});