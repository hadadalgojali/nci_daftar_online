Ext.define('App.content.rs2.Bridging',{
	extend : 'App.cmp.Window',
	id:'rs2.bridging',
	title:'Bridging',
	iconCls:'i-user',
	modal : true,
	dataSep:null,
	dataBpjs:null,
	fbar:[
	     {
	    	 text: 'Simpan',
	    	 iconCls:'i-save',
	    	 id:'rs2.bridging.btnSave',
	    	 handler:function(){
	    		 var req2=Ext.getCmp('rs2.bridging.panel').qGetForm(true);
	    		 if(req2==false){
	    			 Ext.getCmp('rs2.confirm').confirm({
	 					msg : 'Apakah akan menyimpan data ini ?',
	 					allow : 'rs2.save2',
	 					onY : function() {
	 						Ext.getCmp('rs2.bridging').setLoading('Saving');
	 						var param = Ext.getCmp('rs2.bridging.panel').qParams();
	 						param['bpjs']=Ext.getCmp('rs2.bridging').dataBpjs;
	 						param['sep']=Ext.getCmp('rs2.bridging').dataSep;
	 						Ext.Ajax.request({
	 							url : url + 'app/rs2/saveBridging',
	 							method : 'POST',
	 							params:param,
	 							success : function(response) {
	 								Ext.getCmp('rs2.bridging').setLoading(false);
	 								var r = ajaxSuccess(response);
	 								if (r.result == 'SUCCESS') {
	 									Ext.getCmp('rs2.bridging.f1').setValue(r.data);
	 									if(Ext.getCmp('rs2.bridging.f26').getValue() != ''){
	 										Ext.getCmp('rs2.confirm').confirm({
							 					msg : 'Apakah Akan Cetak SEP ?',
							 					allow : 'rs2.cetakSep',
							 					onY : function() {
							 						Ext.getCmp('rs2.bridging').qClose();
	 												Ext.getCmp('rs2.list').refresh();
							 						Ext.getCmp('rs2.report').toPDF();
							 					},onN : function() {
							 						Ext.getCmp('rs2.bridging').qClose();
	 												Ext.getCmp('rs2.list').refresh();
							 					}
	 										});
	 									}else{
	 										Ext.getCmp('rs2.bridging').qClose();
	 										Ext.getCmp('rs2.list').refresh();
	 									}
	 								}
	 							},
	 							failure : function(jqXHR, exception) {
	 								Ext.getCmp('rs2.bridging').setLoading(false);
	 								ajaxError(jqXHR, exception);
	 							}
	 						});
	 					}
	 				});
	    		 }
	    	 }
	     },{
	    	 text: 'Close',
	    	 iconCls:'i-close',
	    	 handler:function(){
	    		 Ext.getCmp('rs2.bridging').close();
	    	 }
	     }
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'rs2.bridging.panel',
			width: 660,
			items:[
			    Ext.create('App.cmp.Panel',{
			    	flex:1,
			    	title:'Poliklinik',
			    	bodyStyle : 'padding: 5px 10px',
			    	items:[
			    		new Ext.create('App.cmp.HiddenField',{
					    	id:'rs2.bridging.idBpjs'
					    }),
					    new Ext.create('App.cmp.HiddenField',{
					    	id:'rs2.bridging.i',
					    	name:'i'
					    }),
					    new Ext.create('App.cmp.HiddenField',{
					    	id:'rs2.bridging.codeDiagnosa',
					    	name:'codeDiagnosa'
					    }),
					    new Ext.create('App.cmp.HiddenField',{
					    	id:'rs2.bridging.noRujukan'
					    }),
					    new Ext.create('App.cmp.Input', {
							label : 'No Medrec',
							nullData : false,
							items : [
								new Ext.create('App.cmp.TextField', {
									id : 'rs2.bridging.f1',
									disabled:true,
									name : 'f1'
								})
							]
						}), 
						new Ext.create('App.cmp.Input', {
							label : 'Tanggal Berobat',
							nullData : false,
							items : [
								new Ext.create('App.cmp.DateField', {
									id : 'rs2.bridging.f29',
									value:new Date(),
									disabled:true,
									name : 'f29'
								})
							]
						}), 
						new Ext.create('App.cmp.Input', {
							label : 'Poliklinik',
							nullData : false,
							items : [
								new Ext.create('App.cmp.DropDown', {
									id : 'rs2.bridging.f25',
									width: 250,
									fields:['id','text','code'],
									emptyText:'Klinik',
									name : 'f25',
									disabled:true,
									submit:'rs2.bridging.btnSave',
									allowBlank : false,
									listeners:{
										select:function(a){
											Ext.getCmp('rs2.bridging.codeUnit').setValue(a.valueModels[0].data.code);
											Ext.getCmp('rs2.bridging.f28').setValue(null);
										}
									}
								}),{
									xtype:'hiddenfield',
									id:'rs2.bridging.codeUnit'
								}
							]
						}), 
						new Ext.create('App.cmp.Input', {
							label : 'Dokter',
							nullData : false,
							items : [
								new Ext.create('App.cmp.AutoComplete',{
									name:'f28',
									submit:'rs2.bridging.btnSave',
									width: 250,
									disabled:true,
									params:function(){
										return {i:Ext.getCmp('rs2.bridging.f25').getValue()};
									},
									id:'rs2.bridging.f28',
									emptyText:'Dokter',
									url:url+'app/RS2/getDokter',
									allowBlank : false
								})
							]
						}),
						new Ext.create('App.cmp.Input', {
							label : 'Diagnosa',
							nullData : false,
							items : [
								new Ext.create('App.cmp.TextField',{
									name:'f27',
									submit:'rs2.bridging.btnSave',
									width: 400,
									disabled:true,
									id:'rs2.bridging.f27',
									emptyText:'Diagnosa',
									allowBlank : false
								})
							]
						})
	    	       ]
			    }),
			     new Ext.create('App.cmp.Panel',{
			    	flex:1,
			    	title:'Data Kunjungan',
			    	bodyStyle : 'padding: 5px 10px',
			    	items:[
						new Ext.create('App.cmp.Input', {
							label : 'Kelompok Pasien',
							nullData : false,
							items : [
								new Ext.create('App.cmp.DropDown', {
									id : 'rs2.bridging.f22',
									width: 250,
									emptyText:'Kelompok Pasien',
									name : 'f22',
									submit:'rs2.bridging.btnSave',
									allowBlank : false,
									listeners:{
										select:function(a){
											if(a.getValue()==Ext.getCmp('rs2.bridging.idBpjs').getValue()){
												Ext.getCmp('rs2.bridging.f23').enable();
												Ext.getCmp('rs2.bridging.f34').enable();
												Ext.getCmp('rs2.bridging.btnSearchKtp').enable();
												Ext.getCmp('rs2.bridging.btnSearchPeserta').enable();
											}else{
												Ext.getCmp('rs2.bridging.f23').disable();
												Ext.getCmp('rs2.bridging.f34').disable();
												Ext.getCmp('rs2.bridging.f24').setValue('');
												Ext.getCmp('rs2.bridging.f26').setValue('');
												Ext.getCmp('rs2.bridging').dataBpjs=null;
												Ext.getCmp('rs2.bridging').dataSep=null;
												Ext.getCmp('rs2.bridging.btnSearchKtp').disable();
												Ext.getCmp('rs2.bridging.btnSearchPeserta').disable();
											}
										}
									}
								})
							]
						}), 
						new Ext.create('App.cmp.Input', {
							label : 'Lakalantas',
							nullData : false,
							items : [
								new Ext.create('App.cmp.CheckBox', {
									id : 'rs2.bridging.f35',
									name : 'f35',
									disabled:false
								})
							]
						}), 
						new Ext.create('App.cmp.Input', {
							label : 'PBI',
							nullData : false,
							items : [
								new Ext.create('App.cmp.CheckBox', {
									id : 'rs2.bridging.f34',
									name : 'f34',
									disabled:true
								})
							]
						}), 
						new Ext.create('App.cmp.Input', {
							label : 'No. Peserta BPJS',
							id:'rs2.bridging.label.f23',
							nullData : false,
							items : [
								new Ext.create('App.cmp.TextField',{
									width: 150,
									name:'f23',
									emptyText:'No Peserta',
									id:'rs2.bridging.f23',
									result:'upper',
									space:false,
									disabled:true,
									allowBlank: false,
									pressEnter:function(a){
										Ext.getCmp('rs2.bridging.btnSearchPeserta').el.dom.click();
									}
								}),
								new Ext.Button({
									text:'Cari Berdasarkan No. Peserta',
									id:'rs2.bridging.btnSearchPeserta',
									disabled:true,
									iconCls:'i-search',
									handler:function(){
										if(Ext.getCmp('rs2.bridging.f27').getValue() == ''){
											Ext.create('App.cmp.Toast').toast({
												msg : "Harap Pilih Diagnosa.",
												type : 'info'
											});
											return false;
										}
										if(Ext.getCmp('rs2.bridging.codeUnit').getValue() == ''){
											Ext.create('App.cmp.Toast').toast({
												msg : 'Harap Pilih Klinik Untuk mendapatkan Nomor SEP.',
												type : 'info'
											});
											return false;
										}
										if(Ext.getCmp('rs2.bridging.f23').getValue() == ''){
											Ext.create('App.cmp.Toast').toast({
												msg : 'Harap isi input nomor kartu peserta.',
												type : 'info'
											});
											return false;
										}
										/*
										Ext.getCmp('rs2.confirm').confirm({
											msg :'Apakah Akan Mencari data BPJS Berdasarkan No. Peserta?',
											allow : 'rs2.bridging.noPeserta',
											onY : function() {
												Ext.getCmp('rs2.bridging').setLoading('Loading..');
												Ext.Ajax.request({
													method:'GET',
													url: url+"app/rs2/getDataBpjs",
													success: function(o){
														var r = ajaxSuccess(o);
														if (r.result == 'SUCCESS') {
															Ext.Ajax.request({
																method:'GET',
																url: r.data.url_briging+Ext.getCmp('rs2.bridging.f23').getValue(),
																headers: {
																	'X-cons-id':r.data.id,
																	'X-timestamp':r.data.timestamp,
																	'X-signature':r.data.signature
																},
																success: function(o1){
																	Ext.getCmp('rs2.bridging').setLoading(false);
																	var cst = Ext.decode(o1.responseText);
																	if(cst.response != null){
																		var p=cst.response.peserta;
																		Ext.getCmp('rs2.bridging').dataBpjs=Ext.encode(p);
																		Ext.getCmp('rs2.bridging.f24').setValue(cst.response.peserta.nama);
																		var lakalatas='2';
																		if(Ext.getCmp('rs2.bridging.f35').getValue()===true){
																			lakalatas='1';
																		}
																		Ext.getCmp('rs2.confirm').confirm({
																			msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																			'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																			allow : 'rs2.bridging.getSep',
																			onY : function() {
																				Ext.getCmp('rs2.bridging').setLoading('Loading..');
																			   var now=new Date();
																			   var date=Ext.Date.format(now,'Y-m-d h:i:s');
																			   $.ajax({
																					type: 'POST',
																					dataType:'JSON',
																					headers: {
																						'Content-type': 'Application/x-www-form-urlencoded',
																						'X-cons-id':r.data.id,
																						'X-timestamp':r.data.timestamp,
																						'X-signature':r.data.signature
																					},
																					url: r.data.url_getSep,
																					data:'<request>'+
																					'<data>'+
																					'<t_sep>'+
																					'<noKartu>'+p.noKartu+'</noKartu>'+
																					'<tglSep>'+date+'</tglSep>'+
																					'<tglRujukan>'+date+'</tglRujukan>'+
																					'<noRujukan>'+Ext.getCmp('rs2.bridging.noRujukan').getValue()+'</noRujukan>'+
																					'<ppkRujukan>'+p.provUmum.kdProvider+'</ppkRujukan>'+
																					'<ppkPelayanan>'+r.data.kd_rs+'</ppkPelayanan>'+
																					'<jnsPelayanan>2</jnsPelayanan>'+
																					'<catatan>dari WS</catatan>'+
																					'<diagAwal>'+Ext.getCmp('rs2.bridging.codeDiagnosa').getValue()+'</diagAwal>'+
																					'<poliTujuan>'+Ext.getCmp('rs2.bridging.codeUnit').getValue()+'</poliTujuan>'+
																					'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																					'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																					'<user>1</user>'+
																					'<noMr></noMr>'+
																					'</t_sep>'+
																					'</data>'+
																					'</request>',
																					success: function(resp1){
																						Ext.getCmp('rs2.bridging').setLoading(false);
																						if(resp1 != null && resp1.response != null){
																							Ext.getCmp('rs2.bridging').dataSep=Ext.encode(resp1);
																							Ext.getCmp('rs2.bridging.btnSave').focus();
																							Ext.getCmp('rs2.bridging.f26').setValue(resp1.response);
																						}else{
																							Ext.getCmp('rs2.bridging').setLoading(false);
																							Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																						}
																					},
																					error: function(jqXHR, exception) {
																						Ext.getCmp('rs2.bridging').setLoading(false);
																						Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																					}
																				});
																			},
																			onN:function(){
																				Ext.getCmp('rs2.bridging.btnSave').focus();
																			}
																		});
																	}else{
																		Ext.getCmp('rs2.bridging').setLoading(false);
																		Ext.create('App.cmp.Toast').toast({
																			msg : "Nomor Peserta '"+Ext.getCmp('rs2.bridging.f23').getValue()+"' tidak ditemukan.",
																			type : 'info'
																		});
																	}
																},
																failure : function(jqXHR, exception) {
																	Ext.getCmp('rs2.bridging').setLoading(false);
																	ajaxError(jqXHR, exception);
																}
															});
														}else{
															Ext.getCmp('rs2.bridging').setLoading(false);
														}
													},
													failure : function(jqXHR, exception) {
														Ext.getCmp('rs2.bridging').setLoading(false);
														ajaxError(jqXHR, exception);
													}
												});
											}
										})
										*/
										Ext.getCmp('rs2.confirm').confirm({
													msg :'Apakah Akan Mencari data BPJS Berdasarkan No. Peserta?',
													allow : 'rs2.bridging.noPeserta',
													onY : function() {
														Ext.getCmp('rs2.bridging').setLoading('Loading..');
														Ext.Ajax.request({
															method:'GET',
															url: url+"app/rs2/getDataBpjs",
															params:{no:Ext.getCmp('rs2.bridging.f23').getValue(),type:'ASS'},
															success: function(o){
																var r = ajaxSuccess(o);
																Ext.getCmp('rs2.bridging').setLoading(false);
																if (r.result == 'SUCCESS') {
																	if(r.data.bpjs.metadata.code=='200'){
																		var p=r.data.bpjs.response.peserta;
																		Ext.getCmp('rs2.bridging').dataBpjs=Ext.encode(p);
																		if(r.data.bpjs.response.peserta != undefined){
																			Ext.getCmp('rs2.bridging.f24').setValue(r.data.bpjs.response.peserta.nama);
																			Ext.getCmp('rs2.confirm').confirm({
																				msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																				'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																				allow : 'rs2.bridging.getSep',
																				onY : function() {
																					Ext.getCmp('rs2.bridging').setLoading('Loading..');
																				   var now=new Date();
																				   var date=Ext.Date.format(now,'Y-m-d h:i:s');
																				   var lakalatas='2';
																					if(Ext.getCmp('rs2.bridging.f35').getValue()===true){
																						lakalatas='1';
																					}
																					
																					var data='<request>'+
																						'<data>'+
																						'<t_sep>'+
																						'<noKartu>'+p.noKartu+'</noKartu>'+
																						'<tglSep>'+date+'</tglSep>'+
																						'<tglRujukan>'+date+'</tglRujukan>'+
																						'<noRujukan>1234590000300003</noRujukan>'+
																						'<ppkRujukan>'+p.provUmum.kdProvider+'</ppkRujukan>'+
																						'<ppkPelayanan>'+r.data.result.kd_rs+'</ppkPelayanan>'+
																						'<jnsPelayanan>2</jnsPelayanan>'+
																						'<catatan>dari WS</catatan>'+
																						'<diagAwal>'+Ext.getCmp('rs2.bridging.f27').getValue()+'</diagAwal>'+
																						'<poliTujuan>'+Ext.getCmp('rs2.bridging.codeUnit').getValue()+'</poliTujuan>'+
																						'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																						'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																						'<user>1</user>'+
																						'<noMr>'+Ext.getCmp('rs2.bridging.f1').getValue()+'</noMr>'+
																						'</t_sep>'+
																						'</data>'+
																						'</request>';
																					var param={
																						urlBriging:r.data.result.url_getSep,
																						data:data,
																						headers:r.data.result.headers
																					}
																				   $.ajax({
																						type: 'POST',
																						dataType:'JSON',
																						url: url+"app/rs2/sep",
																						data:param,
																						success: function(resp1){
																							Ext.getCmp('rs2.bridging').setLoading(false);
																							if(resp1 != null  && resp1.metadata.code=='200'){
																								Ext.getCmp('rs2.bridging').dataSep=Ext.encode(resp1);
																								Ext.getCmp('rs2.bridging.btnSave').focus();
																								Ext.getCmp('rs2.bridging.f26').setValue(resp1.response);
																							}else{
																								Ext.getCmp('rs2.bridging').setLoading(false);
																								Ext.MessageBox.alert('Gagal',resp1.metadata.message);
																							}
																						},
																						error: function(jqXHR, exception) {
																							Ext.getCmp('rs2.bridging').setLoading(false);
																							Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																						}
																					});
																				},
																				onN:function(){
																					Ext.getCmp('rs2.bridging.btnSave').focus();
																				}
																			});
																		}else{
																			Ext.getCmp('rs2.bridging').setLoading(false);
																			Ext.create('App.cmp.Toast').toast({
																				msg : "Nomor Peserta '"+Ext.getCmp('rs2.bridging.f23').getValue()+"' tidak ditemukan.",
																				type : 'info'
																			});
																		}
																	}else{
																		
																		Ext.create('App.cmp.Toast').toast({
																			msg : r.data.bpjs.metadata.message,
																			type : 'info'
																		});
																	}
																	/*
																		
																	Ext.data.JsonP.request({
																		//method: 'POST',
																		//  cors: true,
																		//  useDefaultXhrHeader : false,
																		url: r.data.url_briging+Ext.getCmp('rs2.bridging.f23').getValue(),
																		//type:'json',
																		//cors: true,
																		//useDefaultXhrHeader : false,
																		headers: {
																			'X-cons-id':r.data.id,
																			'X-timestamp':r.data.timestamp,
																			'X-signature':r.data.signature
																		},
																		success: function(o1){
																			Ext.getCmp('rs2.bridging').setLoading(false);
																			var cst = Ext.decode(o1.responseText);
																			if(cst.response != null){
																				var p=cst.response.peserta;
																				Ext.getCmp('rs2.bridging').dataBpjs=Ext.encode(p);
																				if(cst.response.peserta != undefined){
																					Ext.getCmp('rs2.bridging.f24').setValue(cst.response.peserta.nama);
																					Ext.getCmp('rs2.confirm').confirm({
																						msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																						'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																						allow : 'rs2.bridging.getSep',
																						onY : function() {
																							Ext.getCmp('rs2.bridging').setLoading('Loading..');
																						   var now=new Date();
																						   var date=Ext.Date.format(now,'Y-m-d h:i:s');
																						   var lakalatas='2';
																							if(Ext.getCmp('rs2.bridging.f35').getValue()===true){
																								lakalatas='1';
																							}
																						   $.ajax({
																								type: 'POST',
																								dataType:'JSON',
																								headers: {
																									'Content-type': 'Application/x-www-form-urlencoded',
																									'X-cons-id':r.data.id,
																									'X-timestamp':r.data.timestamp,
																									'X-signature':r.data.signature
																								},
																								url: r.data.url_getSep,
																								data:'<request>'+
																								'<data>'+
																								'<t_sep>'+
																								'<noKartu>'+p.noKartu+'</noKartu>'+
																								'<tglSep>'+date+'</tglSep>'+
																								'<tglRujukan>'+date+'</tglRujukan>'+
																								'<noRujukan>1234590000300003</noRujukan>'+
																								'<ppkRujukan>'+p.provUmum.kdProvider+'</ppkRujukan>'+
																								'<ppkPelayanan>'+r.data.kd_rs+'</ppkPelayanan>'+
																								'<jnsPelayanan>2</jnsPelayanan>'+
																								'<catatan>dari WS</catatan>'+
																								'<diagAwal>'+Ext.getCmp('rs2.bridging.f27').getValue()+'</diagAwal>'+
																								'<poliTujuan>'+Ext.getCmp('rs2.bridging.codeUnit').getValue()+'</poliTujuan>'+
																								'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																								'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																								'<user>1</user>'+
																								'<noMr></noMr>'+
																								'</t_sep>'+
																								'</data>'+
																								'</request>',
																								success: function(resp1){
																									Ext.getCmp('rs2.bridging').setLoading(false);
																									if(resp1 != null && resp1.response != null){
																										Ext.getCmp('rs2.bridging').dataSep=Ext.encode(resp1);
																										Ext.getCmp('rs2.bridging.btnSave').focus();
																										Ext.getCmp('rs2.bridging.f26').setValue(resp1.response);
																									}else{
																										Ext.getCmp('rs2.bridging').setLoading(false);
																										Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																									}
																								},
																								error: function(jqXHR, exception) {
																									Ext.getCmp('rs2.bridging').setLoading(false);
																									Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																								}
																							});
																						},
																						onN:function(){
																							Ext.getCmp('rs2.bridging.btnSave').focus();
																						}
																					});
																				}else{
																					Ext.getCmp('rs2.bridging').setLoading(false);
																					Ext.create('App.cmp.Toast').toast({
																						msg : "Nomor Peserta '"+Ext.getCmp('rs2.bridging.f23').getValue()+"' tidak ditemukan.",
																						type : 'info'
																					});
																				}
																			}else{
																				Ext.getCmp('rs2.bridging').setLoading(false);
																				Ext.create('App.cmp.Toast').toast({
																					msg : "Nomor Peserta '"+Ext.getCmp('rs2.bridging.f23').getValue()+"' tidak ditemukan.",
																					type : 'info'
																				});
																			}
																		},
																		failure : function(jqXHR, exception) {
																			Ext.getCmp('rs2.bridging').setLoading(false);
																			ajaxError(jqXHR, exception);
																		}
																	});
																	*/
																}else{
																	Ext.getCmp('rs2.bridging').setLoading(false);
																}
															},
															failure : function(jqXHR, exception) {
																Ext.getCmp('rs2.bridging').setLoading(false);
																ajaxError(jqXHR, exception);
															}
														});
													}
												})
									}
								})
							]
						}), 
						new Ext.create('App.cmp.Input', {
							label : 'No. Ktp',
							items : [
								new Ext.create('App.cmp.TextField',{
									width: 150,
									disabled:true,
									id:'rs2.bridging.ktp'
								}),
								new Ext.Button({
									text:'Cari Berdasarkan NIK',
									id:'rs2.bridging.btnSearchKtp',
									iconCls:'i-search',
									disabled:true,
									handler:function(){
										if(Ext.getCmp('rs2.bridging.f27').getValue() == ''){
											Ext.create('App.cmp.Toast').toast({
												msg : "Harap Pilih Diagnosa.",
												type : 'info'
											});
											return false;
										}
										if(Ext.getCmp('rs2.bridging.codeUnit').getValue() == ''){
											Ext.create('App.cmp.Toast').toast({
												msg : 'Harap Pilih Klinik Untuk mendapatkan Nomor SEP.',
												type : 'info'
											});
											return false;
										}
										if(Ext.getCmp('rs2.bridging.ktp').getValue() == ''){
											Ext.create('App.cmp.Toast').toast({
												msg : 'Harap isi input nomor KTP.',
												type : 'info'
											});
											return false;
										}
										/*
										Ext.getCmp('rs2.confirm').confirm({
											msg :'Apakah Akan Mencari data BPJS Berdasarkan NIK ?',
											allow : 'rs2.bridging.nik',
											onY : function() {
												Ext.getCmp('rs2.bridging').setLoading('Loading..');
												Ext.Ajax.request({
													method:'GET',
													url: url+"app/rs2/getDataBpjs",
													success: function(o){
														var r = ajaxSuccess(o);
														if (r.result == 'SUCCESS') {
															Ext.Ajax.request({
																method:'GET',
																url: r.data.url_briging+'nik/'+Ext.getCmp('rs2.bridging.ktp').getValue(),
																headers: {
																	'X-cons-id':r.data.id,
																	'X-timestamp':r.data.timestamp,
																	'X-signature':r.data.signature
																},
																success: function(o1){
																	Ext.getCmp('rs2.bridging').setLoading(false);
																	var cst = Ext.decode(o1.responseText);
																	if(cst.response != null){
																		if(cst.response.list.length >0){
																			var p=cst.response.list[0];
																			Ext.getCmp('rs2.bridging').dataBpjs=Ext.encode(p);
																			Ext.getCmp('rs2.bridging.f24').setValue(p.nama);
																			Ext.getCmp('rs2.bridging.f23').setValue(p.noKartu);
																			Ext.getCmp('rs2.confirm').confirm({
																				msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																				'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																				allow : 'rs2.bridging.getSep',
																				onY : function() {
																					Ext.getCmp('rs2.bridging').setLoading('Loading..');
																				   var now=new Date();
																				   var date=Ext.Date.format(now,'Y-m-d h:i:s');
																				   var lakalatas='2';
																					if(Ext.getCmp('rs2.bridging.f35').getValue()===true){
																						lakalatas='1';
																					}
																				   $.ajax({
																						type: 'POST',
																						dataType:'JSON',
																						headers: {
																							'Content-type': 'Application/x-www-form-urlencoded',
																							'X-cons-id':r.data.id,
																							'X-timestamp':r.data.timestamp,
																							'X-signature':r.data.signature
																						},
																						url: r.data.url_getSep,
																						data:'<request>'+
																						'<data>'+
																						'<t_sep>'+
																						'<noKartu>'+p.noKartu+'</noKartu>'+
																						'<tglSep>'+date+'</tglSep>'+
																						'<tglRujukan>'+date+'</tglRujukan>'+
																						'<noRujukan>'+Ext.getCmp('rs2.bridging.noRujukan').getValue()+'</noRujukan>'+
																						'<ppkRujukan>'+p.provUmum.kdProvider+'</ppkRujukan>'+
																						'<ppkPelayanan>'+r.data.kd_rs+'</ppkPelayanan>'+
																						'<jnsPelayanan>2</jnsPelayanan>'+
																						'<catatan>dari WS</catatan>'+
																						'<diagAwal>'+Ext.getCmp('rs2.bridging.codeDiagnosa').getValue()+'</diagAwal>'+
																						'<poliTujuan>'+Ext.getCmp('rs2.bridging.codeUnit').getValue()+'</poliTujuan>'+
																						'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																						'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																						'<user>1</user>'+
																						'<noMr></noMr>'+
																						'</t_sep>'+
																						'</data>'+
																						'</request>',
																						success: function(resp1){
																							Ext.getCmp('rs2.bridging').setLoading(false);
																							if(resp1 != null && resp1.response != null){
																								Ext.getCmp('rs2.bridging').dataSep=Ext.encode(resp1);
																								Ext.getCmp('rs2.bridging.btnSave').focus();
																								Ext.getCmp('rs2.bridging.f26').setValue(resp1.response);
																							}else{
																								Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																							}
																						},
																						error: function(jqXHR, exception) {
																							Ext.getCmp('rs2.bridging').setLoading(false);
																							Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																						}
																					});
																				},
																				onN:function(){
																					Ext.getCmp('rs2.bridging.btnSave').focus();
																				}
																			});
																		}else{
																			Ext.getCmp('rs2.bridging').setLoading(false);
																			Ext.create('App.cmp.Toast').toast({
																				msg : "Data BPJS tidak ditemukan",
																				type : 'info'
																			});
																		}
																	}else{
																		Ext.getCmp('rs2.bridging').setLoading(false);
																		Ext.create('App.cmp.Toast').toast({
																			msg : "Nomor Peserta '"+Ext.getCmp('rs2.bridging.f23').getValue()+"' tidak ditemukan.",
																			type : 'info'
																		});
																	}
																},
																failure : function(jqXHR, exception) {
																	Ext.getCmp('rs2.bridging').setLoading(false);
																	ajaxError(jqXHR, exception);
																}
															});
														}else{
															Ext.getCmp('rs2.bridging').setLoading(false);
														}
													},
													failure : function(jqXHR, exception) {
														Ext.getCmp('rs2.bridging').setLoading(false);
														ajaxError(jqXHR, exception);
													}
												});
											}
										})
										*/
										Ext.getCmp('rs2.confirm').confirm({
													msg :'Apakah Akan Mencari data BPJS Berdasarkan NIK ?',
													allow : 'rs2.bridging.nik',
													onY : function() {
														Ext.getCmp('rs2.bridging').setLoading('Loading..');
														Ext.Ajax.request({
															method:'GET',
															url: url+"app/rs2/getDataBpjs",
															params:{no:Ext.getCmp('rs2.bridging.ktp').getValue(),type:'NIK'},
															success: function(o){
																var r = ajaxSuccess(o);
																Ext.getCmp('rs2.bridging').setLoading(false);
																if (r.result == 'SUCCESS') {
																	if(r.data.bpjs.metadata.code=='200'){
																		var p=r.data.bpjs.response.peserta;
																		Ext.getCmp('rs2.bridging').dataBpjs=Ext.encode(p);
																		if(r.data.bpjs.response.peserta != undefined){
																			Ext.getCmp('rs2.bridging.f24').setValue(r.data.bpjs.response.peserta.nama);
																			Ext.getCmp('rs2.confirm').confirm({
																				msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																				'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																				allow : 'rs2.bridging.getSep',
																				onY : function() {
																					Ext.getCmp('rs2.bridging').setLoading('Loading..');
																				   var now=new Date();
																				   var date=Ext.Date.format(now,'Y-m-d h:i:s');
																				   var lakalatas='2';
																					if(Ext.getCmp('rs2.bridging.f35').getValue()===true){
																						lakalatas='1';
																					}
																					
																					var data='<request>'+
																						'<data>'+
																						'<t_sep>'+
																						'<noKartu>'+p.noKartu+'</noKartu>'+
																						'<tglSep>'+date+'</tglSep>'+
																						'<tglRujukan>'+date+'</tglRujukan>'+
																						'<noRujukan>1234590000300003</noRujukan>'+
																						'<ppkRujukan>'+p.provUmum.kdProvider+'</ppkRujukan>'+
																						'<ppkPelayanan>'+r.data.result.kd_rs+'</ppkPelayanan>'+
																						'<jnsPelayanan>2</jnsPelayanan>'+
																						'<catatan>dari WS</catatan>'+
																						'<diagAwal>'+Ext.getCmp('rs2.bridging.f27').getValue()+'</diagAwal>'+
																						'<poliTujuan>'+Ext.getCmp('rs2.bridging.codeUnit').getValue()+'</poliTujuan>'+
																						'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																						'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																						'<user>1</user>'+
																						'<noMr>'+Ext.getCmp('rs2.bridging.f1').getValue()+'</noMr>'+
																						'</t_sep>'+
																						'</data>'+
																						'</request>';
																					var param={
																						urlBriging:r.data.result.url_getSep,
																						data:data,
																						headers:r.data.result.headers
																					}
																				   $.ajax({
																						type: 'POST',
																						dataType:'JSON',
																						url: url+"app/rs2/sep",
																						data:param,
																						success: function(resp1){
																							Ext.getCmp('rs2.bridging').setLoading(false);
																							if(resp1 != null && resp1.metadata.code=='200'){
																								Ext.getCmp('rs2.bridging').dataSep=Ext.encode(resp1);
																								Ext.getCmp('rs2.bridging.btnSave').focus();
																								Ext.getCmp('rs2.bridging.f26').setValue(resp1.response);
																							}else{
																								Ext.getCmp('rs2.bridging').setLoading(false);
																								Ext.MessageBox.alert('Gagal', resp1.metadata.message);
																							}
																						},
																						error: function(jqXHR, exception) {
																							Ext.getCmp('rs2.bridging').setLoading(false);
																							Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																						}
																					});
																				},
																				onN:function(){
																					Ext.getCmp('rs2.bridging.btnSave').focus();
																				}
																			});
																		}else{
																			Ext.getCmp('rs2.bridging').setLoading(false);
																			Ext.create('App.cmp.Toast').toast({
																				msg : "Nomor Peserta '"+Ext.getCmp('rs2.bridging.f23').getValue()+"' tidak ditemukan.",
																				type : 'info'
																			});
																		}
																	}else{
																		
																		Ext.create('App.cmp.Toast').toast({
																			msg : r.data.bpjs.metadata.message,
																			type : 'info'
																		});
																	}
																	/*
																		
																	Ext.data.JsonP.request({
																		//method: 'POST',
																		//  cors: true,
																		//  useDefaultXhrHeader : false,
																		url: r.data.url_briging+Ext.getCmp('rs2.bridging.f23').getValue(),
																		//type:'json',
																		//cors: true,
																		//useDefaultXhrHeader : false,
																		headers: {
																			'X-cons-id':r.data.id,
																			'X-timestamp':r.data.timestamp,
																			'X-signature':r.data.signature
																		},
																		success: function(o1){
																			Ext.getCmp('rs2.bridging').setLoading(false);
																			var cst = Ext.decode(o1.responseText);
																			if(cst.response != null){
																				var p=cst.response.peserta;
																				Ext.getCmp('rs2.bridging').dataBpjs=Ext.encode(p);
																				if(cst.response.peserta != undefined){
																					Ext.getCmp('rs2.bridging.f24').setValue(cst.response.peserta.nama);
																					Ext.getCmp('rs2.confirm').confirm({
																						msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																						'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																						allow : 'rs2.bridging.getSep',
																						onY : function() {
																							Ext.getCmp('rs2.bridging').setLoading('Loading..');
																						   var now=new Date();
																						   var date=Ext.Date.format(now,'Y-m-d h:i:s');
																						   var lakalatas='2';
																							if(Ext.getCmp('rs2.bridging.f35').getValue()===true){
																								lakalatas='1';
																							}
																						   $.ajax({
																								type: 'POST',
																								dataType:'JSON',
																								headers: {
																									'Content-type': 'Application/x-www-form-urlencoded',
																									'X-cons-id':r.data.id,
																									'X-timestamp':r.data.timestamp,
																									'X-signature':r.data.signature
																								},
																								url: r.data.url_getSep,
																								data:'<request>'+
																								'<data>'+
																								'<t_sep>'+
																								'<noKartu>'+p.noKartu+'</noKartu>'+
																								'<tglSep>'+date+'</tglSep>'+
																								'<tglRujukan>'+date+'</tglRujukan>'+
																								'<noRujukan>1234590000300003</noRujukan>'+
																								'<ppkRujukan>'+p.provUmum.kdProvider+'</ppkRujukan>'+
																								'<ppkPelayanan>'+r.data.kd_rs+'</ppkPelayanan>'+
																								'<jnsPelayanan>2</jnsPelayanan>'+
																								'<catatan>dari WS</catatan>'+
																								'<diagAwal>'+Ext.getCmp('rs2.bridging.f27').getValue()+'</diagAwal>'+
																								'<poliTujuan>'+Ext.getCmp('rs2.bridging.codeUnit').getValue()+'</poliTujuan>'+
																								'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																								'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																								'<user>1</user>'+
																								'<noMr></noMr>'+
																								'</t_sep>'+
																								'</data>'+
																								'</request>',
																								success: function(resp1){
																									Ext.getCmp('rs2.bridging').setLoading(false);
																									if(resp1 != null && resp1.response != null){
																										Ext.getCmp('rs2.bridging').dataSep=Ext.encode(resp1);
																										Ext.getCmp('rs2.bridging.btnSave').focus();
																										Ext.getCmp('rs2.bridging.f26').setValue(resp1.response);
																									}else{
																										Ext.getCmp('rs2.bridging').setLoading(false);
																										Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																									}
																								},
																								error: function(jqXHR, exception) {
																									Ext.getCmp('rs2.bridging').setLoading(false);
																									Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																								}
																							});
																						},
																						onN:function(){
																							Ext.getCmp('rs2.bridging.btnSave').focus();
																						}
																					});
																				}else{
																					Ext.getCmp('rs2.bridging').setLoading(false);
																					Ext.create('App.cmp.Toast').toast({
																						msg : "Nomor Peserta '"+Ext.getCmp('rs2.bridging.f23').getValue()+"' tidak ditemukan.",
																						type : 'info'
																					});
																				}
																			}else{
																				Ext.getCmp('rs2.bridging').setLoading(false);
																				Ext.create('App.cmp.Toast').toast({
																					msg : "Nomor Peserta '"+Ext.getCmp('rs2.bridging.f23').getValue()+"' tidak ditemukan.",
																					type : 'info'
																				});
																			}
																		},
																		failure : function(jqXHR, exception) {
																			Ext.getCmp('rs2.bridging').setLoading(false);
																			ajaxError(jqXHR, exception);
																		}
																	});
																	*/
																}else{
																	Ext.getCmp('rs2.bridging').setLoading(false);
																}
															},
															failure : function(jqXHR, exception) {
																Ext.getCmp('rs2.bridging').setLoading(false);
																ajaxError(jqXHR, exception);
															}
														});
														/*
														Ext.getCmp('rs2.bridging').setLoading('Loading..');
														Ext.Ajax.request({
															method:'GET',
															url: url+"app/rs2/getDataBpjs",
															success: function(o){
																var r = ajaxSuccess(o);
																if (r.result == 'SUCCESS') {
																	Ext.Ajax.request({
																		method:'GET',
																		url: r.data.url_briging+'nik/'+Ext.getCmp('rs2.bridging.ktp').getValue(),
																		headers: {
																			'X-cons-id':r.data.id,
																			'X-timestamp':r.data.timestamp,
																			'X-signature':r.data.signature
																		},
																		success: function(o1){
																			Ext.getCmp('rs2.bridging').setLoading(false);
																			var cst = Ext.decode(o1.responseText);
																			if(cst.response != null){
																				if(cst.response.list.length >0){
																					var p=cst.response.list[0];
																					if(cst.response.peserta != undefined){
																						Ext.getCmp('rs2.bridging').dataBpjs=Ext.encode(p);
																						Ext.getCmp('rs2.bridging.f24').setValue(p.nama);
																						Ext.getCmp('rs2.bridging.f23').setValue(p.noKartu);
																						Ext.getCmp('rs2.confirm').confirm({
																							msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																							'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																							allow : 'rs2.bridging.getSep',
																							onY : function() {
																								Ext.getCmp('rs2.bridging').setLoading('Loading..');
																							   var now=new Date();
																							   var date=Ext.Date.format(now,'Y-m-d h:i:s');
																							   var lakalatas='2';
																								if(Ext.getCmp('rs2.bridging.f35').getValue()===true){
																									lakalatas='1';
																								}
																							   $.ajax({
																									type: 'POST',
																									dataType:'JSON',
																									headers: {
																										'Content-type': 'Application/x-www-form-urlencoded',
																										'X-cons-id':r.data.id,
																										'X-timestamp':r.data.timestamp,
																										'X-signature':r.data.signature
																									},
																									url: r.data.url_getSep,
																									data:'<request>'+
																									'<data>'+
																									'<t_sep>'+
																									'<noKartu>'+p.noKartu+'</noKartu>'+
																									'<tglSep>'+date+'</tglSep>'+
																									'<tglRujukan>'+date+'</tglRujukan>'+
																									'<noRujukan>1234590000300003</noRujukan>'+
																									'<ppkRujukan>'+p.provUmum.kdProvider+'</ppkRujukan>'+
																									'<ppkPelayanan>'+r.data.kd_rs+'</ppkPelayanan>'+
																									'<jnsPelayanan>2</jnsPelayanan>'+
																									'<catatan>dari WS</catatan>'+
																									'<diagAwal>'+Ext.getCmp('rs2.bridging.f27').getValue()+'</diagAwal>'+
																									'<poliTujuan>'+Ext.getCmp('rs2.bridging.codeUnit').getValue()+'</poliTujuan>'+
																									'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																									'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																									'<user>1</user>'+
																									'<noMr>234432</noMr>'+
																									'</t_sep>'+
																									'</data>'+
																									'</request>',
																									success: function(resp1){
																										Ext.getCmp('rs2.bridging').setLoading(false);
																										if(resp1 != null && resp1.response != null){
																											Ext.getCmp('rs2.bridging').dataSep=Ext.encode(resp1);
																											Ext.getCmp('rs2.bridging.btnSave').focus();
																											Ext.getCmp('rs2.bridging.f26').setValue(resp1.response);
																										}else{
																											Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																										}
																									},
																									error: function(jqXHR, exception) {
																										Ext.getCmp('rs2.bridging').setLoading(false);
																										Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																									}
																								});
																							},
																							onN:function(){
																								Ext.getCmp('rs2.bridging.btnSave').focus();
																							}
																						});
																					}else{
																						Ext.getCmp('rs2.bridging').setLoading(false);
																						Ext.create('App.cmp.Toast').toast({
																							msg : "Data BPJS tidak ditemukan",
																							type : 'info'
																						});
																					}
																				}else{
																					Ext.getCmp('rs2.bridging').setLoading(false);
																					Ext.create('App.cmp.Toast').toast({
																						msg : "Data BPJS tidak ditemukan",
																						type : 'info'
																					});
																				}
																			}else{
																				Ext.getCmp('rs2.bridging').setLoading(false);
																				Ext.create('App.cmp.Toast').toast({
																					msg : "Nomor Peserta '"+Ext.getCmp('rs2.bridging.f23').getValue()+"' tidak ditemukan.",
																					type : 'info'
																				});
																			}
																		},
																		failure : function(jqXHR, exception) {
																			Ext.getCmp('rs2.bridging').setLoading(false);
																			ajaxError(jqXHR, exception);
																		}
																	});
																}else{
																	Ext.getCmp('rs2.bridging').setLoading(false);
																}
															},
															failure : function(jqXHR, exception) {
																Ext.getCmp('rs2.bridging').setLoading(false);
																ajaxError(jqXHR, exception);
															}
														});
														*/
													}
												})
									}
								})
							]
						}),
						new Ext.create('App.cmp.Input', {
							label : 'Nama Peserta',
							items : [
								new Ext.create('App.cmp.TextField',{
									width: 250,
									name:'f24',
									disabled:true,
									emptyText:'Nama Peserta',
									id:'rs2.bridging.f24'
								})
							]
						}),
						new Ext.create('App.cmp.Input', {
							label : 'No SEP',
							items : [
								new Ext.create('App.cmp.TextField',{
									width: 150,
									name:'f26',
									disabled:true,
									emptyText:'No SEP',
									id:'rs2.bridging.f26'
								})
							]
						})
	    	       ]
			    })
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('rs2.bridging.panel').qGetForm() == false) {
			Ext.getCmp('rs2.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'rs2.bridging.close',
				onY : function() {
					$this.qClose();
				}
			});
		} else {
			$this.qClose();
		}
		return false;
	}
})