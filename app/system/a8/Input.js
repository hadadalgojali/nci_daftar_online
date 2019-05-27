Ext.define('App.system.a8.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'a8.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'a8.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('a8.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('a8.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'a8.save',
					onY : function() {
						Ext.getCmp('a8.input').setLoading('Saving');
						var param = Ext.getCmp('a8.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/a8/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('a8.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a8.input').qClose();
									Ext.getCmp('a8.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a8.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('a8.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('a8.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'a8.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 350,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'a8.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'a8.input.i'
				}),
				new Ext.create('App.cmp.Input',{
					label:'Tenant',
					id:'a8.label.t',
					hidden:true,
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 'a8.input.t',
							name : 't',
							submit:'a8.input.btnSave',
							width: 150,
							emptyText:'Tenant'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Sequence Code',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:16,
							emptyText:'Sequence Code',
							name:'f1',
							submit:'a8.input.btnSave',
							id:'a8.input.f1',
							result:'upper',
							space:false,
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Sequence Name',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:64,
							name:'f2',
							emptyText:'Sequence Name',
							width: 200,
							submit:'a8.input.btnSave',
							id:'a8.input.f2',
							result:'dynamic',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Digit',
					nullData : false,
					items:[
						new Ext.create('App.cmp.NumberField',{
							name:'f3',
							emptyText:'Digit',
							width: 100,
							submit:'a8.input.btnSave',
							id:'a8.input.f3',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Last value',
					nullData : false,
					items:[
						new Ext.create('App.cmp.NumberField',{
							name:'f4',
							emptyText:'Last Value',
							width: 100,
							submit:'a8.input.btnSave',
							id:'a8.input.f4',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Format',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextArea',{
							name:'f5',
							emptyText:'Format',
							width: 200,
							maxLength:128,
							id:'a8.input.f5',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Repeat Type',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a8.input.f6',
							emptyText:'Repeat Type',
							name : 'f6',
							width: 200,
							submit:'a8.input.btnSave',
							allowBlank : false
						})
					]
				}), 
				new Ext.create('App.cmp.Input',{
					label:'Active',
					items:[
						new Ext.create('App.cmp.CheckBox',{
							name:'f7',
							checked:true,
							id:'a8.input.f7'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('a8.input.panel').qGetForm() == false)
			Ext.getCmp('a8.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'a8.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})