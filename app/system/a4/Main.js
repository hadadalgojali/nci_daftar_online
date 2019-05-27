Ext.define('App.system.a4.Main', {
	extend : 'App.cmp.Panel',
	id : 'a4.main',
	layout:'fit',
	items : [
		new Ext.create('App.system.a4.Search'),
		new Ext.create('App.system.a4.List'),
		new Ext.create('App.system.a4.Input'),
		new Ext.create('App.cmp.Confirm', {id : 'a4.confirm'}),
		new Ext.create('App.cmp.ReportPDF', {
			id : 'a4.report',
			url:url + 'app/a4/toPDF',
			parent:'a4.main',
			params:function(){
				return Ext.getCmp('a4.search.panel').qParams();
			}
		})
	],
	initComponent:function(){
		Ext.getCmp('main.tabA4').setLoading(false);
		this.callParent();
	}
});