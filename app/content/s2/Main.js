Ext.define('App.content.s2.Main', {
	extend : 'App.cmp.Panel',
	id : 's2.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.s2.Search'),
		new Ext.create('App.content.s2.List'),
		new Ext.create('App.content.s2.Input'),
		new Ext.create('App.cmp.Confirm', {id : 's2.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabS2').setLoading(false);
		this.callParent();
	}
});