Ext.define('App.content.pel6.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'pel6.input',
	closing : false,
	modal : true,
	maximized: true,
	fbar: [{
		text: 'Save',
		id:'pel6.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('pel6.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('pel6.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'pel6.save',
					onY : function() {
						Ext.getCmp('pel6.input').setLoading('Saving');
						var param = Ext.getCmp('pel6.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/pel6/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('pel6.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel6.input').qClose();
									Ext.getCmp('pel6.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel6.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('pel6.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('pel6.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'pel6.input.panel',
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
							id:'pel6.input.p'
						}),
						new Ext.create('App.cmp.HiddenField',{
							name:'i',
							id:'pel6.input.i'
						}),
						new Ext.create('App.cmp.Input',{
							label:'Judul Artikel',
							nullData : false,
							items:[
								new Ext.create('App.cmp.TextField',{
									maxLength:128,
									emptyText:'Judul',
									name:'f1',
									width: 200,
									submit:'pel6.input.btnSave',
									id:'pel6.input.f1',
									result:'dynamic',
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
							id:'pel6.input.f4'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('pel6.input.panel').qGetForm() == false)
			Ext.getCmp('pel6.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'pel6.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})