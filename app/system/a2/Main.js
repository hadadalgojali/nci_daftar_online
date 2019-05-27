Ext.define('App.system.a2.Main', {
	extend : 'App.cmp.Panel',
	id : 'a2.main',
	items : [
		new Ext.create('App.system.a2.List'),
		new Ext.create('App.system.a2.Input'),
		new Ext.create('App.cmp.Confirm', {
			id : 'a2.confirm'
		})
	]
});