Ext.define('App.content.rs2.Main', {
	extend : 'App.cmp.Panel',
	id : 'rs2.main',
	layout:'fit',
	items : [
		new Ext.create('App.content.rs2.Search'),
		new Ext.create('App.content.rs2.List'),
		new Ext.create('App.content.rs2.Status'),
		new Ext.create('App.content.rs2.Hadir'),
		new Ext.create('App.content.rs2.Edit'),
		new Ext.create('App.content.rs2.Bridging'),
		new Ext.create('App.cmp.Confirm', {id : 'rs2.confirm'}),
		new Ext.create('App.cmp.ReportPDF', {
			id : 'rs2.report',
			url:url + 'app/rs2/cetakSep2',
			parent:'rs2.main',
			params:function(){
				return {
					medrec:Ext.getCmp('rs2.bridging.f1').getValue(),
					poli:Ext.getCmp('rs2.bridging.f25').getValue(),
					diagnosa:Ext.getCmp('rs2.bridging.codeDiagnosa').getValue(),
					bpjs:Ext.getCmp('rs2.bridging').dataBpjs,
					sep:Ext.getCmp('rs2.bridging').dataSep
				}
			}
		}),
		new Ext.create('App.cmp.ReportPDF', {
			id : 'rs2.cetakSep',
			url:url + 'app/rs2/cetakSep',
			parent:'rs2.main',
			params:function(){
				return {
					i:Ext.getCmp('rs2.list').dataRow.i
				}
			}
		}),
		new Ext.create('App.cmp.ReportPDF', {
			id : 'rs2.cetakPasien',
			url:url + 'app/rs2/cetakPasien',
			parent:'rs2.main',
			params:function(){
				return {
					i:Ext.getCmp('rs2.list').dataRow.i
				}
			}
		}),
		new Ext.create('App.cmp.ReportPDF', {
			id : 'rs2.cetakTracer',
			url:url + 'app/rs2/cetakTracer',
			parent:'rs2.main',
			params:function(){
				return {
					i:Ext.getCmp('rs2.list').dataRow.i
				}
			}
		})
	],
	initComponent:function(){
		Ext.getCmp('main.tabRS2').setLoading(false);
		this.callParent();
	}
});