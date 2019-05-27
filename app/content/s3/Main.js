Ext.define('App.content.s3.Main', {
	extend : 'App.cmp.Panel',
	id : 's3.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.s3.Search'),
		new Ext.create('App.content.s3.List'),
		new Ext.create('App.content.s3.Input'),
		new Ext.create('App.cmp.Confirm', {id : 's3.confirm'})
	],
	initComponent:function(){
		Ext.getCmp('main.tabS3').setLoading(false);
		this.callParent();
	}
});