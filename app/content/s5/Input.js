Ext.define('App.content.s5.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'s5.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'s5.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('s5.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('s5.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 's5.save',
					onY : function() {
						Ext.getCmp('s5.input').setLoading('Saving');
						var param = Ext.getCmp('s5.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/s5/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('s5.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s5.input').qClose();
									Ext.getCmp('s5.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s5.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('s5.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('s5.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 's5.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'s5.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'s5.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Customer',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 's5.input.f1',
							width: 150,
							emptyText:'Jenis Unit',
							name : 'f1',
							submit:'s5.input.btnSave',
							allowBlank : false
						})
					]
				}), 
				new Ext.create('App.cmp.Input', {
					label : 'Jenis Customer',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 's5.input.f2',
							width: 150,
							emptyText:'Jenis Unit',
							name : 'f2',
							submit:'s5.input.btnSave',
							allowBlank : false
						})
					]
				}), 
				new Ext.create('App.cmp.Input',{
					label:'Kontak',
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:64,
							emptyText:'Kontak',
							name:'f3',
							width: 200,
							submit:'s5.input.btnSave',
							id:'s5.input.f3'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('s5.input.panel').qGetForm() == false)
			Ext.getCmp('s5.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 's5.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})