Ext.define('App.content.rs3.Main', {
	extend : 'App.cmp.Panel',
	id : 'rs3.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.rs3.Search'),
		new Ext.create('App.content.rs3.Verifikasi'),
		new Ext.create('App.content.rs3.List'),
		new Ext.create('App.content.rs3.RujukBalik'),
		new Ext.create('App.cmp.Confirm', {id : 'rs3.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabRS3').setLoading(false);
		this.callParent();
	}
});