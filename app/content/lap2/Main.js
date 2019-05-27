Ext.define('App.content.lap2.Main',{
	extend : 'App.cmp.WindowMain',
	iconCls:'i-lap',
	id:'lap2',
	title:'Laporan Index Perdaerah',
	fbar: [{
		text: 'Cetak',
		iconCls:'i-print',
		id:'lap2.btnCetak',
		handler: function() {
			var req=Ext.getCmp('lap2.panel').qGetForm(true);
			if(req==false){
				if(Ext.getCmp('lap2.f3').getValue()=='A'){
					new Ext.create('App.cmp.ReportPDF', {
						id : 'lap2.report',
						url:url + 'app/lap2/toPDF',
						parent:'lap2',
						closeAction:'destroy',
						params:function(){
							return Ext.getCmp('lap2.panel').qParams();
						}
					}).toPDF();
				}else{
					var post='f1='+Ext.getCmp('lap2.f1').val()+'&';
		            	post+='f2='+Ext.getCmp('lap2.f2').getValue()+'&';
		            	post+='f3='+Ext.getCmp('lap2.f3').getValue()+'&';
		            	window.open(url + 'app/lap2/toPDF?'+post);
				}
				Ext.getCmp('lap2').close();
			}
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('lap2').close();
		}
	}],
	initComponent:function(){
		this.items=[
			new Ext.create('App.cmp.Panel',{
				bodyStyle : 'padding: 5px 10px',
				id : 'lap2.panel',
				width: 350,
				items:[
					new Ext.create('App.cmp.Input', {
						label : 'Periode',
						nullData : false,
						items : [
							new Ext.create('App.cmp.DateField', {
								id : 'lap2.f1',
								name : 'f1',
								value:new Date(),
								format:'M Y',
								submit:'lap2.btnCetak',
								emptyText: 'Periode',
								allowBlank: false
							})
						]
					}),
					new Ext.create('App.cmp.Input', {
						label : 'Wilayah',
						nullData : false,
						items : [
							new Ext.create('App.cmp.DropDown', {
								id : 'lap2.f2',
								name : 'f2',
								width: 200,
								submit:'lap2.btnCetak',
								emptyText: 'Wilayah',
								allowBlank: false
							})
						]
					}),
					new Ext.create('App.cmp.Input', {
						label : 'Type',
						nullData : false,
						items : [
							new Ext.create('App.cmp.DropDown', {
								id : 'lap2.f3',
								name : 'f3',
								data:[
									{id:'A',text:'Pdf'},
									{id:'B',text:'Excel'},
									{id:'C',text:'Word'}
								],
								width: 200,
								submit:'lap2.btnCetak',
								emptyText: 'Type',
								allowBlank: false
							})
						]
					})
				]
			})
		];
		this.callParent();
		Ext.Ajax.request({
			url : url + 'app/lap2/getVar',
			method : 'GET',
			success : function(response) {
				var r = ajaxSuccess(response);
				if (r.result == 'SUCCESS') {
					Ext.getCmp('lap2.f2').addReset(r.data.l);
					Ext.getCmp('lap2.panel').qSetForm();
				}else{
					$this.close();
				}
			},
			failure : function(jqXHR, exception) {
				ajaxError(jqXHR, exception);
			}
		});
	}
})