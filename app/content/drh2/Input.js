Ext.define('App.content.drh2.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'drh2.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'drh2.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('drh2.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('drh2.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'drh2.save',
					onY : function() {
						Ext.getCmp('drh2.input').setLoading('Saving');
						var param = Ext.getCmp('drh2.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/drh2/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('drh2.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh2.input').qClose();
									Ext.getCmp('drh2.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh2.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('drh2.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('drh2.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'drh2.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'drh2.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'drh2.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Negara',
					nullData : false,
					items : [
						new Ext.create('App.cmp.AutoComplete',{
							name:'f1',
							submit:'drh2.input.btnSave',
							width: 200,
							id:'drh2.input.f1',
							emptyText:'Negara',
							url:url+'app/drh2/getNegara',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Provinsi',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'Nama Provinsi',
							name:'f2',
							width: 200,
							submit:'drh2.input.btnSave',
							id:'drh2.input.f2',
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
		if (Ext.getCmp('drh2.input.panel').qGetForm() == false)
			Ext.getCmp('drh2.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'drh2.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})