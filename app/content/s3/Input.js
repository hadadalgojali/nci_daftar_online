Ext.define('App.content.s3.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'s3.input',
	closing : false,
	modal : true,
	maximized: true,
	fbar: [{
		text: 'Save',
		id:'s3.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('s3.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('s3.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 's3.save',
					onY : function() {
						Ext.getCmp('s3.input').setLoading('Saving');
						var param = Ext.getCmp('s3.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/s3/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('s3.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s3.input').qClose();
									Ext.getCmp('s3.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s3.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('s3.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('s3.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 's3.input.panel',
			layout:{
				type:'vbox',
				align:'stretch'
			},
			items:[
				new Ext.create('App.cmp.Panel',{
					bodyStyle : 'padding: 5px 10px',
					title:'General Data',
					layout:{
						type:'hbox',
						align:'stretch'
					},
					items:[
						new Ext.create('App.cmp.Panel',{
							items:[
								new Ext.create('App.cmp.HiddenField',{
									name:'p',
									id:'s3.input.p'
								}),
								new Ext.create('App.cmp.HiddenField',{
									name:'i',
									id:'s3.input.i'
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Poliklinik',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 's3.input.f1',
											width: 200,
											emptyText:'Poliklinik',
											name : 'f1',
											submit:'s3.input.btnSave',
											allowBlank : false
										})
									]
								}), 
								new Ext.create('App.cmp.Input',{
									label:'Judul',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:128,
											emptyText:'Judul',
											name:'f3',
											width: 200,
											submit:'s3.input.btnSave',
											id:'s3.input.f3',
											result:'dynamic',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'No. Telepon',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:16,
											emptyText:'No. Telepon',
											name:'f4',
											width: 150,
											submit:'s3.input.btnSave',
											id:'s3.input.f4',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Email',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:128,
											emptyText:'Email',
											name:'f5',
											width: 200,
											submit:'s3.input.btnSave',
											id:'s3.input.f5',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Informasi',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:128,
											emptyText:'Informasi',
											name:'f6',
											width: 200,
											submit:'s3.input.btnSave',
											id:'s3.input.f6',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Alamat Klinik',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:128,
											emptyText:'Alamat Klinik',
											name:'f7',
											width: 200,
											submit:'s3.input.btnSave',
											id:'s3.input.f7',
											allowBlank: false
										})
									]
								})
							]
						}),
						new Ext.create('App.cmp.Panel',{
							style:'padding-left: 10px;',
							items:[
								new Ext.create('App.cmp.Input',{
									label:'Gambar',
									items:[
										new Ext.create('App.cmp.FotoUpload',{
											name: 'f8',
											id:'s3.input.f8'
										})
									]
								})
							]
						})
					]
				}),
				new Ext.create('App.cmp.Panel',{
					flex:1,
					layout: 'fit',
					title:'Description',
					items:[
						new Ext.create('App.cmp.HtmlEditor',{
							name:'f2',
							id:'s3.input.f2'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('s3.input.panel').qGetForm() == false)
			Ext.getCmp('s3.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 's3.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})