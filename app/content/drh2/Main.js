Ext.define('App.content.drh2.Main', {
	extend : 'App.cmp.Panel',
	id : 'drh2.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.drh2.Search'),
		new Ext.create('App.content.drh2.List'),
		new Ext.create('App.content.drh2.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'drh2.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabDRH2').setLoading(false);
		this.callParent();
	}
});