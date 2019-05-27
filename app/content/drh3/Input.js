Ext.define('App.content.drh3.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'drh3.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'drh3.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('drh3.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('drh3.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'drh3.save',
					onY : function() {
						Ext.getCmp('drh3.input').setLoading('Saving');
						var param = Ext.getCmp('drh3.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/drh3/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('drh3.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh3.input').qClose();
									Ext.getCmp('drh3.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh3.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('drh3.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('drh3.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'drh3.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'drh3.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'drh3.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Provinsi',
					nullData : false,
					items : [
						new Ext.create('App.cmp.AutoComplete',{
							name:'f1',
							submit:'drh3.input.btnSave',
							width: 200,
							id:'drh3.input.f1',
							emptyText:'Provinsi',
							url:url+'app/drh3/getProvince',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Kota',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'Nama Kota',
							name:'f2',
							width: 200,
							submit:'drh3.input.btnSave',
							id:'drh3.input.f2',
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
		if (Ext.getCmp('drh3.input.panel').qGetForm() == false)
			Ext.getCmp('drh3.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'drh3.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})