Ext.define('App.content.rs1.SearchInput',{
	extend : 'App.cmp.Window',
	id:'rs1.searchInput',
	title:'Pencarian',
	iconCls:'i-user',
	modal : true,
	fbar:[
	     {
	    	 text: 'Close',
	    	 iconCls:'i-close',
	    	 handler:function(){
	    		 Ext.getCmp('rs1.searchInput').close();
	    	 }
	     },{
	    	 text: 'Cari',
	    	 iconCls:'i-search',
	    	 id:'rs1.searchInput.btnSearch',
	    	 handler:function(){
					var param = Ext.getCmp('rs1.searchInput.panel').qParams();
					Ext.getCmp('rs1.searchInput').setLoading('Mengambil');
					Ext.Ajax.request({
						url : url + 'app/rs1/searchMedrec',
						method : 'GET',
						params:param,
						success : function(response) {
							Ext.getCmp('rs1.searchInput').setLoading(false);
							var r = ajaxSuccess(response);
							if (r.result == 'SUCCESS') {
								var o=r.data.o;
									Ext.getCmp('rs1.daftarBaru').closing = false;
									Ext.getCmp('rs1.daftarBaru.f12').disable();
									Ext.getCmp('rs1.daftarBaru.f14').disable();
									Ext.getCmp('rs1.daftarBaru.f16').disable();
									Ext.getCmp('rs1.daftarBaru.f18').disable();
									Ext.getCmp('rs1.daftarBaru.f20').disable();
									Ext.getCmp('rs1.daftarBaru.f23').disable();
									Ext.getCmp('rs1.daftarBaru.btnSearchKtp').disable();
									Ext.getCmp('rs1.daftarBaru.btnSearchPeserta').disable();
									Ext.getCmp('rs1.daftarBaru.panel.2').hide();
									Ext.getCmp('rs1.daftarBaru.panel.1').show();
									Ext.getCmp('rs1.daftarBaru').show();
									Ext.getCmp('rs1.daftarBaru.panel').qReset();
									Ext.getCmp('rs1.daftarBaru.panel').qSetForm();
									Ext.getCmp('rs1.daftarBaru.panel.1').qSetForm();
									Ext.getCmp('rs1.daftarBaru.panel.2').qSetForm();
									Ext.getCmp('rs1.daftarBaru.idBpjs').setValue(r.data.d);
									if(r.data.t==1){
										Ext.getCmp('rs1.daftarBaru.p').setValue('UPDATE');
									}else{
										Ext.getCmp('rs1.daftarBaru.p').setValue('ADD');
									}
									Ext.getCmp('rs1.daftarBaru.f1').setValue(o.f1);
									Ext.getCmp('rs1.daftarBaru.f2').setValue(o.f2);
									Ext.getCmp('rs1.daftarBaru.f3').setValue(o.f3);
									Ext.getCmp('rs1.daftarBaru.f4').setValue(o.f4);
									Ext.getCmp('rs1.daftarBaru.i').setValue(o.i);
									Ext.getCmp('rs1.daftarBaru.f5').setValue(o.f5);
									Ext.getCmp('rs1.daftarBaru.f6').setValue(o.f6);
									Ext.getCmp('rs1.daftarBaru.f7').setValue(o.f7);
									Ext.getCmp('rs1.daftarBaru.f8').setValue(o.f8);
									Ext.getCmp('rs1.daftarBaru.f9').setValue(o.f9);
									Ext.getCmp('rs1.daftarBaru.f10').setValue(o.f10);
									Ext.getCmp('rs1.daftarBaru.f11').setValue(o.f11);
									Ext.getCmp('rs1.daftarBaru.f11').setRawValue(o.f11t);
									if(o.f11==0){
										Ext.getCmp('rs1.daftarBaru.f12').enable();
									}
									if(o.f13==0){
										Ext.getCmp('rs1.daftarBaru.f14').enable();
									}
									if(o.f15==0){
										Ext.getCmp('rs1.daftarBaru.f16').enable();
									}
									if(o.f17==0){
										Ext.getCmp('rs1.daftarBaru.f18').enable();
									}
									if(o.f19==0){
										Ext.getCmp('rs1.daftarBaru.f20').enable();
									}
									Ext.getCmp('rs1.daftarBaru.f12').setValue(o.f12);
									Ext.getCmp('rs1.daftarBaru.f13').setValue(o.f13);
//									Ext.getCmp('rs1.daftarBaru.f13').setRawValue(o.f13t);
									Ext.getCmp('rs1.daftarBaru.f14').setValue(o.f14);
									Ext.getCmp('rs1.daftarBaru.f15').setValue(o.f15);
//									Ext.getCmp('rs1.daftarBaru.f15').setRawValue(o.f15t);
									Ext.getCmp('rs1.daftarBaru.f16').setValue(o.f16);
									Ext.getCmp('rs1.daftarBaru.f17').setValue(o.f17);
//									Ext.getCmp('rs1.daftarBaru.f17').setRawValue(o.f17t);
									Ext.getCmp('rs1.daftarBaru.f18').setValue(o.f18);
									Ext.getCmp('rs1.daftarBaru.f19').setValue(o.f19);
//									Ext.getCmp('rs1.daftarBaru.f19').setRawValue(o.f19t);
									Ext.getCmp('rs1.daftarBaru.f20').setValue(o.f20);
									Ext.getCmp('rs1.daftarBaru.f21').setValue(o.f21);
									Ext.getCmp('rs1.daftarBaru.f30').setValue(o.f30);
									Ext.getCmp('rs1.daftarBaru.f31').setValue(o.f31);
									Ext.getCmp('rs1.daftarBaru.f32').setValue(o.f32);
									Ext.getCmp('rs1.daftarBaru.f33').setValue(o.f33);
									
									Ext.getCmp('rs1.daftarBaru.f33').focus();
									Ext.getCmp('rs1.searchInput').qClose();
							}
						},
						failure : function(jqXHR, exception) {
							Ext.getCmp('rs1.searchInput').setLoading(false);
							ajaxError(jqXHR, exception);
						}
					});
	    	 }
	     }
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'rs1.searchInput.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 350,
			items:[
				new Ext.create('App.cmp.Input',{
					label:'No Medrec',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							name:'f1',
							submit:'rs1.searchInput.btnSearch',
							emptyText:'No. Medrec',
							id:'rs1.searchInput.f1'
						})
					]
				})
			]
		})
	]
})