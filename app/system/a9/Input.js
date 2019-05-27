Ext.define('App.system.a9.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'a9.input',
	modal : true,
	closing : false,
	maximized: true,
	fbar: [{
		text: 'Save',
		id:'a9.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('a9.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('a9.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'a9.save',
					onY : function() {
						Ext.getCmp('a9.input').setLoading('Saving');
						var param = Ext.getCmp('a9.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/a9/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('a9.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a9.input').qClose();
									Ext.getCmp('a9.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a9.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('a9.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('a9.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'a9.input.panel',
			layout:{
				type:'vbox',
				align:'stretch'
			},
			items:[
				new Ext.create('App.cmp.Panel',{
					bodyStyle : 'padding: 5px 10px',
					title:'General Data',
					layout:{
						type:'hbox',
						align:'stretch'
					},
					items:[
						new Ext.create('App.cmp.Panel',{
							items:[
								new Ext.create('App.cmp.HiddenField',{
									name:'p',
									id:'a9.input.p'
								}),
								new Ext.create('App.cmp.HiddenField',{
									name:'i',
									id:'a9.input.i'
								}),
								new Ext.create('App.cmp.Input',{
									label:'Tenant',
									id:'a9.label.t',
									hidden:true,
									items:[
										new Ext.create('App.cmp.DropDown', {
											id : 'a9.input.t',
											name : 't',
											submit:'a9.input.btnSave',
											width: 150,
											emptyText:'Tenant'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Template Code',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:16,
											emptyText:'Template Code',
											name:'f1',
											submit:'a9.input.btnSave',
											id:'a9.input.f1',
											result:'upper',
											space:false,
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Template Name',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:64,
											name:'f2',
											emptyText:'Template Name',
											width: 200,
											submit:'a9.input.btnSave',
											id:'a9.input.f2',
											result:'dynamic',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Page Type',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 'a9.input.f3',
											emptyText:'Page Type',
											name : 'f3',
											submit:'a9.input.btnSave',
											allowBlank : false,
											listeners:{
												select:function(a){
													if(a.getValue()=='PDF_CUSTOM'){
														Ext.getCmp('a9.input.f5').enable();
														Ext.getCmp('a9.input.f6').enable();
													}else{
														Ext.getCmp('a9.input.f5').disable();
														Ext.getCmp('a9.input.f6').disable();
													}
												}
											}
										})
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label : 'Direction Type',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 'a9.input.f4',
											emptyText:'Direction Type',
											name : 'f4',
											submit:'a9.input.btnSave',
											allowBlank : false
										})
									]
								})
							]
						}),
						new Ext.create('App.cmp.Panel',{
							style:'padding-left: 10px;',
							items:[
								new Ext.create('App.cmp.Input',{
									label:'Width / Height',
									nullData : false,
									items:[
										new Ext.create('App.cmp.NumberField',{
											name:'f5',
											emptyText:'Width',
											width: 70,
											submit:'a9.input.btnSave',
											id:'a9.input.f5',
											disabled:true,
											allowBlank: false
										}),new Ext.form.DisplayField({
											value:'&nbsp;/&nbsp;'
										}),
										new Ext.create('App.cmp.NumberField',{
											name:'f6',
											emptyText:'Height',
											width: 70,
											disabled:true,
											submit:'a9.input.btnSave',
											id:'a9.input.f6',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'T / R / B / L',
									nullData : false,
									items:[
										new Ext.create('App.cmp.NumberField',{
											name:'f7',
											emptyText:'Top',
											width: 70,
											submit:'a9.input.btnSave',
											id:'a9.input.f7',
											allowBlank: false,
											value:30
										}),new Ext.form.DisplayField({
											value:'&nbsp;/&nbsp;'
										}),
										new Ext.create('App.cmp.NumberField',{
											name:'f8',
											emptyText:'Right',
											width: 70,
											submit:'a9.input.btnSave',
											id:'a9.input.f8',
											allowBlank: false,
											value:30
										}),new Ext.form.DisplayField({
											value:'&nbsp;/&nbsp;'
										}),
										new Ext.create('App.cmp.NumberField',{
											name:'f9',
											emptyText:'Bottom',
											width: 70,
											submit:'a9.input.btnSave',
											id:'a9.input.f9',
											value:30,
											allowBlank: false
										}),new Ext.form.DisplayField({
											value:'&nbsp;/&nbsp;'
										}),
										new Ext.create('App.cmp.NumberField',{
											name:'f10',
											emptyText:'Left',
											width: 70,
											value:30,
											submit:'a9.input.btnSave',
											id:'a9.input.f10',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Active',
									items:[
										new Ext.create('App.cmp.CheckBox',{
											name:'f11',
											checked:true,
											id:'a9.input.f11'
										})
									]
								})
							]
						})
					]
				}),
				new Ext.create('App.cmp.Panel',{
					flex:1,
					layout: 'fit',
					title:'HTML Template',
					items:[
						new Ext.create('App.cmp.HtmlEditor',{
							name:'f12',
							emptyText:'Left',
							id:'a9.input.f12'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('a9.input.panel').qGetForm() == false)
			Ext.getCmp('a9.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'a9.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})