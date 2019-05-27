Ext.define('App.content.rs1.View',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	closeAction:'destroy',
	title:'Pasien',
	modal:true,
	initComponent:function(){
		var $this=this;
		var f={};
		$this.fbar=[{
			text: 'Close',
			iconCls:'i-close',
			handler: function(a,b) {
				$this.hide();
			}
		}];
		this.items=[
			new Ext.create('App.cmp.Panel',{
				width: 680,
				title:'Data Pasien',
				bodyStyle : 'padding: 5px 10px',
				layout:'column',
				items:[
					new Ext.create('App.cmp.Panel',{
						width: 320,
						items:[
							new Ext.create('App.cmp.Input',{
								label:'Kode Pasien',
								bold:true,
								items:[
									f['f1']=new Ext.form.DisplayField({})
								]
							}),  
							new Ext.create('App.cmp.Input',{
								label:'Nomor KTP',
								bold:true,
								items:[
									f['f19']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Gelar',
								bold:true,
								items:[
									f['f2']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Nama Pasien',
								bold:true,
								items:[
									f['f3']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Tempat Lahir',
								bold:true,
								items:[
									f['f4']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Tanggal Lahir',
								bold:true,
								items:[
									f['f5']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Jenis Kelamin',
								bold:true,
								items:[
									f['f6']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Agama',
								bold:true,
								items:[
									f['f7']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Pen. Terakhir',
								bold:true,
								items:[
									f['f8']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Gol. Darah',
								bold:true,
								items:[
									f['f9']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Alamat',
								bold:true,
								items:[
									f['f10']=new Ext.form.DisplayField({})
								]
							})
						]
					}),
					new Ext.create('App.cmp.Panel',{
						width: 320,
						items:[
							new Ext.create('App.cmp.Input',{
								label:'Kode Pos',
								bold:true,
								items:[
									f['f11']=new Ext.form.DisplayField({})
								]
							}),   
							new Ext.create('App.cmp.Input',{
								label:'No. Telp',
								bold:true,
								items:[
									f['f12']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'RT/RW',
								bold:true,
								items:[
									f['f13']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Negara',
								bold:true,
								items:[
									f['f14']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Provinsi',
								bold:true,
								items:[
									f['f15']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Kota',
								bold:true,
								items:[
									f['f16']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Kecamatan',
								bold:true,
								items:[
									f['f17']=new Ext.form.DisplayField({})
								]
							}),
							new Ext.create('App.cmp.Input',{
								label:'Kelurahan',
								bold:true,
								items:[
									f['f18']=new Ext.form.DisplayField({})
								]
							})
						]
					})
				]
			})
		]
		this.callParent();
		Ext.getBody().mask('Loading');
		Ext.Ajax.request({
			url : url + 'app/RS1/getById',
			method : 'GET',
			params:{i:$this.dataId},
			success : function(response) {
				Ext.getBody().unmask();
				var r = ajaxSuccess(response);
				if (r.result == 'SUCCESS') {
					var o=r.data;
					f['f1'].setValue(o.f1);
					f['f2'].setValue(o.f2);
					f['f3'].setValue(o.f3);
					f['f4'].setValue(o.f4);
					f['f5'].setValue(o.f5);
					f['f6'].setValue(o.f6);
					f['f7'].setValue(o.f7);
					f['f8'].setValue(o.f8);
					f['f9'].setValue(o.f9);
					f['f10'].setValue(o.f10);
					f['f11'].setValue(o.f11);
					f['f12'].setValue(o.f12);
					f['f13'].setValue(o.f13);
					f['f14'].setValue(o.f14);
					f['f15'].setValue(o.f15);
					f['f16'].setValue(o.f16);
					f['f17'].setValue(o.f17);
					f['f18'].setValue(o.f18);
					f['f19'].setValue(o.f19);
					
					$this.show();
					$this.center();
				}
			},
			failure : function(jqXHR, exception) {
				Ext.getBody().unmask();
				ajaxError(jqXHR, exception);
			}
		});
	}
})