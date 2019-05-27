Ext.define('App.system.a3.Main', {
	extend : 'App.cmp.Panel',
	id : 'a3.main',
	layout:'fit',
	items : [
		new Ext.create('App.system.a3.Search'),
		new Ext.create('App.system.a3.List'),
		new Ext.create('App.system.a3.Input'),
		new Ext.create('App.system.a3.InputMenu'),
		new Ext.create('App.cmp.Confirm', {id : 'a3.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabA3').setLoading(false);
		this.callParent();
	}
});