Ext.define('App.content.drh4.Main', {
	extend : 'App.cmp.Panel',
	id : 'drh4.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.drh4.Search'),
		new Ext.create('App.content.drh4.List'),
		new Ext.create('App.content.drh4.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'drh4.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabDRH4').setLoading(false);
		this.callParent();
	}
});