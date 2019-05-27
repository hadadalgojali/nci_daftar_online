Ext.define('App.content.pel1.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'pel1.input',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'pel1.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('pel1.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('pel1.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'pel1.save',
					onY : function() {
						Ext.getCmp('pel1.input').setLoading('Saving');
						var param = Ext.getCmp('pel1.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/pel1/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('pel1.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel1.input').qClose();
									Ext.getCmp('pel1.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel1.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('pel1.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('pel1.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'pel1.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'pel1.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Status',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'pel1.input.f1',
							width: 150,
							emptyText:'Jenis Unit',
							name : 'f1',
							submit:'pel1.input.btnSave',
							allowBlank : false
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('pel1.input.panel').qGetForm() == false)
			Ext.getCmp('pel1.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'pel1.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})