Ext.define('App.system.a6.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'a6.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'a6.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('a6.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('a6.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'a6.save',
					onY : function() {
						Ext.getCmp('a6.input').setLoading('Saving');
						var param = Ext.getCmp('a6.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/a6/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('a6.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a6.input').qClose();
									Ext.getCmp('a6.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a6.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('a6.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('a6.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'a6.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'a6.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'a6.input.i'
				}),
				new Ext.create('App.cmp.Input',{
					label:'Tenant',
					id:'a6.label.t',
					hidden:true,
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 'a6.input.t',
							name : 't',
							submit:'a6.input.btnSave',
							width: 150,
							emptyText:'Tenant'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Prop Code',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:16,
							emptyText:'Prop Code',
							name:'f1',
							submit:'a6.input.btnSave',
							id:'a6.input.f1',
							result:'upper',
							space:false,
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Prop Name',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:64,
							name:'f2',
							emptyText:'Prop Name',
							width: 200,
							submit:'a6.input.btnSave',
							id:'a6.input.f2',
							result:'dynamic',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Value',
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'f3',
							emptyText:'Value',
							width: 200,
							maxLength:128,
							submit:'a6.input.btnSave',
							id:'a6.input.f3'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Description',
					items:[
						new Ext.create('App.cmp.TextArea',{
							name:'f4',
							emptyText:'Description',
							width: 200,
							maxLength:128,
							id:'a6.input.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Active',
					items:[
						new Ext.create('App.cmp.CheckBox',{
							name:'f5',
							checked:true,
							id:'a6.input.f5'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('a6.input.panel').qGetForm() == false)
			Ext.getCmp('a6.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'a6.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})