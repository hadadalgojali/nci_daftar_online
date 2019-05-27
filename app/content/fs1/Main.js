Ext.define('App.content.fs1.Main', {
	extend : 'App.cmp.Panel',
	id : 'fs1.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.fs1.Search'),
		new Ext.create('App.content.fs1.List'),
		new Ext.create('App.content.fs1.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'fs1.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabFS1').setLoading(false);
		this.callParent();
	}
});