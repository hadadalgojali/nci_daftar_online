Ext.define('App.content.s5.Main', {
	extend : 'App.cmp.Panel',
	id : 's5.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.s5.Search'),
		new Ext.create('App.content.s5.List'),
		new Ext.create('App.content.s5.Input'),
		new Ext.create('App.cmp.Confirm', {id : 's5.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabS5').setLoading(false);
		this.callParent();
	}
});