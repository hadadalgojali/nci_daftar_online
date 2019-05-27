Ext.define('App.content.drh1.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'drh1.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'drh1.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('drh1.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('drh1.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'drh1.save',
					onY : function() {
						Ext.getCmp('drh1.input').setLoading('Saving');
						var param = Ext.getCmp('drh1.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/drh1/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('drh1.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh1.input').qClose();
									Ext.getCmp('drh1.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh1.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('drh1.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('drh1.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'drh1.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'drh1.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'drh1.input.i'
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Negara',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'Nama Negara',
							name:'f1',
							width: 200,
							submit:'drh1.input.btnSave',
							id:'drh1.input.f1',
							result:'dynamic',
							allowBlank: false
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('drh1.input.panel').qGetForm() == false)
			Ext.getCmp('drh1.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'drh1.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})