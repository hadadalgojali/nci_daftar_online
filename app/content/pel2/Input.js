Ext.define('App.content.pel2.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'pel2.input',
	closing : false,
	modal : true,
	maximized: true,
	fbar: [{
		text: 'Save',
		id:'pel2.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('pel2.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('pel2.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'pel2.save',
					onY : function() {
						Ext.getCmp('pel2.input').setLoading('Saving');
						var param = Ext.getCmp('pel2.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/pel2/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('pel2.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel2.input').qClose();
									Ext.getCmp('pel2.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel2.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('pel2.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('pel2.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'pel2.input.panel',
			layout:{
				type:'vbox',
				align:'stretch'
			},
			items:[
				new Ext.create('App.cmp.Panel',{
					bodyStyle : 'padding: 5px 10px',
					title:'General Data',
					items:[
						new Ext.create('App.cmp.HiddenField',{
							name:'p',
							id:'pel2.input.p'
						}),
						new Ext.create('App.cmp.HiddenField',{
							name:'i',
							id:'pel2.input.i'
						}),
						new Ext.create('App.cmp.Input',{
							label:'Judul Promo',
							nullData : false,
							items:[
								new Ext.create('App.cmp.TextField',{
									maxLength:128,
									emptyText:'Judul',
									name:'f1',
									width: 200,
									submit:'pel2.input.btnSave',
									id:'pel2.input.f1',
									result:'dynamic',
									allowBlank: false
								})
							]
						}),
						new Ext.create('App.cmp.Input', {
							label : 'Tanggal Berlaku',
							nullData : false,
							items : [
								new Ext.create('App.cmp.DateField', {
									id : 'pel2.input.f2',
									name : 'f2',
									submit:'pel2.input.btnSave',
									emptyText: 'Dari',
									allowBlank: false
								}),
								new Ext.create('Ext.form.DisplayField', {
									value:' &nbsp; - &nbsp; '
								}),
								new Ext.create('App.cmp.DateField', {
									id : 'pel2.input.f3',
									name : 'f3',
									submit:'pel2.input.btnSave',
									emptyText: 'Sampai',
									allowBlank: false
								})
							]
						})
					]
				}),
				new Ext.create('App.cmp.Panel',{
					flex:1,
					layout: 'fit',
					title:'Isi',
					items:[
						new Ext.create('App.cmp.HtmlEditor',{
							name:'f4',
							id:'pel2.input.f4'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('pel2.input.panel').qGetForm() == false)
			Ext.getCmp('pel2.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'pel2.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})