Ext.define('App.content.rs1.DaftarBaru',{
	extend : 'App.cmp.Window',
	id:'rs1.daftarBaru',
	title:'Pendaftaran',
	iconCls:'i-user',
	modal : true,
	dataSep:null,
	dataBpjs:null,
	fbar:[
	     {
	    	 text: 'Close',
	    	 iconCls:'i-close',
	    	 handler:function(){
	    		 Ext.getCmp('rs1.daftarBaru').close();
	    	 }
	     },{
	    	 text: 'Simpan',
	    	 iconCls:'i-save',
	    	 id:'rs1.daftarBaru.btnSave',
	    	 handler:function(){
	    		 var req1=Ext.getCmp('rs1.daftarBaru.panel.1').qGetForm(true);
	    		 var req2=Ext.getCmp('rs1.daftarBaru.panel.2').qGetForm(true);
	    		 if(req1==false && req2==false){
	    			 Ext.getCmp('rs1.confirm').confirm({
	 					msg : 'Apakah akan menyimpan data ini ?',
	 					allow : 'rs1.save2',
	 					onY : function() {
	 						Ext.getCmp('rs1.daftarBaru').setLoading('Saving');
	 						var param = Ext.getCmp('rs1.daftarBaru.panel').qParams();
	 						param['bpjs']=Ext.getCmp('rs1.daftarBaru').dataBpjs;
	 						param['sep']=Ext.getCmp('rs1.daftarBaru').dataSep;
	 						Ext.Ajax.request({
	 							url : url + 'app/rs1/save',
	 							method : 'POST',
	 							params:param,
	 							success : function(response) {
	 								Ext.getCmp('rs1.daftarBaru').setLoading(false);
	 								var r = ajaxSuccess(response);
	 								if (r.result == 'SUCCESS') {
	 									Ext.getCmp('rs1.daftarBaru.f1').setValue(r.data);
	 									if(Ext.getCmp('rs1.daftarBaru.f26').getValue() != ''){
	 										Ext.getCmp('rs1.confirm').confirm({
							 					msg : 'Apakah Akan Cetak SEP ?',
							 					allow : 'rs1.cetakSep',
							 					onY : function() {
							 						Ext.getCmp('rs1.daftarBaru').qClose();
	 												Ext.getCmp('rs1.list').refresh();
							 						Ext.getCmp('rs1.report').toPDF();
							 					},onN : function() {
							 						Ext.getCmp('rs1.daftarBaru').qClose();
	 												Ext.getCmp('rs1.list').refresh();
							 					}
	 										});
	 									}else{
	 										Ext.getCmp('rs1.daftarBaru').qClose();
	 										Ext.getCmp('rs1.list').refresh();
	 									}
	 								}
	 							},
	 							failure : function(jqXHR, exception) {
	 								Ext.getCmp('rs1.daftarBaru').setLoading(false);
	 								ajaxError(jqXHR, exception);
	 							}
	 						});
	 					}
	 				});
	    		 }else{
	    			 if(req1!=false){
	    				 Ext.getCmp('rs1.daftarBaru.panel.2').hide();
	    				 Ext.getCmp('rs1.daftarBaru.panel.1').show();
	    			 }else if(req2!=false){
	    				 Ext.getCmp('rs1.daftarBaru.panel.1').hide();
	    				 Ext.getCmp('rs1.daftarBaru.panel.2').show();
	    			 }
	    		 }
	    	 }
	     }
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'rs1.daftarBaru.panel',
			width: 680,
			items:[
				new Ext.create('App.cmp.Panel',{
					id : 'rs1.daftarBaru.panel.1',
					bodyStyle : 'padding: 5px 10px',
					width: 660,
					title:'Data Pasien',
					layout:'column',
					fbar:[
					     {
					    	 text: 'Selanjuntnya',
					    	 iconCls:'i-next',
					    	 iconAlign:'right',
					    	 id:'rs1.daftarBaru.btnNext1',
					    	 handler:function(){
					    		 var req=Ext.getCmp('rs1.daftarBaru.panel.1').qGetForm(true);
					    		 if(req==false){
									Ext.getCmp('rs1.daftarBaru.panel.1').hide();
									Ext.getCmp('rs1.daftarBaru.panel.2').show();
									Ext.getCmp('rs1.daftarBaru.ktp').setValue(Ext.getCmp('rs1.daftarBaru.f33').getValue());
									Ext.getCmp('rs1.daftarBaru').center();
									Ext.getCmp('rs1.daftarBaru.f25').focus();
					    		 }
					    	 }
					     }
					],
					items:[
						new Ext.create('App.cmp.Panel',{
							width: 320,
							items:[
							    new Ext.create('App.cmp.HiddenField',{
							    	id:'rs1.daftarBaru.idBpjs'
							    }),
							    new Ext.create('App.cmp.HiddenField',{
							    	id:'rs1.daftarBaru.i',
							    	name:'i'
							    }),
							     new Ext.create('App.cmp.HiddenField',{
							    	id:'rs1.daftarBaru.p',
							    	name:'p'
							    }),
								new Ext.create('App.cmp.Input',{
									label:'No Medrec',
									items:[
										new Ext.create('App.cmp.TextField',{
											width: 120,
											name:'f1',
											disabled:true,
											emptyText:'No Medrec',
											id:'rs1.daftarBaru.f1'
										})
//										new Ext.Button({
//											iconCls:'i-search',
//											text:'Cari Medrec',
//											handler:function(){
//												Ext.getCmp('rs1.searchInput.f1').setValue('');
//												Ext.getCmp('rs1.searchInput').show();
//												Ext.getCmp('rs1.searchInput.f1').focus();
//											}
//										})
									]
								}),
								 new Ext.create('App.cmp.Input',{
									label:'No. KTP',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											width: 150,
											maxLength:16,
											name:'f33',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'No. KTP',
											id:'rs1.daftarBaru.f33',
											space:false,
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Gelar',
									items:[
										new Ext.create('App.cmp.TextField',{
											width: 100,
											maxLength:16,
											name:'f31',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'Gelar',
											id:'rs1.daftarBaru.f31',
											result:'dynamic'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Nama Pasien',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											width: 200,
											maxLength:128,
											name:'f2',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'Nama Pasien',
											maxLength:32,
											id:'rs1.daftarBaru.f2',
											result:'dynamic',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label:'Tempat Lahir',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DynamicOption',{
											name:'f3',
											width: 200,
											maxLength:32,
											type:'DYNAMIC_CITY',
											submit:'rs1.daftarBaru.btnNext1',
											id:'rs1.daftarBaru.f3',
											emptyText:'Tempat Lahir',
											allowBlank : false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Tanggal Lahir',
									nullData : false,
									items:[
										new Ext.create('App.cmp.DateField',{
											name:'f4',
											emptyText:'Tanggal Lahir',
											submit:'rs1.daftarBaru.btnNext1',
											width: 100,
											maxValue: new Date() ,
											id:'rs1.daftarBaru.f4',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Gender',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 'rs1.daftarBaru.f5',
											width: 100,
											emptyText:'Gender',
											name : 'f5',
											submit:'rs1.daftarBaru.btnNext1',
											allowBlank : false
										})
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label : 'Religion',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 'rs1.daftarBaru.f6',
											emptyText:'Religion',
											width: 120,
											name : 'f6',
											submit:'rs1.daftarBaru.btnNext1',
											allowBlank : false
										})
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label : 'Pend. Terakhir',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 'rs1.daftarBaru.f7',
											emptyText:'Pendidikan Terakhir',
											width: 150,
											name : 'f7',
											submit:'rs1.daftarBaru.btnNext1',
											allowBlank : false
										})
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label : 'Gol. Darah',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 'rs1.daftarBaru.f30',
											emptyText:'Gol. Darah',
											width: 100,
											name : 'f30',
											submit:'rs1.daftarBaru.btnNext1',
											allowBlank : false
										})
									]
								}), 
								new Ext.create('App.cmp.Input',{
									label:'Alamat',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextArea',{
											name:'f8',
											emptyText:'Alamat',
											width: 200,
											maxLength:128,
											id : 'rs1.daftarBaru.f8',
											allowBlank : false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Kode Pos',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											width: 80,
											name:'f21',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'Kode Pos',
											id:'rs1.daftarBaru.f21',
											result:'upper',
											space:false,
											maxLength:16,
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'No. Telepon',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											width: 120,
											name:'f32',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'No. Telepon',
											id:'rs1.daftarBaru.f32',
											space:false,
											maxLength:16,
											allowBlank: false
										})
									]
								})
							]
						}),
						new Ext.create('App.cmp.Panel',{
							width: 320,
							items:[
								new Ext.create('App.cmp.Input',{
									label:'RT/RW',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											width: 50,
											name:'f9',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'RT',
											id:'rs1.daftarBaru.f9',
											result:'upper',
											space:false,
											maxLength:16,
											allowBlank: false
										}),
										new Ext.form.DisplayField({
											value:'&nbsp;/&nbsp;'
										}),
										new Ext.create('App.cmp.TextField',{
											width: 50,
											name:'f10',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'RW',
											id:'rs1.daftarBaru.f10',
											result:'upper',
											space:false,
											maxLength:16,
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Negara',
									nullData : false,
									items : [
										new Ext.create('App.cmp.AutoComplete',{
											name:'f11',
											submit:'rs1.daftarBaru.btnNext1',
											width: 200,
											id:'rs1.daftarBaru.f11',
											emptyText:'Negara',
											url:url+'app/rs1/getNegara',
											allowBlank : false,
											listeners:{
												select:function(a){
													Ext.getCmp('rs1.daftarBaru.f12').setValue('');
													if(a.getValue()==0){
														Ext.getCmp('rs1.daftarBaru.f12').enable();
														Ext.getCmp('rs1.daftarBaru.f12').focus();
													}else{
														Ext.getCmp('rs1.daftarBaru.f12').disable();
													}
													Ext.getCmp('rs1.daftarBaru.f13').setValue('');
													Ext.getCmp('rs1.daftarBaru.f14').disable();
													Ext.getCmp('rs1.daftarBaru.f15').setValue('');
													Ext.getCmp('rs1.daftarBaru.f16').disable();
													Ext.getCmp('rs1.daftarBaru.f17').setValue('');
													Ext.getCmp('rs1.daftarBaru.f18').disable();
													Ext.getCmp('rs1.daftarBaru.f19').setValue('');
													Ext.getCmp('rs1.daftarBaru.f20').disable();
												}
											}
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : ' ',
									separator:' ',
									items : [
										new Ext.create('App.cmp.TextField',{
											width: 200,
											disabled:true,
											name:'f12',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'Lainnya',
											id:'rs1.daftarBaru.f12',
											result:'dynamic',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Provinsi',
									nullData : false,
									items : [
										new Ext.create('App.cmp.AutoComplete',{
											name:'f13',
											submit:'rs1.daftarBaru.btnNext1',
											width: 200,
											id:'rs1.daftarBaru.f13',
											emptyText:'Provinsi',
											params:function(){
												return {i:Ext.getCmp('rs1.daftarBaru.f11').getValue()};
											},
											url:url+'app/rs1/getProvinsi',
											allowBlank : false,
											listeners:{
												select:function(a){
													Ext.getCmp('rs1.daftarBaru.f14').setValue('');
													if(a.getValue()==0){
														Ext.getCmp('rs1.daftarBaru.f14').enable();
														Ext.getCmp('rs1.daftarBaru.f14').focus();
													}else{
														Ext.getCmp('rs1.daftarBaru.f14').disable();
													}
													Ext.getCmp('rs1.daftarBaru.f15').setValue('');
													Ext.getCmp('rs1.daftarBaru.f16').disable();
													Ext.getCmp('rs1.daftarBaru.f17').setValue('');
													Ext.getCmp('rs1.daftarBaru.f18').disable();
													Ext.getCmp('rs1.daftarBaru.f19').setValue('');
													Ext.getCmp('rs1.daftarBaru.f20').disable();
												}
											}
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : ' ',
									separator:' ',
									items : [
										new Ext.create('App.cmp.TextField',{
											width: 200,
											disabled:true,
											name:'f14',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'Lainnya',
											id:'rs1.daftarBaru.f14',
											result:'dynamic',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Kota',
									nullData : false,
									items : [
										new Ext.create('App.cmp.AutoComplete',{
											name:'f15',
											submit:'rs1.daftarBaru.btnNext1',
											width: 200,
											id:'rs1.daftarBaru.f15',
											emptyText:'Kota',
											params:function(){
												return {i:Ext.getCmp('rs1.daftarBaru.f13').getValue()};
											},
											url:url+'app/rs1/getKota',
											allowBlank : false,
											listeners:{
												select:function(a){
													Ext.getCmp('rs1.daftarBaru.f16').setValue('');
													if(a.getValue()==0){
														Ext.getCmp('rs1.daftarBaru.f16').enable();
														Ext.getCmp('rs1.daftarBaru.f16').focus();
													}else{
														Ext.getCmp('rs1.daftarBaru.f16').disable();
													}
													Ext.getCmp('rs1.daftarBaru.f17').setValue('');
													Ext.getCmp('rs1.daftarBaru.f18').disable();
													Ext.getCmp('rs1.daftarBaru.f19').setValue('');
													Ext.getCmp('rs1.daftarBaru.f20').disable();
												}
											}
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : ' ',
									separator:' ',
									items : [
										new Ext.create('App.cmp.TextField',{
											width: 200,
											disabled:true,
											name:'f16',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'Lainnya',
											id:'rs1.daftarBaru.f16',
											result:'dynamic',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Kecamatan',
									nullData : false,
									items : [
										new Ext.create('App.cmp.AutoComplete',{
											name:'f17',
											submit:'rs1.daftarBaru.btnNext1',
											width: 200,
											id:'rs1.daftarBaru.f17',
											emptyText:'Kecamatan',
											params:function(){
												return {i:Ext.getCmp('rs1.daftarBaru.f15').getValue()};
											},
											url:url+'app/rs1/getKecamatan',
											allowBlank : false,
											listeners:{
												select:function(a){
													Ext.getCmp('rs1.daftarBaru.f18').setValue('');
													if(a.getValue()==0){
														Ext.getCmp('rs1.daftarBaru.f18').enable();
														Ext.getCmp('rs1.daftarBaru.f18').focus();
													}else{
														Ext.getCmp('rs1.daftarBaru.f18').disable();
													}
													Ext.getCmp('rs1.daftarBaru.f19').setValue('');
													Ext.getCmp('rs1.daftarBaru.f20').disable();
												}
											}
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : ' ',
									separator:' ',
									items : [
										new Ext.create('App.cmp.TextField',{
											width: 200,
											disabled:true,
											name:'f18',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'Lainnya',
											id:'rs1.daftarBaru.f18',
											result:'dynamic',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Kelurahan',
									nullData : false,
									items : [
										new Ext.create('App.cmp.AutoComplete',{
											name:'f19',
											submit:'rs1.daftarBaru.btnNext1',
											width: 200,
											id:'rs1.daftarBaru.f19',
											emptyText:'Kelurahan',
											params:function(){
												return {i:Ext.getCmp('rs1.daftarBaru.f17').getValue()};
											},
											url:url+'app/rs1/getKelurahan',
											allowBlank : false,
											listeners:{
												select:function(a){
													Ext.getCmp('rs1.daftarBaru.f20').setValue('');
													if(a.getValue()==0){
														Ext.getCmp('rs1.daftarBaru.f20').enable();
														Ext.getCmp('rs1.daftarBaru.f20').focus();
													}else{
														Ext.getCmp('rs1.daftarBaru.f20').disable();
													}
												}
											}
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : ' ',
									separator:' ',
									items : [
										new Ext.create('App.cmp.TextField',{
											width: 200,
											disabled:true,
											name:'f20',
											submit:'rs1.daftarBaru.btnNext1',
											emptyText:'Lainnya',
											id:'rs1.daftarBaru.f20',
											result:'dynamic',
											allowBlank: false
										})
									]
								})
							]
						})
					]
				})
				,
				new Ext.create('App.cmp.Panel',{
					id : 'rs1.daftarBaru.panel.2',
					width: 660,
					hidden:true,
					fbar:[
						{
							 text: 'Kembali',
							 iconCls:'i-prev',
							 id:'rs1.daftarBaru.btnBack1',
							 handler:function(){
								 Ext.getCmp('rs1.daftarBaru.panel.2').hide();
	 							 Ext.getCmp('rs1.daftarBaru.panel.1').show();
	 							Ext.getCmp('rs1.daftarBaru').center();
							 }
						}
					],
					items:[
					    Ext.create('App.cmp.Panel',{
					    	flex:1,
					    	title:'Poliklinik',
					    	bodyStyle : 'padding: 5px 10px',
					    	items:[
								new Ext.create('App.cmp.Input', {
									label : 'Tanggal Berobat',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DateField', {
											id : 'rs1.daftarBaru.f29',
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
											id : 'rs1.daftarBaru.f25',
											width: 250,
											fields:['id','text','code'],
											emptyText:'Klinik',
											name : 'f25',
											submit:'rs1.daftarBaru.btnSave',
											allowBlank : false,
											listeners:{
												select:function(a){
													Ext.getCmp('rs1.daftarBaru.codeUnit').setValue(a.valueModels[0].data.code);
													Ext.getCmp('rs1.daftarBaru.f28').setValue(null);
												}
											}
										}),
										{
											xtype:'hiddenfield',
											id:'rs1.daftarBaru.codeUnit'
										}
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label : 'Dokter',
									nullData : false,
									items : [
										new Ext.create('App.cmp.AutoComplete',{
											name:'f28',
											submit:'rs1.daftarBaru.btnSave',
											width: 250,
											params:function(){
												return {i:Ext.getCmp('rs1.daftarBaru.f25').getValue()};
											},
											id:'rs1.daftarBaru.f28',
											emptyText:'Dokter',
											url:url+'app/rs1/getDokter',
											allowBlank : false
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Diagnosa',
									nullData : false,
									items : [
										new Ext.create('App.cmp.AutoComplete',{
											name:'f27',
											submit:'rs1.daftarBaru.btnSave',
											width: 400,
											id:'rs1.daftarBaru.f27',
											emptyText:'Diagnosa',
											url:url+'app/rs1/getPenyakit',
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
											id : 'rs1.daftarBaru.f22',
											width: 250,
											emptyText:'Kelompok Pasien',
											name : 'f22',
											submit:'rs1.daftarBaru.btnSave',
											allowBlank : false,
											listeners:{
												select:function(a){
													if(a.getValue()==Ext.getCmp('rs1.daftarBaru.idBpjs').getValue()){
														Ext.getCmp('rs1.daftarBaru.f23').enable();
														Ext.getCmp('rs1.daftarBaru.f34').enable();
														Ext.getCmp('rs1.daftarBaru.btnSearchKtp').enable();
														Ext.getCmp('rs1.daftarBaru.btnSearchPeserta').enable();
													}else{
														Ext.getCmp('rs1.daftarBaru.f23').disable();
														Ext.getCmp('rs1.daftarBaru.f34').disable();
														Ext.getCmp('rs1.daftarBaru.f24').setValue('');
														Ext.getCmp('rs1.daftarBaru.f26').setValue('');
														Ext.getCmp('rs1.daftarBaru').dataBpjs=null;
														Ext.getCmp('rs1.daftarBaru').dataSep=null;
														Ext.getCmp('rs1.daftarBaru.btnSearchKtp').disable();
														Ext.getCmp('rs1.daftarBaru.btnSearchPeserta').disable();
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
											id : 'rs1.daftarBaru.f34',
											name : 'f34',
											disabled:true
										})
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label : 'No. Peserta BPJS',
									id:'rs1.daftarBaru.label.f23',
									nullData : false,
									items : [
										new Ext.create('App.cmp.TextField',{
											width: 150,
											name:'f23',
											emptyText:'No Peserta',
											id:'rs1.daftarBaru.f23',
											result:'upper',
											space:false,
											disabled:true,
											allowBlank: false,
											pressEnter:function(a){
												Ext.getCmp('rs1.daftarBaru.btnSearchPeserta').el.dom.click();
											}
										}),
										new Ext.Button({
											text:'Cari Berdasarkan No. Peserta',
											id:'rs1.daftarBaru.btnSearchPeserta',
											disabled:true,
											iconCls:'i-search',
											handler:function(){
												if(Ext.getCmp('rs1.daftarBaru.f27').getValue() == ''){
													Ext.create('App.cmp.Toast').toast({
														msg : "Harap Pilih Diagnosa.",
														type : 'info'
													});
													return false;
												}
												if(Ext.getCmp('rs1.daftarBaru.codeUnit').getValue() == ''){
													Ext.create('App.cmp.Toast').toast({
														msg : 'Harap Pilih Klinik Untuk mendapatkan Nomor SEP.',
														type : 'info'
													});
													return false;
												}
												if(Ext.getCmp('rs1.daftarBaru.f23').getValue() == ''){
													Ext.create('App.cmp.Toast').toast({
														msg : 'Harap isi input nomor kartu peserta.',
														type : 'info'
													});
													return false;
												}
												Ext.getCmp('rs1.confirm').confirm({
													msg :'Apakah Akan Mencari data BPJS Berdasarkan No. Peserta?',
													allow : 'rs1.daftarBaru.noPeserta',
													onY : function() {
														Ext.getCmp('rs1.daftarBaru').setLoading('Loading..');
														Ext.Ajax.request({
															method:'GET',
															url: url+"app/rs1/getDataBpjs",
															params:{no:Ext.getCmp('rs1.daftarBaru.f23').getValue(),type:'ASS'},
															success: function(o){
																var r = ajaxSuccess(o);
																Ext.getCmp('rs1.daftarBaru').setLoading(false);
																if (r.result == 'SUCCESS') {
																	if(r.data.bpjs.metadata.code=='200'){
																		var p=r.data.bpjs.response.peserta;
																		Ext.getCmp('rs1.daftarBaru').dataBpjs=Ext.encode(p);
																		if(r.data.bpjs.response.peserta != undefined){
																			Ext.getCmp('rs1.daftarBaru.f24').setValue(r.data.bpjs.response.peserta.nama);
																			Ext.getCmp('rs1.confirm').confirm({
																				msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																				'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																				allow : 'rs1.daftarBaru.getSep',
																				onY : function() {
																					Ext.getCmp('rs1.daftarBaru').setLoading('Loading..');
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
																						'<diagAwal>'+Ext.getCmp('rs1.daftarBaru.f27').getValue()+'</diagAwal>'+
																						'<poliTujuan>'+Ext.getCmp('rs1.daftarBaru.codeUnit').getValue()+'</poliTujuan>'+
																						'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																						'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																						'<user>1</user>'+
																						'<noMr>'+Ext.getCmp('rs1.daftarBaru.f1').getValue()+'</noMr>'+
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
																						url: url+"app/rs1/sep",
																						data:param,
																						success: function(resp1){
																							Ext.getCmp('rs1.daftarBaru').setLoading(false);
																							if(resp1 != null  && resp1.metadata.code=='200'){
																								Ext.getCmp('rs1.daftarBaru').dataSep=Ext.encode(resp1);
																								Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																								Ext.getCmp('rs1.daftarBaru.f26').setValue(resp1.response);
																							}else{
																								Ext.getCmp('rs1.daftarBaru').setLoading(false);
																								Ext.MessageBox.alert('Gagal', resp1.metadata.message);
																							}
																						},
																						error: function(jqXHR, exception) {
																							Ext.getCmp('rs1.daftarBaru').setLoading(false);
																							Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																						}
																					});
																				},
																				onN:function(){
																					Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																				}
																			});
																		}else{
																			Ext.getCmp('rs1.daftarBaru').setLoading(false);
																			Ext.create('App.cmp.Toast').toast({
																				msg : "Nomor Peserta '"+Ext.getCmp('rs1.daftarBaru.f23').getValue()+"' tidak ditemukan.",
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
																		url: r.data.url_briging+Ext.getCmp('rs1.daftarBaru.f23').getValue(),
																		//type:'json',
																		//cors: true,
																		//useDefaultXhrHeader : false,
																		headers: {
																			'X-cons-id':r.data.id,
																			'X-timestamp':r.data.timestamp,
																			'X-signature':r.data.signature
																		},
																		success: function(o1){
																			Ext.getCmp('rs1.daftarBaru').setLoading(false);
																			var cst = Ext.decode(o1.responseText);
																			if(cst.response != null){
																				var p=cst.response.peserta;
																				Ext.getCmp('rs1.daftarBaru').dataBpjs=Ext.encode(p);
																				if(cst.response.peserta != undefined){
																					Ext.getCmp('rs1.daftarBaru.f24').setValue(cst.response.peserta.nama);
																					Ext.getCmp('rs1.confirm').confirm({
																						msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																						'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																						allow : 'rs1.daftarBaru.getSep',
																						onY : function() {
																							Ext.getCmp('rs1.daftarBaru').setLoading('Loading..');
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
																								'<diagAwal>'+Ext.getCmp('rs1.daftarBaru.f27').getValue()+'</diagAwal>'+
																								'<poliTujuan>'+Ext.getCmp('rs1.daftarBaru.codeUnit').getValue()+'</poliTujuan>'+
																								'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																								'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																								'<user>1</user>'+
																								'<noMr></noMr>'+
																								'</t_sep>'+
																								'</data>'+
																								'</request>',
																								success: function(resp1){
																									Ext.getCmp('rs1.daftarBaru').setLoading(false);
																									if(resp1 != null && resp1.response != null){
																										Ext.getCmp('rs1.daftarBaru').dataSep=Ext.encode(resp1);
																										Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																										Ext.getCmp('rs1.daftarBaru.f26').setValue(resp1.response);
																									}else{
																										Ext.getCmp('rs1.daftarBaru').setLoading(false);
																										Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																									}
																								},
																								error: function(jqXHR, exception) {
																									Ext.getCmp('rs1.daftarBaru').setLoading(false);
																									Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																								}
																							});
																						},
																						onN:function(){
																							Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																						}
																					});
																				}else{
																					Ext.getCmp('rs1.daftarBaru').setLoading(false);
																					Ext.create('App.cmp.Toast').toast({
																						msg : "Nomor Peserta '"+Ext.getCmp('rs1.daftarBaru.f23').getValue()+"' tidak ditemukan.",
																						type : 'info'
																					});
																				}
																			}else{
																				Ext.getCmp('rs1.daftarBaru').setLoading(false);
																				Ext.create('App.cmp.Toast').toast({
																					msg : "Nomor Peserta '"+Ext.getCmp('rs1.daftarBaru.f23').getValue()+"' tidak ditemukan.",
																					type : 'info'
																				});
																			}
																		},
																		failure : function(jqXHR, exception) {
																			Ext.getCmp('rs1.daftarBaru').setLoading(false);
																			ajaxError(jqXHR, exception);
																		}
																	});
																	*/
																}else{
																	Ext.getCmp('rs1.daftarBaru').setLoading(false);
																}
															},
															failure : function(jqXHR, exception) {
																Ext.getCmp('rs1.daftarBaru').setLoading(false);
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
											id:'rs1.daftarBaru.ktp'
										}),
										new Ext.Button({
											text:'Cari Berdasarkan NIK',
											id:'rs1.daftarBaru.btnSearchKtp',
											iconCls:'i-search',
											disabled:true,
											handler:function(){
												if(Ext.getCmp('rs1.daftarBaru.f27').getValue() == ''){
													Ext.create('App.cmp.Toast').toast({
														msg : "Harap Pilih Diagnosa.",
														type : 'info'
													});
													return false;
												}
												if(Ext.getCmp('rs1.daftarBaru.codeUnit').getValue() == ''){
													Ext.create('App.cmp.Toast').toast({
														msg : 'Harap Pilih Klinik Untuk mendapatkan Nomor SEP.',
														type : 'info'
													});
													return false;
												}
												if(Ext.getCmp('rs1.daftarBaru.ktp').getValue() == ''){
													Ext.create('App.cmp.Toast').toast({
														msg : 'Harap isi input nomor KTP.',
														type : 'info'
													});
													return false;
												}
												Ext.getCmp('rs1.confirm').confirm({
													msg :'Apakah Akan Mencari data BPJS Berdasarkan NIK ?',
													allow : 'rs1.daftarBaru.nik',
													onY : function() {
														Ext.getCmp('rs1.daftarBaru').setLoading('Loading..');
														Ext.Ajax.request({
															method:'GET',
															url: url+"app/rs1/getDataBpjs",
															params:{no:Ext.getCmp('rs1.daftarBaru.ktp').getValue(),type:'NIK'},
															success: function(o){
																var r = ajaxSuccess(o);
																Ext.getCmp('rs1.daftarBaru').setLoading(false);
																if (r.result == 'SUCCESS') {
																	if(r.data.bpjs.metadata.code=='200'){
																		var p=r.data.bpjs.response.peserta;
																		Ext.getCmp('rs1.daftarBaru').dataBpjs=Ext.encode(p);
																		if(r.data.bpjs.response.peserta != undefined){
																			Ext.getCmp('rs1.daftarBaru.f24').setValue(r.data.bpjs.response.peserta.nama);
																			Ext.getCmp('rs1.confirm').confirm({
																				msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																				'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																				allow : 'rs1.daftarBaru.getSep',
																				onY : function() {
																					Ext.getCmp('rs1.daftarBaru').setLoading('Loading..');
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
																						'<diagAwal>'+Ext.getCmp('rs1.daftarBaru.f27').getValue()+'</diagAwal>'+
																						'<poliTujuan>'+Ext.getCmp('rs1.daftarBaru.codeUnit').getValue()+'</poliTujuan>'+
																						'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																						'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																						'<user>1</user>'+
																						'<noMr>'+Ext.getCmp('rs1.daftarBaru.f1').getValue()+'</noMr>'+
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
																						url: url+"app/rs1/sep",
																						data:param,
																						success: function(resp1){
																							Ext.getCmp('rs1.daftarBaru').setLoading(false);
																							if(resp1 != null && resp1.metadata.code=='200'){
																								Ext.getCmp('rs1.daftarBaru').dataSep=Ext.encode(resp1);
																								Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																								Ext.getCmp('rs1.daftarBaru.f26').setValue(resp1.response);
																							}else{
																								Ext.getCmp('rs1.daftarBaru').setLoading(false);
																								Ext.MessageBox.alert('Gagal', resp1.metadata.message);
																							}
																						},
																						error: function(jqXHR, exception) {
																							Ext.getCmp('rs1.daftarBaru').setLoading(false);
																							Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																						}
																					});
																				},
																				onN:function(){
																					Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																				}
																			});
																		}else{
																			Ext.getCmp('rs1.daftarBaru').setLoading(false);
																			Ext.create('App.cmp.Toast').toast({
																				msg : "Nomor Peserta '"+Ext.getCmp('rs1.daftarBaru.f23').getValue()+"' tidak ditemukan.",
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
																		url: r.data.url_briging+Ext.getCmp('rs1.daftarBaru.f23').getValue(),
																		//type:'json',
																		//cors: true,
																		//useDefaultXhrHeader : false,
																		headers: {
																			'X-cons-id':r.data.id,
																			'X-timestamp':r.data.timestamp,
																			'X-signature':r.data.signature
																		},
																		success: function(o1){
																			Ext.getCmp('rs1.daftarBaru').setLoading(false);
																			var cst = Ext.decode(o1.responseText);
																			if(cst.response != null){
																				var p=cst.response.peserta;
																				Ext.getCmp('rs1.daftarBaru').dataBpjs=Ext.encode(p);
																				if(cst.response.peserta != undefined){
																					Ext.getCmp('rs1.daftarBaru.f24').setValue(cst.response.peserta.nama);
																					Ext.getCmp('rs1.confirm').confirm({
																						msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																						'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																						allow : 'rs1.daftarBaru.getSep',
																						onY : function() {
																							Ext.getCmp('rs1.daftarBaru').setLoading('Loading..');
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
																								'<diagAwal>'+Ext.getCmp('rs1.daftarBaru.f27').getValue()+'</diagAwal>'+
																								'<poliTujuan>'+Ext.getCmp('rs1.daftarBaru.codeUnit').getValue()+'</poliTujuan>'+
																								'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																								'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																								'<user>1</user>'+
																								'<noMr></noMr>'+
																								'</t_sep>'+
																								'</data>'+
																								'</request>',
																								success: function(resp1){
																									Ext.getCmp('rs1.daftarBaru').setLoading(false);
																									if(resp1 != null && resp1.response != null){
																										Ext.getCmp('rs1.daftarBaru').dataSep=Ext.encode(resp1);
																										Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																										Ext.getCmp('rs1.daftarBaru.f26').setValue(resp1.response);
																									}else{
																										Ext.getCmp('rs1.daftarBaru').setLoading(false);
																										Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																									}
																								},
																								error: function(jqXHR, exception) {
																									Ext.getCmp('rs1.daftarBaru').setLoading(false);
																									Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																								}
																							});
																						},
																						onN:function(){
																							Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																						}
																					});
																				}else{
																					Ext.getCmp('rs1.daftarBaru').setLoading(false);
																					Ext.create('App.cmp.Toast').toast({
																						msg : "Nomor Peserta '"+Ext.getCmp('rs1.daftarBaru.f23').getValue()+"' tidak ditemukan.",
																						type : 'info'
																					});
																				}
																			}else{
																				Ext.getCmp('rs1.daftarBaru').setLoading(false);
																				Ext.create('App.cmp.Toast').toast({
																					msg : "Nomor Peserta '"+Ext.getCmp('rs1.daftarBaru.f23').getValue()+"' tidak ditemukan.",
																					type : 'info'
																				});
																			}
																		},
																		failure : function(jqXHR, exception) {
																			Ext.getCmp('rs1.daftarBaru').setLoading(false);
																			ajaxError(jqXHR, exception);
																		}
																	});
																	*/
																}else{
																	Ext.getCmp('rs1.daftarBaru').setLoading(false);
																}
															},
															failure : function(jqXHR, exception) {
																Ext.getCmp('rs1.daftarBaru').setLoading(false);
																ajaxError(jqXHR, exception);
															}
														});
														/*
														Ext.getCmp('rs1.daftarBaru').setLoading('Loading..');
														Ext.Ajax.request({
															method:'GET',
															url: url+"app/rs1/getDataBpjs",
															success: function(o){
																var r = ajaxSuccess(o);
																if (r.result == 'SUCCESS') {
																	Ext.Ajax.request({
																		method:'GET',
																		url: r.data.url_briging+'nik/'+Ext.getCmp('rs1.daftarBaru.ktp').getValue(),
																		headers: {
																			'X-cons-id':r.data.id,
																			'X-timestamp':r.data.timestamp,
																			'X-signature':r.data.signature
																		},
																		success: function(o1){
																			Ext.getCmp('rs1.daftarBaru').setLoading(false);
																			var cst = Ext.decode(o1.responseText);
																			if(cst.response != null){
																				if(cst.response.list.length >0){
																					var p=cst.response.list[0];
																					if(cst.response.peserta != undefined){
																						Ext.getCmp('rs1.daftarBaru').dataBpjs=Ext.encode(p);
																						Ext.getCmp('rs1.daftarBaru.f24').setValue(p.nama);
																						Ext.getCmp('rs1.daftarBaru.f23').setValue(p.noKartu);
																						Ext.getCmp('rs1.confirm').confirm({
																							msg :'Nama : '+p.nama+', Kelas : '+p.kelasTanggungan.nmKelas+', ' +
																							'Faskes : '+p.provUmum.nmProvider+'. \n Akan Buat SEP Sekarang ?',
																							allow : 'rs1.daftarBaru.getSep',
																							onY : function() {
																								Ext.getCmp('rs1.daftarBaru').setLoading('Loading..');
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
																									'<diagAwal>'+Ext.getCmp('rs1.daftarBaru.f27').getValue()+'</diagAwal>'+
																									'<poliTujuan>'+Ext.getCmp('rs1.daftarBaru.codeUnit').getValue()+'</poliTujuan>'+
																									'<klsRawat>'+p.kelasTanggungan.kdKelas+'</klsRawat>'+
																									'<lakaLantas>'+lakalatas+'</lakaLantas>'+
																									'<user>1</user>'+
																									'<noMr>234432</noMr>'+
																									'</t_sep>'+
																									'</data>'+
																									'</request>',
																									success: function(resp1){
																										Ext.getCmp('rs1.daftarBaru').setLoading(false);
																										if(resp1 != null && resp1.response != null){
																											Ext.getCmp('rs1.daftarBaru').dataSep=Ext.encode(resp1);
																											Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																											Ext.getCmp('rs1.daftarBaru.f26').setValue(resp1.response);
																										}else{
																											Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																										}
																									},
																									error: function(jqXHR, exception) {
																										Ext.getCmp('rs1.daftarBaru').setLoading(false);
																										Ext.MessageBox.alert('Gagal', 'Nomor SEP tidak ditemukan.');
																									}
																								});
																							},
																							onN:function(){
																								Ext.getCmp('rs1.daftarBaru.btnSave').focus();
																							}
																						});
																					}else{
																						Ext.getCmp('rs1.daftarBaru').setLoading(false);
																						Ext.create('App.cmp.Toast').toast({
																							msg : "Data BPJS tidak ditemukan",
																							type : 'info'
																						});
																					}
																				}else{
																					Ext.getCmp('rs1.daftarBaru').setLoading(false);
																					Ext.create('App.cmp.Toast').toast({
																						msg : "Data BPJS tidak ditemukan",
																						type : 'info'
																					});
																				}
																			}else{
																				Ext.getCmp('rs1.daftarBaru').setLoading(false);
																				Ext.create('App.cmp.Toast').toast({
																					msg : "Nomor Peserta '"+Ext.getCmp('rs1.daftarBaru.f23').getValue()+"' tidak ditemukan.",
																					type : 'info'
																				});
																			}
																		},
																		failure : function(jqXHR, exception) {
																			Ext.getCmp('rs1.daftarBaru').setLoading(false);
																			ajaxError(jqXHR, exception);
																		}
																	});
																}else{
																	Ext.getCmp('rs1.daftarBaru').setLoading(false);
																}
															},
															failure : function(jqXHR, exception) {
																Ext.getCmp('rs1.daftarBaru').setLoading(false);
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
											id:'rs1.daftarBaru.f24'
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
											id:'rs1.daftarBaru.f26'
										})
									]
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
		if (Ext.getCmp('rs1.daftarBaru.panel').qGetForm() == false) {
			Ext.getCmp('rs1.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'rs1.daftarBaru.close',
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