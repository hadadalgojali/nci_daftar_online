Ext.define('App.system.a7.Main', {
	extend : 'App.cmp.Panel',
	id : 'a7.main',
	layout:'fit',
	items : [
		new Ext.create('App.system.a7.Search'),
		new Ext.create('App.system.a7.List'),
		new Ext.create('App.system.a7.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'a7.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabA7').setLoading(false);
		this.callParent();
	}
});