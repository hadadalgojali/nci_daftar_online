Ext.define('App.content.rs3.Verifikasi',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'rs3.verifikasi',
	title:'Rujukan - Verifikasi',
	modal : true,
	fbar: [{
		text: 'Save',
		id:'rs3.verifikasi.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('rs3.verifikasi.panel').qGetForm(true);
			if(req == false){
				if(Ext.getCmp('rs3.verifikasi.f1').getValue()!='STATRUJ_NONE'){
					Ext.getCmp('rs3.confirm').confirm({
						msg : 'Are you sure Save this Data ?',
						allow : 'rs3.save',
						onY : function() {
							Ext.getCmp('rs3.verifikasi').setLoading('Saving');
							var param = Ext.getCmp('rs3.verifikasi.panel').qParams();
							Ext.Ajax.request({
								url : url + 'app/rs3/saveVerifikasi',
								method : 'POST',
								params:param,
								success : function(response) {
									Ext.getCmp('rs3.verifikasi').setLoading(false);
									var r = ajaxSuccess(response);
									if (r.result == 'SUCCESS') {
										Ext.getCmp('rs3.verifikasi').qClose();
										Ext.getCmp('rs3.list').refresh();
									}
								},
								failure : function(jqXHR, exception) {
									Ext.getCmp('rs3.verifikasi').setLoading(false);
									ajaxError(jqXHR, exception);
								}
							});
						}
					});
				}else{
					Ext.getCmp('rs3.verifikasi').qClose();
				}
			}else if(req==true)
				Ext.getCmp('rs3.verifikasi').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('rs3.verifikasi').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'rs3.verifikasi.panel',
			width: 580,
			items:[
				new Ext.create('App.cmp.Panel',{
					bodyStyle : 'padding: 5px 10px',
					width: 580,
					title:'Data Rujukan', 
					items:[
						new Ext.create('App.cmp.HiddenField',{
							name:'i',
							id:'rs3.verifikasi.i'
						}),
						new Ext.create('App.cmp.Input',{
							label:'Pasien',
							items:[
								new Ext.create('Ext.form.DisplayField',{
									id:'rs3.verifikasi.d1'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Poliklinik',
							items:[
								new Ext.create('App.cmp.TextField',{
									width: 300,
									readOnly:true,
									id:'rs3.verifikasi.d2'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Dokter',
							items:[
								new Ext.create('Ext.form.DisplayField',{
									id:'rs3.verifikasi.d3'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Penjamin',
							items:[
								new Ext.create('App.cmp.TextField',{
									width: 150,
									readOnly:true,
									id:'rs3.verifikasi.d4'
								}),
								new Ext.create('Ext.form.DisplayField',{
									value:' &nbsp; No. Peserta BPJS : &nbsp;'
								}),
								new Ext.create('App.cmp.TextField',{
									width: 100,
									readOnly:true,
									id:'rs3.verifikasi.d5'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Diagnosa',
							items:[
								new Ext.create('App.cmp.TextField',{
									width: 400,
									readOnly:true,
									id:'rs3.verifikasi.d6'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Tindakan Yg Diberikan',
							items:[
								new Ext.create('App.cmp.TextArea',{
									width: 400,
									readOnly:true,
									id:'rs3.verifikasi.d7'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Obat Yg Diberikan',
							items:[
								new Ext.create('App.cmp.TextArea',{
									width: 400,
									readOnly:true,
									id:'rs3.verifikasi.d8'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Pemeriksaan Penunjang Yg Diberikan',
							items:[
								new Ext.create('App.cmp.TextArea',{
									width: 400,
									readOnly:true,
									id:'rs3.verifikasi.d9'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Catatan',
							items:[
								new Ext.create('App.cmp.TextArea',{
									width: 400,
									readOnly:true,
									id:'rs3.verifikasi.d10'
								})
							]
						})
					]
				}),
				new Ext.create('App.cmp.Panel',{
					bodyStyle : 'padding: 5px 10px',
					width: 580,
					title:'Data Rujukan', 
					items:[
						new Ext.create('App.cmp.Input', {
							label : 'Status Verifikasi',
							nullData : false,
							items : [
								new Ext.create('App.cmp.DropDown', {
									id : 'rs3.verifikasi.f1',
									width: 150,
									emptyText:'Status Verifikasi',
									name : 'f1',
									submit:'rs3.verifikasi.btnSave',
									allowBlank : false,
									listeners:{
										select:function(a){
											if(a.getValue()=='STATRUJ_BLOK'){
												Ext.getCmp('rs3.verifikasi.f2').enable();
											}else{
												Ext.getCmp('rs3.verifikasi.f2').disable();
												Ext.getCmp('rs3.verifikasi.f2').setValue('');
											}
										}
									}
								})
							]
						}), 
						new Ext.create('App.cmp.Input',{
							label:'Alasan Penolakan',
							nullData : false,
							items:[
								new Ext.create('App.cmp.TextArea',{
									maxLength:128,
									emptyText:'Alasan Penolakan',
									name:'f2',
									width: 300,
									disabled:true,
									allowBlank : false,
									submit:'rs3.verifikasi.btnSave',
									id:'rs3.verifikasi.f2'
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
		if (Ext.getCmp('rs3.verifikasi.panel').qGetForm() == false)
			Ext.getCmp('rs3.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'rs3.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})