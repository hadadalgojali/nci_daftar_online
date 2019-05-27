Ext.define('App.system.a4.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'a4.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'a4.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('a4.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('a4.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'a4.save',
					onY : function() {
						Ext.getCmp('a4.input').setLoading('Saving');
						var param = Ext.getCmp('a4.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/a4/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('a4.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a4.input').qClose();
									Ext.getCmp('a4.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a4.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req ==true)
				Ext.getCmp('a4.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('a4.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'a4.input.panel',
			width: 550,
			items:[
				new Ext.create('App.cmp.Panel',{
					width: 320,
					bodyStyle : 'padding: 5px 10px',
					title:'General',
					items:[
						new Ext.create('App.cmp.HiddenField',{
							name:'p',
							id:'a4.input.pageType'
						}),
						new Ext.create('App.cmp.Input',{
							label:'Parameter Code',
							space:false,
							nullData : false,
							items:[
								new Ext.create('App.cmp.TextField',{
									maxLength:16,
									name:'f1',
									submit:'a4.input.btnSave',
									emptyText:'Parameter Code',
									id:'a4.input.parameterCode',
									result:'upper',
									space:false,
									allowBlank: false
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Parameter Name',
							nullData : false,
							items:[
								new Ext.create('App.cmp.TextField',{
									maxLength:32,
									width: 200,
									submit:'a4.input.btnSave',
									name:'f2',
									emptyText:'Parameter Name',
									id:'a4.input.parameterName',
									result:'dynamic',
									allowBlank: false
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Description',
							items:[
								new Ext.create('App.cmp.TextArea',{
									name:'f3',
									emptyText:'Description',
									width: 200,
									id:'a4.input.description',
									maxLength:128
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Active',
							items:[
								new Ext.create('App.cmp.CheckBox',{
									name:'f4',
									checked:true,
									id:'a4.input.activeFlag'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'System',
							items:[
								new Ext.create('App.cmp.CheckBox',{
									name:'f8',
									checked:false,
									id:'a4.input.systemFlag'
								})
							]
						})
					]
				}),
				new Ext.create('App.cmp.TableEditor', {
					id:'a4.input.tableOption',
					title:'Option',
					minHeight: 200,
					columns: [
						{text: 'Option Code',width: 150,  name: 'f5',primary:true,allowBlank: false, editor: new Ext.create('App.cmp.TextField',{
							maxLength:16,
							result:'upper',
							space:false,
							allowBlank: false
						})},
						{text: 'Option Name', width: 200,name: 'f6',allowBlank: false,editor:  new Ext.create('App.cmp.TextField',{
							maxLength:64,
							result:'dynamic',
							allowBlank: false
						})},
						{text: 'Active', width: 50, name: 'f7',xtype:'checkcolumn',value:true,editor: {xtype:'checkbox'}},
						{text: 'System', width: 50, name: 'f9',xtype:'checkcolumn',editor: {xtype:'checkbox'}}
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('a4.input.panel').qGetForm() == false)
			Ext.getCmp('a4.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'a4.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})