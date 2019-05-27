Ext.define('App.content.drh5.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'drh5.input',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'drh5.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('drh5.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('drh5.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'drh5.save',
					onY : function() {
						Ext.getCmp('drh5.input').setLoading('Saving');
						var param = Ext.getCmp('drh5.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/drh5/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('drh5.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh5.input').qClose();
									Ext.getCmp('drh5.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh5.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('drh5.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('drh5.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'drh5.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'drh5.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'drh5.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Kecamatan',
					nullData : false,
					items : [
						new Ext.create('App.cmp.AutoComplete',{
							name:'f1',
							submit:'drh5.input.btnSave',
							width: 200,
							id:'drh5.input.f1',
							emptyText:'Kecamatan',
							url:url+'app/drh5/getDistricts',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Kelurahan',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'Nama Kelurahan',
							name:'f2',
							width: 200,
							submit:'drh5.input.btnSave',
							id:'drh5.input.f2',
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
		if (Ext.getCmp('drh5.input.panel').qGetForm() == false)
			Ext.getCmp('drh5.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'drh5.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})