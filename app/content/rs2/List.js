Ext.define('App.content.rs2.List',{
	extend:'App.cmp.Table',
	id:'rs2.list',
	params:function(){
		return Ext.getCmp('rs2.search.panel').qParams();
	},
	url:url + 'app/RS2/getList',
	result:function(response){
		return {list:response.data,total:response.total};
	},
	onSelect:function(view, cell, cellIndex, record, row, rowIndex, e){
		Ext.getCmp('rs2.btnStatus').enable();
		Ext.getCmp('rs2.btnTracer').enable();
		Ext.getCmp('rs2.btnHadir').enable();
		Ext.getCmp('rs2.btnUbah').enable();
		Ext.getCmp('rs2.btnCetakPasien').enable();
		
		if((record.data.f13 != null && record.data.f13.trim() != '') && (record.data.f11 == null || record.data.f11.trim()=='')){
			Ext.getCmp('rs2.btnBridging').enable();
		}else{
			Ext.getCmp('rs2.btnBridging').disable();
		}
		if(record.data.f11 != null && record.data.f11.trim()!=''){
			Ext.getCmp('rs2.btnCetakSep').enable();
		}else{
			Ext.getCmp('rs2.btnCetakSep').disable();
		}
	},
	onNotSelect:function(){
		Ext.getCmp('rs2.btnStatus').disable();
		Ext.getCmp('rs2.btnHadir').disable();
		Ext.getCmp('rs2.btnUbah').disable();
		Ext.getCmp('rs2.btnCetakPasien').disable();
		Ext.getCmp('rs2.btnTracer').disable();
	},
	tbar:[
		Ext.create('Ext.panel.Panel', {
		    flex: 1,
		    border:false,
		    tbar: [{
		        xtype: 'buttongroup',
		        columns: 3,
		        title: 'Menu',
		        items: [{
		            text: 'Refresh',
		            scale: 'large',
		            iconCls: 'i-refresh-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	Ext.getCmp('rs2.list').refresh(false);
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('rs2.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/rs2/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('rs2.search.f4').addReset(r.data.l);
									Ext.getCmp('rs2.search.f9').addReset(r.data.l1);
									Ext.getCmp('rs2.search.f10').addReset(r.data.l1);
									Ext.getCmp('rs2.search.f11').addReset(r.data.l2);
									Ext.getCmp('rs2.search.f13').addReset(r.data.l3);
									Ext.getCmp('rs2.search').show();
									Ext.getCmp('rs2.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        },{
		            text: 'Self Reg',
		            scale: 'large',
		            iconCls: 'i-self-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	Ext.getCmp('rs2.list').setLoading('Checking');
						Ext.Ajax.request({
							url : url + 'app/RS2/getVar',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									window.open(url+'app/rs2/selfWindow');
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    },{
		        xtype: 'buttongroup',
		        columns: 7,
		        title: 'Action Menu',
		        items: [{
		            text: 'Status',
		            scale: 'large',
		            disabled:true,
		            id:'rs2.btnStatus',
		            iconCls: 'i-status-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	Ext.getCmp('rs2.list').setLoading('Checking');
						Ext.Ajax.request({
							url : url + 'app/RS2/getVar',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									var data=Ext.getCmp('rs2.list').dataRow;
					            	Ext.getCmp('rs2.status.panel').qReset();
					            	Ext.getCmp('rs2.status').closing = false;
					            	Ext.getCmp('rs2.status.i').setValue(data.i);
					            	Ext.getCmp('rs2.status.f1').setValue(data.f8);
					            	Ext.getCmp('rs2.status.f2').setValue(data.f7);
					            	Ext.getCmp('rs2.status.panel').qSetForm();
					            	Ext.getCmp('rs2.status').show();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        },{
		            text: 'Hadir',
		            scale: 'large',
		            iconCls: 'i-absent-large',
		            iconAlign: 'top',
		            id:'rs2.btnHadir',
		            disabled:true,
		            handler:function(a){
						Ext.getCmp('rs2.list').setLoading('Checking');
						Ext.Ajax.request({
							url : url + 'app/RS2/getVar',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									var data=Ext.getCmp('rs2.list').dataRow;
					            	Ext.getCmp('rs2.hadir.panel').qReset();
					            	Ext.getCmp('rs2.hadir').closing = false;
					            	Ext.getCmp('rs2.hadir.i').setValue(data.i);
					            	Ext.getCmp('rs2.hadir.f1').setValue(data.f8);
					            	Ext.getCmp('rs2.hadir.f2').setValue(data.f9);
					            	Ext.getCmp('rs2.hadir.panel').qSetForm();
					            	Ext.getCmp('rs2.hadir').show();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        },{
		            text: 'Ubah',
		            scale: 'large',
		            iconCls: 'i-edit-large',
		            iconAlign: 'top',
		            id:'rs2.btnUbah',
		            disabled:true,
		            handler:function(a){
						Ext.getCmp('rs2.list').setLoading('Checking');
						var data=Ext.getCmp('rs2.list').dataRow;
						Ext.Ajax.request({
							url : url + 'app/rs2/initUpdate',
							params:{
								i:data.i
							},
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									if(data.f11 == ''){
										Ext.getCmp('rs2.edit.f1').enable();
									}else{
										Ext.getCmp('rs2.edit.f1').disable();
									}
					            	Ext.getCmp('rs2.edit.panel').qReset();
					            	Ext.getCmp('rs2.edit').closing = false;
					            	Ext.getCmp('rs2.edit.i').setValue(data.i);
					            	Ext.getCmp('rs2.edit.f1').addReset(r.data.l);
					            	Ext.getCmp('rs2.edit.f1').setValue(r.data.o.f1);
					            	Ext.getCmp('rs2.edit.f2').setValue(r.data.o.f2);
					            	Ext.getCmp('rs2.edit.panel').qSetForm();
					            	Ext.getCmp('rs2.edit').show();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        },{
		            text: 'Lihat SEP',
		            scale: 'large',
		            iconCls: 'i-print-large',
		            iconAlign: 'top',
		            id:'rs2.btnCetakSep',
		            disabled:true,
		            handler:function(a){
		            	Ext.Ajax.request({
							url : url+'app/rs2/cetakSep',
							params:{
								i:Ext.getCmp('rs2.list').dataRow.i
							},
							method : 'GET',
							success : function(response) {
								openPP(response.responseText,700);
							}
						});
//						Ext.getCmp('rs2.cetakSep').toPDF();
					}
		        },{
		            text: 'Cetak Pasien',
		            scale: 'large',
		            iconCls: 'i-print-large',
		            iconAlign: 'top',
		            id:'rs2.btnCetakPasien',
		            disabled:true,
		            handler:function(a){
						/*
		            	Ext.Ajax.request({
							url : url+'app/rs2/cetakSep',
							params:{
								i:Ext.getCmp('rs2.list').dataRow.i
							},
							method : 'GET',
							success : function(response) {
								openPP(response.responseText,700);
							}
						});
						*/
						Ext.getCmp('rs2.cetakPasien').toPDF();
					}
		        },{
		            text: 'Tracer',
		            scale: 'large',
		            iconCls: 'i-print-large',
		            iconAlign: 'top',
		            id:'rs2.btnTracer',
		            disabled:true,
		            handler:function(a){
						/*
		            	Ext.Ajax.request({
							url : url+'app/rs2/cetakSep',
							params:{
								i:Ext.getCmp('rs2.list').dataRow.i
							},
							method : 'GET',
							success : function(response) {
								openPP(response.responseText,700);
							}
						});
						*/
						Ext.getCmp('rs2.cetakTracer').toPDF();
					}
		        },{
		            text: 'Bridging SEP',
		            scale: 'large',
		            iconCls: 'i-verified-large',
		            iconAlign: 'top',
		            id:'rs2.btnBridging',
		            disabled:true,
		            handler:function(a){
		            	Ext.getCmp('rs2.list').setLoading('Checking');
						var data=Ext.getCmp('rs2.list').dataRow;
						Ext.Ajax.request({
							url : url + 'app/rs2/initBridging',
							params:{
								i:data.i
							},
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
					            	Ext.getCmp('rs2.bridging.panel').qReset();
					            	Ext.getCmp('rs2.bridging').closing = false;
					            	Ext.getCmp('rs2.bridging.f25').addReset(r.data.l4);
					            	Ext.getCmp('rs2.bridging.f22').addReset(r.data.l3);
					            	Ext.getCmp('rs2.bridging.i').setValue(data.i);
					            	Ext.getCmp('rs2.bridging.idBpjs').setValue(r.data.d);
					            	Ext.getCmp('rs2.bridging.f25').setValue(r.data.o.f1);
					            	Ext.getCmp('rs2.bridging.f28').setValue(r.data.o.f2);
					            	Ext.getCmp('rs2.bridging.codeDiagnosa').setValue(r.data.o.f3);
					            	Ext.getCmp('rs2.bridging.f27').setValue(r.data.o.f3t);
					            	Ext.getCmp('rs2.bridging.f22').setValue(r.data.o.f4);
					            	Ext.getCmp('rs2.bridging.codeUnit').setValue(r.data.o.f5);
					            	Ext.getCmp('rs2.bridging.ktp').setValue(r.data.o.f6);
					            	Ext.getCmp('rs2.bridging.f1').setValue(r.data.o.f7);
					            	Ext.getCmp('rs2.bridging.f23').setValue(r.data.o.f8);
					            	Ext.getCmp('rs2.bridging.noRujukan').setValue(data.f13);
					            	if(r.data.d==r.data.o.f4){
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
					            	
//					            	Ext.getCmp('rs2.edit.i').setValue(data.i);
//					            	Ext.getCmp('rs2.edit.f1').addReset(r.data.l);
//					            	Ext.getCmp('rs2.edit.f1').setValue(r.data.o.f1);
//					            	Ext.getCmp('rs2.edit.f2').setValue(r.data.o.f2);
					            	Ext.getCmp('rs2.bridging.panel').qSetForm();
					            	Ext.getCmp('rs2.bridging').show();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    },{
		        xtype: 'buttongroup',
		        columns: 1,
		        title: 'Export',
		        items: [{
		            text: 'Excel',
		            scale: 'large',
		            id:'rs2.btnImport',
		            iconCls: 'i-excel-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	var post='f1='+Ext.getCmp('rs2.search.f1').getValue()+'&';
		            	post+='f2='+Ext.getCmp('rs2.search.f2').getValue()+'&';
		            	post+='f3='+Ext.getCmp('rs2.search.f3').getValue()+'&';
		            	post+='f4='+Ext.getCmp('rs2.search.f4').getValue()+'&';
		            	post+='f5='+Ext.getCmp('rs2.search.f5').getValue()+'&';
		            	post+='f6='+Ext.getCmp('rs2.search.f6').val()+'&';
		            	post+='f7='+Ext.getCmp('rs2.search.f7').val()+'&';
		            	post+='f8='+Ext.getCmp('rs2.search.f8').getValue()+'&';
		            	post+='f9='+Ext.getCmp('rs2.search.f9').getValue()+'&';
		            	post+='f10='+Ext.getCmp('rs2.search.f10').getValue()+'&';
		            	post+='f11='+Ext.getCmp('rs2.search.f11').getValue()+'&';
		            	post+='f12='+Ext.getCmp('rs2.search.f12').getValue()+'&';
		            	post+='f13='+Ext.getCmp('rs2.search.f13').getValue()+'&';
		            	window.open(url+'app/rs2/toExcel?'+post);
					}
		        }]
		    },'->',
		    {
		        xtype: 'buttongroup',
		        columns: 1,
		        width: 120,
		        title: 'Info Status',
		        bodyStyle:'padding-left: 10px;',
		        items: [
					new Ext.create('App.cmp.Input',{
						label:'<img src="' + icon('t') + '" />',
						xWidth: 20,
						items:[
							new Ext.form.DisplayField({
								   value:'Sudah Dilayani'
							})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'<img src="' + icon('f') + '" />',
						xWidth: 20,
						items:[
							new Ext.form.DisplayField({
								   value:'Belum Dilayani'
							})
						]
					})
		         ]
		    },{
		        xtype: 'buttongroup',
		        columns: 1,
		        width: 120,
		        title: 'Info BEP',
		        bodyStyle:'padding-left: 10px;',
		        items: [
					new Ext.create('App.cmp.Input',{
						label:'<img src="' + icon('t') + '" />',
						xWidth: 20,
						items:[
							new Ext.form.DisplayField({
								   value:'PBI'
							})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'<img src="' + icon('f') + '" />',
						xWidth: 20,
						items:[
							new Ext.form.DisplayField({
								   value:'Non PBI'
							})
						]
					})
		         ]
		    },{
		        xtype: 'buttongroup',
		        columns: 1,
		        width: 120,
		        title: 'Info Hadir',
		        bodyStyle:'padding-left: 10px;',
		        items: [
					new Ext.create('App.cmp.Input',{
						label:'<img src="' + icon('t') + '" />',
						xWidth: 20,
						items:[
							new Ext.form.DisplayField({
								   value:'Sudah Hadir'
							})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'<img src="' + icon('f') + '" />',
						xWidth: 20,
						items:[
							new Ext.form.DisplayField({
								   value:'Belum Hadir'
							})
						]
					})
		         ]
		    }]
		}) 
	],
	columns:[
		{ xtype: 'rownumberer'},
		{ hidden:true, dataIndex: 'i', hideable:false},
		{ text: 'No. Medrec',width: 100,dataIndex: 'f1',align:'center'  },
		{ text: 'No. Pendaftaran',width: 100,dataIndex: 'f8',align:'center'  },
		{ text: 'Nama Pasien',width: 200,dataIndex: 'f2'},
		{ text: 'Klinik',width: 150,dataIndex: 'f3' },
		{ text: 'Nama Dokter',width: 150, dataIndex: 'f4' },
		{ text: 'Tgl. Berobat', width: 100,dataIndex: 'f5',align:'center'  },
		{ text: 'Antrian',width: 50, dataIndex: 'f6',align:'center'},
		{ text: 'Status',width: 50,sortable :false, dataIndex: 'f7',align:'center' ,
			renderer: function(value){
				if(value==true)
					return '<img src="' + icon('t') + '" style="margin: -5px;" />';
				else
					return '<img src="' + icon('f') + '" style="margin: -5px;" />';
			}
		},{ text: 'Hadir',width: 50, sortable :false,dataIndex: 'f9',align:'center' ,
			renderer: function(value){
				if(value==true)
					return '<img src="' + icon('t') + '" style="margin: -5px;" />';
				else
					return '<img src="' + icon('f') + '" style="margin: -5px;" />';
			}
		},{ text: 'Jns. Pasien',width: 150,dataIndex: 'f10'},
		{ text: 'No. SEP',width: 150,dataIndex: 'f11',align:'center'  },
		{ text: 'PBI',width: 50, sortable :false,dataIndex: 'f10',align:'center' ,
			renderer: function(value, rowIdx, colIdx, item, record){
				console.log(rowIdx);
				if(rowIdx.record.data.f11 != null && rowIdx.record.data.f11 != ''){
					if(value==true)
						return '<img src="' + icon('t') + '" style="margin: -5px;" />';
					else
						return '<img src="' + icon('f') + '" style="margin: -5px;" />';
				}else{
					return '';
				}
			}
		},
		{ text: 'No. Rujukan',width: 150, dataIndex: 'f13'},
		{ text: 'Episode',width: 100, dataIndex: 'f12'}
	]
});