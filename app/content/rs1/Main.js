Ext.define('App.content.rs1.Main', {
	extend : 'App.cmp.Panel',
	id : 'rs1.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.rs1.Search'),
		new Ext.create('App.content.rs1.SearchInput'),
		new Ext.create('App.content.rs1.List'),
		new Ext.create('App.content.rs1.DaftarBaru'),
		new Ext.create('App.cmp.Confirm', {id : 'rs1.confirm'}),
		new Ext.create('App.cmp.ReportPDF', {
			id : 'rs1.report',
			url:url + 'app/rs1/cetakSep',
			parent:'rs1.main',
			params:function(){
				return {
					bpjs:Ext.getCmp('rs1.daftarBaru').dataBpjs,
					sep:Ext.getCmp('rs1.daftarBaru').dataSep,
					medrec:Ext.getCmp('rs1.daftarBaru.f1').getValue(),
					poli:Ext.getCmp('rs1.daftarBaru.f25').getValue(),
					diagnosa:Ext.getCmp('rs1.daftarBaru.f27').getValue()
				}
			}
		})
	],
	initComponent:function(){
		Ext.getCmp('main.tabRS1').setLoading(false);
		this.callParent();
	}
});