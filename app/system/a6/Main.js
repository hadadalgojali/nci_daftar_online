Ext.define('App.system.a6.Main', {
	extend : 'App.cmp.Panel',
	id : 'a6.main',
	layout:'fit',
	items : [
		new Ext.create('App.system.a6.Search'),
		new Ext.create('App.system.a6.List'),
		new Ext.create('App.system.a6.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'a6.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabA6').setLoading(false);
		this.callParent();
	}
});