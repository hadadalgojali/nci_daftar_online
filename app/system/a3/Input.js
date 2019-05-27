Ext.define('App.system.a3.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'a3.input',
	title:'Role',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'a3.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('a3.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('a3.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'a3.save',
					onY : function() {
						Ext.getCmp('a3.input').setLoading('Saving');
						var param = Ext.getCmp('a3.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/A3/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('a3.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a3.input').qClose();
									Ext.getCmp('a3.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a3.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('a3.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('a3.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'a3.input.panel',
			width: 350,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'pageType',
					id:'a3.input.pageType'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'id',
					id:'a3.input.id'
				}),
				new Ext.create('App.cmp.Input',{
					label:'Tenant',
					id:'a3.label.tenant',
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 'a3.input.tenant',
							width: 150,
							submit:'a3.input.btnSave',
							emptyText:'Tenant',
							name : 'tenant'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Role Code',
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:16,
							name:'roleCode',
							emptyText: 'Role Code',
							submit:'a3.input.btnSave',
							id:'a3.input.roleCode',
							result:'upper',
							space:false,
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Role Name',
					items:[
						new Ext.create('App.cmp.TextField',{
							width: 200,
							name:'roleName',
							emptyText:'Role Name',
							submit:'a3.input.btnSave',
							id:'a3.input.roleName',
							maxLength:64,
							result:'dynamic',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Description',
					items:[
						new Ext.create('App.cmp.TextArea',{
							width: 200,
							name:'description',
							emptyText:'Description',
							id:'a3.input.description',
							maxLength:128
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Active',
					items:[
						new Ext.create('App.cmp.CheckBox',{
							name:'activeFlag',
							checked:true,
							id:'a3.input.activeFlag'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('a3.input.panel').qGetForm() == false)
			Ext.getCmp('a3.confirm').confirm({
				msg : 'Whether You Will Ignore All Data ?',
				allow : 'a3.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})