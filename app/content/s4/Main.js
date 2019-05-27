Ext.define('App.content.s4.Main', {
	extend : 'App.cmp.Panel',
	id : 's4.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.s4.Search'),
		new Ext.create('App.content.s4.List'),
		new Ext.create('App.content.s4.Input'),
		new Ext.create('App.cmp.Confirm', {id : 's4.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabS4').setLoading(false);
		this.callParent();
	}
});