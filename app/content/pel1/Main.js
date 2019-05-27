Ext.define('App.content.pel1.Main', {
	extend : 'App.cmp.Panel',
	id : 'pel1.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.pel1.Search'),
		new Ext.create('App.content.pel1.List'),
		new Ext.create('App.content.pel1.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'pel1.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabPEL1').setLoading(false);
		this.callParent();
	}
});