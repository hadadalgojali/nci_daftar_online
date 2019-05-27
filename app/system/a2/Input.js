Ext.define('App.system.a2.Input', {
	extend 	: 'App.cmp.Window',
	id 		: 'a2.input',
	hidden 	: true,
	title 	: 'Menu',
	iconCls : 'i-menu',
	closing : false,
	modal 	: true,
	fbar 	: [
		{
			xType 	: 'button',
			text 	: 'Save',
			id		: 'a2.input.btnSave',
			iconCls 	: 'i-save',
			handler : function() {
				var req=Ext.getCmp('a2.input.panel').qGetForm(true);
				if (req== false) 
					Ext.getCmp('a2.confirm').confirm({
						msg : 'Are you sure Save this Data ?',
						allow : 'a2.save',
						onY : function() {
							Ext.getCmp('a2.input').setLoading('Saving');
							var param = Ext.getCmp('a2.input.panel').qParams();
							Ext.Ajax.request({
								url : url + 'app/A2/save',
								method : 'POST',
								params : param,
								success : function(response) {
									Ext.getCmp('a2.input').setLoading(false);
									var r = ajaxSuccess(response);
									if (r.result == 'SUCCESS') {
										Ext.getCmp('a2.input').qClose();
										Ext.getCmp('main.tabA2').setLoading('Loading');
										Ext.Ajax.request({
											url : url + 'app/A2/getList',
											method : 'GET',
											success : function(response) {
												Ext.getCmp('main.tabA2').setLoading(false);
												var r = ajaxSuccess(response);
												if (r.result == 'SUCCESS') {
													Ext.getCmp('a2.list').store.setRootNode([]);
													var c = Ext.getCmp('a2.list').store.getRootNode();
													c.insertChild(1, r.data);
													Ext.getCmp('a2.list').expandAll()
												}
											},
											failure : function(jqXHR, exception) {
												Ext.getCmp('main.tabA2').setLoading(false);
												ajaxError(jqXHR, exception);
											}
										});
									}
								},
								failure : function(jqXHR, exception) {
									Ext.getCmp('a2.input').setLoading(false);
									ajaxError(jqXHR, exception);
								}
							});
						}
					});
				else if(req==true)
					Ext.getCmp('a2.input').close();
			}
		},{
			xType : 'button',
			text : 'Close',
			iconCls : 'i-close',
			handler : function() {
				Ext.getCmp('a2.input').close();
			}
		}
	],
	items : [
		new Ext.create('App.cmp.Panel', {
			bodyStyle : 'padding: 5px 10px',
			width:350,
			id : 'a2.input.panel',
			items : [
				new Ext.create('App.cmp.HiddenField', {
					id : 'a2.input.parentCode',
					name : 'parentCode'
				}), 
				new Ext.create('App.cmp.HiddenField', {
					id : 'a2.input.pageType',
					name : 'pageType'
				}), 
				new Ext.create('App.cmp.Input', {
					label : 'Menu Code',
					nullData : false,
					items : [
						new Ext.create('App.cmp.TextField', {
							id : 'a2.input.menuCode',
							submit	: 'a2.input.btnSave',
							name : 'menuCode',
							maxLength:16,
							emptyText:'Menu Code',
							result : 'upper',
							space : false,
							allowBlank : false
						})
					]
				}), 
				new Ext.create('App.cmp.Input', {
					label : 'Menu Name',
					nullData : false,
					items : [
						new Ext.create('App.cmp.TextField', {
							id : 'a2.input.menuName',
							submit	: 'a2.input.btnSave',
							width : 200,
							maxLength:32,
							emptyText: 'Menu Name',
							result : 'dynamic',
							name : 'menuName',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Menu Type',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a2.input.menuType',
							submit	: 'a2.input.btnSave',
							name : 'menuType',
							emptyText: 'Menu Type',
							allowBlank : false,
							listeners:{
								select : function(a, b) {
									if (Ext.getCmp('a2.input.menuType').getValue() == 'MENUTYPE_FOLDER') {
										Ext.getCmp('a2.input.menuCommand').setValue('-');
										Ext.getCmp('a2.input.menuCommand').disable();
									} else {
										Ext.getCmp('a2.input.menuCommand').setValue('');
										Ext.getCmp('a2.input.menuCommand').enable();
									}
								}
							}
						})
					]
				}), 
				new Ext.create('App.cmp.Input', {
					label : 'Menu Command',
					items : [
						new Ext.create('App.cmp.TextArea', {
							id : 'a2.input.menuCommand',
							width: 200,
							maxLength:128,
							emptyText: 'Menu Command',
							name : 'menuCommand'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'System',
					items : [
						new Ext.create('App.cmp.CheckBox', {
							id : 'a2.input.systemFlag',
							name : 'systemFlag'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Active',
					items : [
						new Ext.create('App.cmp.CheckBox', {
							id : 'a2.input.activeFlag',
							name : 'activeFlag',
							checked:true
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Window',
					items : [
						new Ext.create('App.cmp.CheckBox', {
							id : 'a2.input.windowFlag',
							name : 'windowFlag',
							checked:false
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Admin',
					items : [
						new Ext.create('App.cmp.CheckBox', {
							id : 'a2.input.adminFlag',
							name : 'adminFlag',
							checked:false
								
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('a2.input.panel').qGetForm() == false)
			Ext.getCmp('a2.confirm').confirm({
				msg : 'Whether You Will Ignore All Data ?',
				allow : 'a2.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
});