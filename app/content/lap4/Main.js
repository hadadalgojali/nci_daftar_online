Ext.define('App.content.lap4.Main',{
	extend : 'App.cmp.WindowMain',
	iconCls:'i-lap',
	id:'lap4',
	title:'Laporan Register Detail',
	fbar: [{
		text: 'Cetak',
		iconCls:'i-print',
		id:'lap4.btnCetak',
		handler: function() {
			var req=Ext.getCmp('lap4.panel').qGetForm(true);
			if(req==false){
				if(Ext.getCmp('lap4.f4').getValue()=='A'){
					new Ext.create('App.cmp.ReportPDF', {
						id : 'lap4.report',
						url:url + 'app/lap4/toPDF',
						parent:'lap4',
						closeAction:'destroy',
						params:function(){
							return Ext.getCmp('lap4.panel').qParams();
						}
					}).toPDF();
				}else{
					var post='f1='+Ext.getCmp('lap4.f1').val()+'&';
		            	post+='f2='+Ext.getCmp('lap4.f2').val()+'&';
		            	post+='f3='+Ext.getCmp('lap4.f3').getValue()+'&';
		            	post+='f4='+Ext.getCmp('lap4.f4').getValue();
		            	window.open(url + 'app/lap4/toPDF?'+post);
				}
				Ext.getCmp('lap4').close();
			}
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('lap4').close();
		}
	}],
	initComponent:function(){
		this.items=[
			new Ext.create('App.cmp.Panel',{
				bodyStyle : 'padding: 5px 10px',
				id : 'lap4.panel',
				width: 350,
				items:[
					new Ext.create('App.cmp.Input', {
						label : 'Periode',
						nullData : false,
						items : [
							new Ext.create('App.cmp.DateField', {
								id : 'lap4.f1',
								name : 'f1',
								value:new Date(),
								submit:'lap4.btnCetak',
								emptyText: 'Dari',
								allowBlank: false
							}),
							new Ext.create('Ext.form.DisplayField', {
								value:' &nbsp; - &nbsp; '
							}),
							new Ext.create('App.cmp.DateField', {
								id : 'lap4.f2',
								name : 'f2',
								value:new Date(),
								submit:'lap4.btnCetak',
								emptyText: 'Sampai',
								allowBlank: false
							})
						]
					}),
					new Ext.create('App.cmp.Input', {
						label : 'Poliklinik',
						items : [
							new Ext.create('App.cmp.DropDown', {
								id : 'lap4.f3',
								name : 'f3',
								width: 200,
								submit:'lap4.btnCetak',
								emptyText: 'Poliklinik'
							})
						]
					}),
					new Ext.create('App.cmp.Input', {
						label : 'Type',
						nullData : false,
						items : [
							new Ext.create('App.cmp.DropDown', {
								id : 'lap4.f4',
								name : 'f4',
								data:[
									{id:'A',text:'Pdf'},
									{id:'B',text:'Excel'},
									{id:'C',text:'Word'}
								],
								width: 200,
								submit:'lap4.btnCetak',
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
					Ext.getCmp('lap4.f3').addReset(r.data.l);
					Ext.getCmp('lap4.panel').qSetForm();
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