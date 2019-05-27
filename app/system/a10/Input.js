Ext.define('App.system.a10.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'a10.input',
	modal : true,
	fbar: [{
		text: 'Save',
		id:'a10.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('a10.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('a10.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'a10.save',
					onY : function() {
						Ext.getCmp('a10.input').setLoading('Saving');
						var param = Ext.getCmp('a10.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/a10/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('a10.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a10.input').qClose();
									Ext.getCmp('a10.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a10.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('a10.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('a10.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'a10.input.panel',
			width: 350,
			bodyStyle : 'padding: 5px 10px',
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'a10.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'a10.input.i'
				}),
				new Ext.create('App.cmp.Input',{
					label:'Judul',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:64,
							name:'f1',
							emptyText:'Judul',
							width: 200,
							submit:'a10.input.btnSave',
							id:'a10.input.f1',
							result:'dynamic',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Gambar',
					items:[
						new Ext.create('App.cmp.FotoUpload',{
							name: 'f2',
							id:'a10.input.f2'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('a10.input.panel').qGetForm() == false)
			Ext.getCmp('a10.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'a10.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})