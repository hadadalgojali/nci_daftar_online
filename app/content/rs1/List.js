Ext.define('App.content.rs1.List',{
	extend:'App.cmp.Table',
	id:'rs1.list',
	params:function(){
		return Ext.getCmp('rs1.search.panel').qParams();
	},
	url:url + 'app/rs1/getList',
	result:function(response){
		return {list:response.data,total:response.total};
	},
	onSelect:function(){
		Ext.getCmp('rs1.btnDaftar').enable();
	},
	onNotSelect:function(){
		Ext.getCmp('rs1.btnDaftar').disable();
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
		            text: 'Daftar Baru',
		            scale: 'large',
		            iconCls: 'i-register-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('rs1.list').setLoading('Loading');
						Ext.Ajax.request({
							url : url + 'app/rs1/initDaftarBaru',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('rs1.daftarBaru').closing = false;
									Ext.getCmp('rs1.daftarBaru.f5').addReset(r.data.l);
									Ext.getCmp('rs1.daftarBaru.f6').addReset(r.data.l1);
									Ext.getCmp('rs1.daftarBaru.f7').addReset(r.data.l2);
									Ext.getCmp('rs1.daftarBaru.f22').addReset(r.data.l3);
									Ext.getCmp('rs1.daftarBaru.f25').addReset(r.data.l4);
									Ext.getCmp('rs1.daftarBaru.f30').addReset(r.data.l5);
									Ext.getCmp('rs1.daftarBaru.f12').disable();
									Ext.getCmp('rs1.daftarBaru.f14').disable();
									Ext.getCmp('rs1.daftarBaru.f16').disable();
									Ext.getCmp('rs1.daftarBaru.f18').disable();
									Ext.getCmp('rs1.daftarBaru.f20').disable();
									Ext.getCmp('rs1.daftarBaru.f23').disable();
									Ext.getCmp('rs1.daftarBaru').dataBpjs=null;
									Ext.getCmp('rs1.daftarBaru').dataSep=null;
									Ext.getCmp('rs1.daftarBaru.btnSearchKtp').disable();
									Ext.getCmp('rs1.daftarBaru.btnSearchPeserta').disable();
									Ext.getCmp('rs1.daftarBaru.p').setValue('ADD');
									Ext.getCmp('rs1.daftarBaru.panel.2').hide();
									Ext.getCmp('rs1.daftarBaru.panel.1').show();
									Ext.getCmp('rs1.daftarBaru').show();
									Ext.getCmp('rs1.daftarBaru.panel').qReset();
									Ext.getCmp('rs1.daftarBaru.idBpjs').setValue(r.data.d);
									Ext.getCmp('rs1.daftarBaru.panel').qSetForm();
									Ext.getCmp('rs1.daftarBaru.panel.1').qSetForm();
									Ext.getCmp('rs1.daftarBaru.panel.2').qSetForm();
									Ext.getCmp('rs1.daftarBaru.f33').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs1.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        },{
		            text: 'Refresh',
		            scale: 'large',
		            iconCls: 'i-refresh-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	Ext.getCmp('rs1.list').refresh(false);
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('rs1.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/rs1/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('rs1.search.f3').addReset(r.data.l);
									Ext.getCmp('rs1.search').show();
									Ext.getCmp('rs1.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs1.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    },{
		        xtype: 'buttongroup',
		        columns: 1,
		        title: 'Action Menu',
		        items: [{
		            text: 'Daftar Lama',
		            scale: 'large',
		            disabled:true,
		            id:'rs1.btnDaftar',
		            iconCls: 'i-register-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	var data=Ext.getCmp('rs1.list').dataRow;
		            	Ext.getCmp('rs1.list').setLoading('Loading');
						Ext.Ajax.request({
							url : url + 'app/rs1/initDaftar',
							params:{i:data.i},
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									var o=r.data.o;
									Ext.getCmp('rs1.daftarBaru').closing = false;
									Ext.getCmp('rs1.daftarBaru.f5').addReset(r.data.l);
									Ext.getCmp('rs1.daftarBaru.f6').addReset(r.data.l1);
									Ext.getCmp('rs1.daftarBaru.f7').addReset(r.data.l2);
									Ext.getCmp('rs1.daftarBaru.f22').addReset(r.data.l3);
									Ext.getCmp('rs1.daftarBaru.f25').addReset(r.data.l4);
									Ext.getCmp('rs1.daftarBaru.f30').addReset(r.data.l5);
									Ext.getCmp('rs1.daftarBaru.f12').disable();
									Ext.getCmp('rs1.daftarBaru.f14').disable();
									Ext.getCmp('rs1.daftarBaru.f16').disable();
									Ext.getCmp('rs1.daftarBaru.f18').disable();
									Ext.getCmp('rs1.daftarBaru.f20').disable();
									Ext.getCmp('rs1.daftarBaru.f23').disable();
									Ext.getCmp('rs1.daftarBaru.f34').disable();
									Ext.getCmp('rs1.daftarBaru.btnSearchKtp').disable();
									Ext.getCmp('rs1.daftarBaru.btnSearchPeserta').disable();
									Ext.getCmp('rs1.daftarBaru.panel.2').hide();
									Ext.getCmp('rs1.daftarBaru.panel.1').show();
									Ext.getCmp('rs1.daftarBaru').show();
									Ext.getCmp('rs1.daftarBaru.panel').qReset();
									Ext.getCmp('rs1.daftarBaru.idBpjs').setValue(r.data.d);
									Ext.getCmp('rs1.daftarBaru.p').setValue('UPDATE');
									Ext.getCmp('rs1.daftarBaru.panel').qSetForm();
									Ext.getCmp('rs1.daftarBaru.panel.1').qSetForm();
									Ext.getCmp('rs1.daftarBaru.panel.2').qSetForm();
									Ext.getCmp('rs1.daftarBaru.f1').setValue(o.f1);
									Ext.getCmp('rs1.daftarBaru.f2').setValue(o.f2);
									Ext.getCmp('rs1.daftarBaru.f3').setValue(o.f3);
									Ext.getCmp('rs1.daftarBaru.f4').setValue(o.f4);
									Ext.getCmp('rs1.daftarBaru.i').setValue(data.i);
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
									Ext.getCmp('rs1.daftarBaru.f13').setRawValue(o.f13t);
									Ext.getCmp('rs1.daftarBaru.f14').setValue(o.f14);
									Ext.getCmp('rs1.daftarBaru.f15').setValue(o.f15);
									Ext.getCmp('rs1.daftarBaru.f15').setRawValue(o.f15t);
									Ext.getCmp('rs1.daftarBaru.f16').setValue(o.f16);
									Ext.getCmp('rs1.daftarBaru.f17').setValue(o.f17);
									Ext.getCmp('rs1.daftarBaru.f17').setRawValue(o.f17t);
									Ext.getCmp('rs1.daftarBaru.f18').setValue(o.f18);
									Ext.getCmp('rs1.daftarBaru.f19').setValue(o.f19);
									Ext.getCmp('rs1.daftarBaru.f19').setRawValue(o.f19t);
									Ext.getCmp('rs1.daftarBaru.f20').setValue(o.f20);
									Ext.getCmp('rs1.daftarBaru.f21').setValue(o.f21);
									Ext.getCmp('rs1.daftarBaru.f30').setValue(o.f30);
									Ext.getCmp('rs1.daftarBaru.f31').setValue(o.f31);
									Ext.getCmp('rs1.daftarBaru.f32').setValue(o.f32);
									Ext.getCmp('rs1.daftarBaru.f33').setValue(o.f33);
									
									Ext.getCmp('rs1.daftarBaru.f33').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs1.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    }
//		    	{
//		        xtype: 'buttongroup',
//		        columns: 1,
//		        title: 'Action Menu',
//		        items: [{
//		            text: 'Daftar Lama',
//		            scale: 'large',
//		            disabled:true,
//		            id:'rs1.btnImport',
//		            iconCls: 'i-register-large',
//		            iconAlign: 'top',
//		            handler : function(a) {
//		            	var data=Ext.getCmp('rs1.list').dataRow;
//		            	Ext.getCmp('rs1.list').setLoading('Loading');
//						Ext.Ajax.request({
//							url : url + 'app/rs1/initDaftar',
//							params:{i:data.i},
//							method : 'GET',
//							success : function(response) {
//								Ext.getCmp('rs1.list').setLoading(false);
//								var r = ajaxSuccess(response);
//								if (r.result == 'SUCCESS') {
//									var o=r.data.o;
//									Ext.getCmp('rs1.daftarBaru').closing = false;
//									Ext.getCmp('rs1.daftarBaru.f5').addReset(r.data.l);
//									Ext.getCmp('rs1.daftarBaru.f6').addReset(r.data.l1);
//									Ext.getCmp('rs1.daftarBaru.f7').addReset(r.data.l2);
//									Ext.getCmp('rs1.daftarBaru.f22').addReset(r.data.l3);
//									Ext.getCmp('rs1.daftarBaru.f25').addReset(r.data.l4);
//									Ext.getCmp('rs1.daftarBaru.f30').addReset(r.data.l5);
//									Ext.getCmp('rs1.daftarBaru.f12').disable();
//									Ext.getCmp('rs1.daftarBaru.f14').disable();
//									Ext.getCmp('rs1.daftarBaru.f16').disable();
//									Ext.getCmp('rs1.daftarBaru.f18').disable();
//									Ext.getCmp('rs1.daftarBaru.f20').disable();
//									Ext.getCmp('rs1.daftarBaru.f23').disable();
//									Ext.getCmp('rs1.daftarBaru.btnSearchKtp').disable();
//									Ext.getCmp('rs1.daftarBaru.btnSearchPeserta').disable();
//									Ext.getCmp('rs1.daftarBaru.panel.2').hide();
//									Ext.getCmp('rs1.daftarBaru.panel.1').show();
//									Ext.getCmp('rs1.daftarBaru').show();
//									Ext.getCmp('rs1.daftarBaru.panel').qReset();
//									Ext.getCmp('rs1.daftarBaru.idBpjs').setValue(r.data.d);
//									Ext.getCmp('rs1.daftarBaru.p').setValue('UPDATE');
//									Ext.getCmp('rs1.daftarBaru.panel').qSetForm();
//									Ext.getCmp('rs1.daftarBaru.panel.1').qSetForm();
//									Ext.getCmp('rs1.daftarBaru.panel.2').qSetForm();
//									Ext.getCmp('rs1.daftarBaru.f1').setValue(o.f1);
//									Ext.getCmp('rs1.daftarBaru.f2').setValue(o.f2);
//									Ext.getCmp('rs1.daftarBaru.f3').setValue(o.f3);
//									Ext.getCmp('rs1.daftarBaru.f4').setValue(o.f4);
//									Ext.getCmp('rs1.daftarBaru.i').setValue(data.i);
//									Ext.getCmp('rs1.daftarBaru.f5').setValue(o.f5);
//									Ext.getCmp('rs1.daftarBaru.f6').setValue(o.f6);
//									Ext.getCmp('rs1.daftarBaru.f7').setValue(o.f7);
//									Ext.getCmp('rs1.daftarBaru.f8').setValue(o.f8);
//									Ext.getCmp('rs1.daftarBaru.f9').setValue(o.f9);
//									Ext.getCmp('rs1.daftarBaru.f10').setValue(o.f10);
//									Ext.getCmp('rs1.daftarBaru.f11').setValue(o.f11);
//									Ext.getCmp('rs1.daftarBaru.f11').setRawValue(o.f11t);
//									if(o.f11==0){
//										Ext.getCmp('rs1.daftarBaru.f12').enable();
//									}
//									if(o.f13==0){
//										Ext.getCmp('rs1.daftarBaru.f14').enable();
//									}
//									if(o.f15==0){
//										Ext.getCmp('rs1.daftarBaru.f16').enable();
//									}
//									if(o.f17==0){
//										Ext.getCmp('rs1.daftarBaru.f18').enable();
//									}
//									if(o.f19==0){
//										Ext.getCmp('rs1.daftarBaru.f20').enable();
//									}
//									Ext.getCmp('rs1.daftarBaru.f12').setValue(o.f12);
//									Ext.getCmp('rs1.daftarBaru.f13').setValue(o.f13);
//									Ext.getCmp('rs1.daftarBaru.f13').setRawValue(o.f13t);
//									Ext.getCmp('rs1.daftarBaru.f14').setValue(o.f14);
//									Ext.getCmp('rs1.daftarBaru.f15').setValue(o.f15);
//									Ext.getCmp('rs1.daftarBaru.f15').setRawValue(o.f15t);
//									Ext.getCmp('rs1.daftarBaru.f16').setValue(o.f16);
//									Ext.getCmp('rs1.daftarBaru.f17').setValue(o.f17);
//									Ext.getCmp('rs1.daftarBaru.f17').setRawValue(o.f17t);
//									Ext.getCmp('rs1.daftarBaru.f18').setValue(o.f18);
//									Ext.getCmp('rs1.daftarBaru.f19').setValue(o.f19);
//									Ext.getCmp('rs1.daftarBaru.f19').setRawValue(o.f19t);
//									Ext.getCmp('rs1.daftarBaru.f20').setValue(o.f20);
//									Ext.getCmp('rs1.daftarBaru.f21').setValue(o.f21);
//									Ext.getCmp('rs1.daftarBaru.f30').setValue(o.f30);
//									Ext.getCmp('rs1.daftarBaru.f31').setValue(o.f31);
//									Ext.getCmp('rs1.daftarBaru.f32').setValue(o.f32);
//									Ext.getCmp('rs1.daftarBaru.f33').setValue(o.f33);
//									
//									Ext.getCmp('rs1.daftarBaru.f33').focus();
//								}
//							},
//							failure : function(jqXHR, exception) {
//								Ext.getCmp('rs1.list').setLoading(false);
//								ajaxError(jqXHR, exception);
//							}
//						});
//					}
//		        }]
//		    }
		    ]
		})  
	],
	columns:[
		{ xtype: 'rownumberer'},
		{ hidden:true, dataIndex: 'i', hideable:false },
		{ text: 'Nomor Medrec',width: 100, dataIndex: 'f1',align:'center' },
		{ text: 'No. KTP',width: 100, dataIndex: 'f7',align:'center' },
		{ text: 'Nama Pasien',width: 200, dataIndex: 'f2'},
		{ text: 'Jenis Kelamin',width: 100, dataIndex: 'f3',align:'center' },
		{ text: 'Tgl. Lahir',width: 100, dataIndex: 'f4',align:'center' },
		{ text: 'No. Telepon',width: 100, dataIndex: 'f6',align:'center' },
		{ text: 'Alamat',flex: 1,dataIndex: 'f5'},
		{
			text: 'Daftar',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-add',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('rs1.list').setLoading('Loading');
				Ext.Ajax.request({
					url : url + 'app/rs1/initDaftar',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('rs1.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('rs1.daftarBaru').closing = false;
							Ext.getCmp('rs1.daftarBaru.f5').addReset(r.data.l);
							Ext.getCmp('rs1.daftarBaru.f6').addReset(r.data.l1);
							Ext.getCmp('rs1.daftarBaru.f7').addReset(r.data.l2);
							Ext.getCmp('rs1.daftarBaru.f22').addReset(r.data.l3);
							Ext.getCmp('rs1.daftarBaru.f25').addReset(r.data.l4);
							Ext.getCmp('rs1.daftarBaru.f30').addReset(r.data.l5);
							Ext.getCmp('rs1.daftarBaru.f12').disable();
							Ext.getCmp('rs1.daftarBaru.f14').disable();
							Ext.getCmp('rs1.daftarBaru.f16').disable();
							Ext.getCmp('rs1.daftarBaru.f18').disable();
							Ext.getCmp('rs1.daftarBaru.f20').disable();
							Ext.getCmp('rs1.daftarBaru.f23').disable();
							Ext.getCmp('rs1.daftarBaru.f34').disable();
							Ext.getCmp('rs1.daftarBaru').dataBpjs=null;
							Ext.getCmp('rs1.daftarBaru').dataSep=null;
							Ext.getCmp('rs1.daftarBaru.btnSearchKtp').disable();
							Ext.getCmp('rs1.daftarBaru.btnSearchPeserta').disable();
							Ext.getCmp('rs1.daftarBaru.panel.2').hide();
							Ext.getCmp('rs1.daftarBaru.panel.1').show();
							Ext.getCmp('rs1.daftarBaru').show();
							Ext.getCmp('rs1.daftarBaru.panel').qReset();
							Ext.getCmp('rs1.daftarBaru.idBpjs').setValue(r.data.d);
							Ext.getCmp('rs1.daftarBaru.panel').qSetForm();
							Ext.getCmp('rs1.daftarBaru.panel.1').qSetForm();
							Ext.getCmp('rs1.daftarBaru.panel.2').qSetForm();
							Ext.getCmp('rs1.daftarBaru.f1').setValue(o.f1);
							Ext.getCmp('rs1.daftarBaru.f2').setValue(o.f2);
							Ext.getCmp('rs1.daftarBaru.f3').setValue(o.f3);
							Ext.getCmp('rs1.daftarBaru.f4').setValue(o.f4);
							Ext.getCmp('rs1.daftarBaru.i').setValue(record.data.i);
							Ext.getCmp('rs1.daftarBaru.f5').setValue(o.f5);
							Ext.getCmp('rs1.daftarBaru.f6').setValue(o.f6);
							Ext.getCmp('rs1.daftarBaru.f7').setValue(o.f7);
							Ext.getCmp('rs1.daftarBaru.f8').setValue(o.f8);
							Ext.getCmp('rs1.daftarBaru.f9').setValue(o.f9);
							Ext.getCmp('rs1.daftarBaru.f10').setValue(o.f10);
							Ext.getCmp('rs1.daftarBaru.f11').setValue(o.f11);
							Ext.getCmp('rs1.daftarBaru.p').setValue('UPDATE');
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
							Ext.getCmp('rs1.daftarBaru.f14').setValue(o.f14);
							Ext.getCmp('rs1.daftarBaru.f15').setValue(o.f15);
							Ext.getCmp('rs1.daftarBaru.f16').setValue(o.f16);
							Ext.getCmp('rs1.daftarBaru.f17').setValue(o.f17);
							Ext.getCmp('rs1.daftarBaru.f18').setValue(o.f18);
							Ext.getCmp('rs1.daftarBaru.f19').setValue(o.f19);
							Ext.getCmp('rs1.daftarBaru.f20').setValue(o.f20);
							Ext.getCmp('rs1.daftarBaru.f21').setValue(o.f21);
							Ext.getCmp('rs1.daftarBaru.f30').setValue(o.f30);
							Ext.getCmp('rs1.daftarBaru.f31').setValue(o.f31);
							Ext.getCmp('rs1.daftarBaru.f32').setValue(o.f32);
							Ext.getCmp('rs1.daftarBaru.f33').setValue(o.f33);
							
							Ext.getCmp('rs1.daftarBaru.f33').focus();
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('rs1.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		}
	]
});