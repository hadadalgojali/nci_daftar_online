Ext.define('App.system.a5.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'a5.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'a5.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('a5.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('a5.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'a5.save',
					onY : function() {
						Ext.getCmp('a5.input').setLoading('Saving');
						var param = Ext.getCmp('a5.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/a5/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('a5.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a5.input').qClose();
									Ext.getCmp('a5.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a5.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('a5.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('a5.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'a5.input.panel',
			width: 680,
			items:[
				new Ext.create('App.cmp.Panel',{
					bodyStyle : 'padding: 5px 10px',
					layout:'column',
					width: 660,
					title:'General Data',
					items:[
						new Ext.create('App.cmp.Panel',{
							width: 320,
							items:[
								new Ext.create('App.cmp.HiddenField',{
									name:'pageType',
									id:'a5.input.pageType'
								}),
								new Ext.create('App.cmp.HiddenField',{
									name:'pid',
									id:'a5.input.pid'
								}),
								new Ext.create('App.cmp.Input',{
									label:'Tenant',
									id:'a5.label.tenant',
									hidden:true,
									items:[
										new Ext.create('App.cmp.DropDown', {
											id : 'a5.input.tenant',
											name : 'tenant',
											submit:'a5.input.btnSave',
											width: 150,
											emptyText:'Tenant',
											listeners:{
												select:function(a){
													Ext.getCmp('a5.input').setLoading('Loading');
													Ext.Ajax.request({
														url : url + 'app/a5/initTenant',
														method : 'GET',
														params:{pid:a.getValue()},
														success : function(response) {
															Ext.getCmp('a5.input').setLoading(false);
															var r = ajaxSuccess(response);
															if (r.result == 'SUCCESS') {
																Ext.getCmp('a5.input.job').addReset(r.data.jobList);
															}
														},
														failure : function(jqXHR, exception) {
															Ext.getCmp('a5.input').setLoading(false);
															ajaxError(jqXHR, exception);
														}
													});
												}
											}
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'ID Number',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:32,
											emptyText:'ID Card',
											name:'number',
											submit:'a5.input.btnSave',
											id:'a5.input.number',
											result:'upper',
											space:false,
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'First Name',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:32,
											name:'firstName',
											emptyText:'First Name',
											width: 200,
											submit:'a5.input.btnSave',
											id:'a5.input.firstName',
											result:'dynamic',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Second Name',
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:32,
											name:'secondName',
											emptyText:'Second Name',
											width: 200,
											submit:'a5.input.btnSave',
											id:'a5.input.secondName',
											result:'dynamic',
											allowBlank: true
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Last Name',
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:32,
											name:'lastName',
											emptyText:'Last Name',
											width: 200,
											submit:'a5.input.btnSave',
											id:'a5.input.lastName',
											result:'dynamic',
											allowBlank: true
										})
									]
								}),
								new Ext.create('App.cmp.Input', {
									label : 'Gender',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 'a5.input.gender',
											emptyText:'Gender',
											name : 'gender',
											submit:'a5.input.btnSave',
											allowBlank : false
										})
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label : 'Religion',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 'a5.input.religion',
											emptyText:'Religion',
											name : 'religion',
											submit:'a5.input.btnSave',
											allowBlank : false
										})
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label:'Birth Place',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DynamicOption',{
											name:'birthPlace',
											width: 200,
											type:'DYNAMIC_CITY',
											submit:'a5.input.btnSave',
											id:'a5.input.birthPlace',
											emptyText:'Birth Place',
											allowBlank : false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Birth Date',
									nullData : false,
									items:[
										new Ext.create('App.cmp.DateField',{
											name:'birthDate',
											emptyText:'Birth Date',
											submit:'a5.input.btnSave',
											width: 100,
											id:'a5.input.birthDate',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Address',
									items:[
										new Ext.create('App.cmp.TextArea',{
											name:'address',
											emptyText:'Address',
											width: 200,
											maxLength:256,
											id:'a5.input.address'
										})
									]
								})
							]
						}),
						new Ext.create('App.cmp.Panel',{
							width: 320,
							items:[
								new Ext.create('App.cmp.Input',{
									label:'Email Address',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											name:'email',
											maxLength:64,
											emptyText:'Email Address',
											width: 200,
											submit:'a5.input.btnSave',
											id:'a5.input.email',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Phone Number 1',
									items:[
										new Ext.create('App.cmp.TextField',{
											name:'phone1',
											maxLength:16,
											emptyText:'Phone Number 1',
											width: 200,
											submit:'a5.input.btnSave',
											id:'a5.input.phone1'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Phone Number 2',
									items:[
										new Ext.create('App.cmp.TextField',{
											name:'phone2',
											emptyText:'Phone Number 2',
											width: 200,
											maxLength:16,
											submit:'a5.input.btnSave',
											id:'a5.input.phone2'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Fax Number 1',
									items:[
										new Ext.create('App.cmp.TextField',{
											name:'fax1',
											emptyText:'Fax Number 1',
											width: 200,
											maxLength:16,
											submit:'a5.input.btnSave',
											id:'a5.input.fax1'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Fax Number 2',
									items:[
										new Ext.create('App.cmp.TextField',{
											name:'fax2',
											emptyText:'Fax Number 2',
											width: 200,
											maxLength:16,
											submit:'a5.input.btnSave',
											id:'a5.input.fax2'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Foto',
									items:[
										new Ext.create('App.cmp.FotoUpload',{
											name: 'foto',
											id:'a5.input.foto'
										})
									]
								})
							]
						})
					]
				}),
				new Ext.create('App.cmp.Panel',{
					bodyStyle : 'padding: 5px 10px',
					title:'Other',
					width: 320,
					items:[
						new Ext.create('App.cmp.Input', {
							label : 'Job',
							items : [
								new Ext.create('App.cmp.DropDown', {
									id : 'a5.input.job',
									emptyText:'Job',
									submit:'a5.input.btnSave',
									name : 'job'
								})
							]
						}),
						new Ext.create('App.cmp.Input',{
							label:'Active',
							items:[
								new Ext.create('App.cmp.CheckBox',{
									name:'activeFlag',
									checked:true,
									id:'a5.input.activeFlag'
								})
							]
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('a5.input.panel').qGetForm() == false)
			Ext.getCmp('a5.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'a5.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})