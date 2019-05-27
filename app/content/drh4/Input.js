Ext.define('App.content.drh4.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'drh4.input',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'drh4.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('drh4.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('drh4.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'drh4.save',
					onY : function() {
						Ext.getCmp('drh4.input').setLoading('Saving');
						var param = Ext.getCmp('drh4.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/drh4/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('drh4.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh4.input').qClose();
									Ext.getCmp('drh4.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh4.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('drh4.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('drh4.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'drh4.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'drh4.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'drh4.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Kota',
					nullData : false,
					items : [
						new Ext.create('App.cmp.AutoComplete',{
							name:'f1',
							submit:'drh4.input.btnSave',
							width: 200,
							id:'drh4.input.f1',
							emptyText:'Kota',
							url:url+'app/drh4/getCity',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Kecamatan',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'Nama Kecamatan',
							name:'f2',
							width: 200,
							submit:'drh4.input.btnSave',
							id:'drh4.input.f2',
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
		if (Ext.getCmp('drh4.input.panel').qGetForm() == false)
			Ext.getCmp('drh4.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'drh4.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})