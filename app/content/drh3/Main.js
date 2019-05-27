Ext.define('App.content.drh3.Main', {
	extend : 'App.cmp.Panel',
	id : 'drh3.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.drh3.Search'),
		new Ext.create('App.content.drh3.List'),
		new Ext.create('App.content.drh3.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'drh3.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabDRH3').setLoading(false);
		this.callParent();
	}
});