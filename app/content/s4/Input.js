Ext.define('App.content.s4.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'s4.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'s4.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('s4.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('s4.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 's4.save',
					onY : function() {
						Ext.getCmp('s4.input').setLoading('Saving');
						var param = Ext.getCmp('s4.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/s4/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('s4.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s4.input').qClose();
									Ext.getCmp('s4.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s4.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('s4.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('s4.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 's4.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'s4.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'s4.input.i'
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Customer',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:128,
							emptyText:'Nama Customer',
							name:'f1',
							width: 200,
							submit:'s4.input.btnSave',
							id:'s4.input.f1',
							result:'dynamic',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Kode Customer',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'Kode Customer',
							name:'f2',
							width: 200,
							submit:'s4.input.btnSave',
							id:'s4.input.f2',
							allowBlank: false
						})
					]
				}),
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('s4.input.panel').qGetForm() == false)
			Ext.getCmp('s4.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 's4.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})