Ext.define('App.content.fs2.Main', {
	extend : 'App.cmp.Panel',
	id : 'fs2.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.fs2.Search'),
		new Ext.create('App.content.fs2.List'),
		new Ext.create('App.content.fs2.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'fs2.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabFS2').setLoading(false);
		this.callParent();
	}
});