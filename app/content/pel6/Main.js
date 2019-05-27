Ext.define('App.content.pel6.Main', {
	extend : 'App.cmp.Panel',
	id : 'pel6.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.pel6.Search'),
		new Ext.create('App.content.pel6.List'),
		new Ext.create('App.content.pel6.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'pel6.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabPEL6').setLoading(false);
		this.callParent();
	}
});