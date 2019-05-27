Ext.define('App.content.drh1.Main', {
	extend : 'App.cmp.Panel',
	id : 'drh1.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.drh1.Search'),
		new Ext.create('App.content.drh1.List'),
		new Ext.create('App.content.drh1.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'drh1.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabDRH1').setLoading(false);
		this.callParent();
	}
});