Ext.define('App.system.a10.Main', {
	extend : 'App.cmp.Panel',
	id : 'a10.main',
	layout:'fit',
	items : [
		new Ext.create('App.system.a10.Search'),
		new Ext.create('App.system.a10.List'),
		new Ext.create('App.system.a10.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'a10.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabA10').setLoading(false);
		this.callParent();
	}
});