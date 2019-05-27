Ext.define('App.content.s6.Main', {
	extend : 'App.cmp.Panel',
	id : 's6.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.s6.Search'),
		new Ext.create('App.content.s6.List'),
		new Ext.create('App.content.s6.Input'),
		new Ext.create('App.cmp.Confirm', {id : 's6.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabS6').setLoading(false);
		this.callParent();
	}
});