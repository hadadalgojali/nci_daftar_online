Ext.define('App.content.pel4.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'pel4.input',
	modal : true,
	maximized: true,
	fbar: [{
		text: 'Save',
		id:'pel4.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('pel4.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('pel4.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'pel4.save',
					onY : function() {
						Ext.getCmp('pel4.input').setLoading('Saving');
						var param = Ext.getCmp('pel4.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/pel4/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('pel4.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel4.input').qClose();
									Ext.getCmp('pel4.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel4.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('pel4.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('pel4.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'pel4.input.panel',
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
							id:'pel4.input.p'
						}),
						new Ext.create('App.cmp.HiddenField',{
							name:'i',
							id:'pel4.input.i'
						}),
						new Ext.create('App.cmp.Input', {
							label : 'Customer',
							nullData : false,
							items : [
								new Ext.create('App.cmp.DropDown', {
									id : 'pel4.input.f1',
									width: 250,
									emptyText:'Jenis Unit',
									name : 'f1',
									submit:'pel4.input.btnSave',
									allowBlank : false
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
							name:'f2',
							id:'pel4.input.f2'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('pel4.input.panel').qGetForm() == false)
			Ext.getCmp('pel4.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'pel4.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})