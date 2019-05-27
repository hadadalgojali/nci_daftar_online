Ext.define('App.content.lap1.Main',{
	extend : 'App.cmp.WindowMain',
	iconCls:'i-lap',
	id:'lap1',
	title:'Laporan Register',
	fbar: [{
		text: 'Cetak',
		iconCls:'i-print',
		id:'lap1.btnCetak',
		handler: function() {
			var req=Ext.getCmp('lap1.panel').qGetForm(true);
			if(req==false){
				if(Ext.getCmp('lap1.f4').getValue()=='A'){
					new Ext.create('App.cmp.ReportPDF', {
						id : 'lap1.report',
						url:url + 'app/lap1/toPDF',
						parent:'lap1',
						closeAction:'destroy',
						params:function(){
							return Ext.getCmp('lap1.panel').qParams();
						}
					}).toPDF();
				}else{
					var post='f1='+Ext.getCmp('lap1.f1').val()+'&';
		            	post+='f2='+Ext.getCmp('lap1.f2').val()+'&';
		            	post+='f3='+Ext.getCmp('lap1.f3').getValue()+'&';
		            	post+='f4='+Ext.getCmp('lap1.f4').getValue();
		            	window.open(url + 'app/lap1/toPDF?'+post);
				}
				Ext.getCmp('lap1').close();
			}
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('lap1').close();
		}
	}],
	initComponent:function(){
		this.items=[
			new Ext.create('App.cmp.Panel',{
				bodyStyle : 'padding: 5px 10px',
				id : 'lap1.panel',
				width: 350,
				items:[
					new Ext.create('App.cmp.Input', {
						label : 'Periode',
						nullData : false,
						items : [
							new Ext.create('App.cmp.DateField', {
								id : 'lap1.f1',
								name : 'f1',
								value:new Date(),
								submit:'lap1.btnCetak',
								emptyText: 'Dari',
								allowBlank: false
							}),
							new Ext.create('Ext.form.DisplayField', {
								value:' &nbsp; - &nbsp; '
							}),
							new Ext.create('App.cmp.DateField', {
								id : 'lap1.f2',
								name : 'f2',
								value:new Date(),
								submit:'lap1.btnCetak',
								emptyText: 'Sampai',
								allowBlank: false
							})
						]
					}),
					new Ext.create('App.cmp.Input', {
						label : 'Poliklinik',
						items : [
							new Ext.create('App.cmp.DropDown', {
								id : 'lap1.f3',
								name : 'f3',
								width: 200,
								submit:'lap1.btnCetak',
								emptyText: 'Poliklinik'
							})
						]
					}),
					new Ext.create('App.cmp.Input', {
						label : 'Type',
						nullData : false,
						items : [
							new Ext.create('App.cmp.DropDown', {
								id : 'lap1.f4',
								name : 'f4',
								data:[
									{id:'A',text:'Pdf'},
									{id:'B',text:'Excel'},
									{id:'C',text:'Word'}
								],
								width: 200,
								submit:'lap1.btnCetak',
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
			url : url + 'app/lap1/getVar',
			method : 'GET',
			success : function(response) {
				var r = ajaxSuccess(response);
				if (r.result == 'SUCCESS') {
					Ext.getCmp('lap1.f3').addReset(r.data.l);
					Ext.getCmp('lap1.panel').qSetForm();
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