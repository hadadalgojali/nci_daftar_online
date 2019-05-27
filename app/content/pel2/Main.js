Ext.define('App.content.pel2.Main', {
	extend : 'App.cmp.Panel',
	id : 'pel2.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.pel2.Search'),
		new Ext.create('App.content.pel2.List'),
		new Ext.create('App.content.pel2.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'pel2.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabPEL2').setLoading(false);
		this.callParent();
	}
});