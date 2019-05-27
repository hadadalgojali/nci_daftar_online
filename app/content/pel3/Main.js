Ext.define('App.content.pel3.Main', {
	extend : 'App.cmp.Panel',
	id : 'pel3.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.pel3.Search'),
		new Ext.create('App.content.pel3.List'),
		new Ext.create('App.content.pel3.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'pel3.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabPEL3').setLoading(false);
		this.callParent();
	}
});