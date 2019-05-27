Ext.define('App.content.drh5.Main', {
	extend : 'App.cmp.Panel',
	id : 'drh5.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.drh5.Search'),
		new Ext.create('App.content.drh5.List'),
		new Ext.create('App.content.drh5.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'drh5.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabDRH5').setLoading(false);
		this.callParent();
	}
});