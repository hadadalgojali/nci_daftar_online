Ext.define('App.content.pel4.Main', {
	extend : 'App.cmp.Panel',
	id : 'pel4.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.pel4.Search'),
		new Ext.create('App.content.pel4.List'),
		new Ext.create('App.content.pel4.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'pel4.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabPEL4').setLoading(false);
		this.callParent();
	}
});