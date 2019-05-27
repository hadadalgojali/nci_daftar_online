Ext.define('App.system.Profile',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'profile',
	title:'Employee',
	modal:true,
	closing : false,
	tbar:[
	    new Ext.Button({
	    	text:'Edit Profile',
	    	id:'profile.btnEdit',
	    	iconCls:'i-edit',
	    	handler:function(){
	    		Ext.getCmp('profile.btnEdit').disable();
	    		Ext.getCmp('profile.btnSave').enable();
	    		Ext.getCmp('profile.btnChangeUsername').disable();
	    		Ext.getCmp('profile.btnPassword').disable();
	    		Ext.getCmp('profile.firstName').setReadOnly(false);
	    		Ext.getCmp('profile.secondName').setReadOnly(false);
	    		Ext.getCmp('profile.lastName').setReadOnly(false);
	    		Ext.getCmp('profile.gender').setReadOnly(false);
	    		Ext.getCmp('profile.religion').setReadOnly(false);
	    		Ext.getCmp('profile.birthPlace').setReadOnly(false);
	    		Ext.getCmp('profile.birthDate').setReadOnly(false);
	    		Ext.getCmp('profile.address').setReadOnly(false);
	    		Ext.getCmp('profile.email').setReadOnly(false);
	    		Ext.getCmp('profile.phone1').setReadOnly(false);
	    		Ext.getCmp('profile.phone2').setReadOnly(false);
	    		Ext.getCmp('profile.fax1').setReadOnly(false);
	    		Ext.getCmp('profile.fax2').setReadOnly(false);
	    		Ext.getCmp('profile.foto').input=true;
	    		Ext.getCmp('profile.firstName').focus();
	    	}
	    }),'-',
	    new Ext.Button({
	    	text:'Save',
	    	id:'profile.btnSave',
	    	iconCls:'i-save',
	    	disabled:true,
	    	handler:function(){
	    		var req=Ext.getCmp('profile.panel').qGetForm(true);
				if(req == false)
					Ext.getCmp('home.confirm').confirm({
						msg : 'Are you sure Save this Data ?',
						allow : 'profile.saveProfile',
						onY : function() {
							Ext.getCmp('profile').setLoading('Saving Profile ');
							var param = Ext.getCmp('profile.panel').qParams();
							Ext.Ajax.request({
								url : url + 'admin/saveProfile',
								method : 'POST',
								params:param,
								success : function(response) {
									Ext.getCmp('profile').setLoading(false);
									var r = ajaxSuccess(response);
									if (r.result == 'SUCCESS') {
										Ext.getCmp('main.tab.home').updateUser();
										Ext.getCmp('profile').closeProfile();
										Ext.getCmp('profile.panel').qSetForm();
									}
								},
								failure : function(jqXHR, exception) {
									Ext.getCmp('profile').setLoading(false);
									ajaxError(jqXHR, exception);
								}
							});
						}
					});
				else if(req==true){
					Ext.getCmp('profile').closeProfile();
				}
	    	}
	    }),'-',
	    new Ext.Button({
	    	text:'Change Username',
	    	id:'profile.btnChangeUsername',
	    	iconCls:'i-edit',
	    	handler:function(){
	    		Ext.getCmp('profile').hide();
	    		Ext.getCmp('profile.username.panel').qReset();
	    		Ext.getCmp('profile.username').closing = false;
	    		Ext.getCmp('profile.username').show();
				Ext.getCmp('profile.username.panel').qSetForm();
	    		Ext.getCmp('profile.username.f1').focus();
	    	}
	    }),'-',
	    new Ext.Button({
	    	text:'Change Password',
	    	id:'profile.btnPassword',
	    	iconCls:'i-edit',
	    	handler:function(){
	    		Ext.getCmp('profile').hide();
	    		Ext.getCmp('profile.password.panel').qReset();
	    		Ext.getCmp('profile.password').closing = false;
	    		Ext.getCmp('profile.password').show();
				Ext.getCmp('profile.password.panel').qSetForm();
	    		Ext.getCmp('profile.password.f1').focus();
	    	}
	    }),'-'
	],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'profile.panel',
			width: 680,
			items:[
				new Ext.create('App.cmp.Panel',{
					bodyStyle : 'padding: 5px 10px',
					layout:'column',
					width: 660,
					items:[
						new Ext.create('App.cmp.Panel',{
							width: 320,
							items:[
								new Ext.create('App.cmp.HiddenField',{
									name:'i',
									id:'profile.pid'
								}),
								new Ext.create('App.cmp.Input',{
									label:'ID Number',
									nullData : false,
									items:[
										new Ext.create('App.cmp.TextField',{
											maxLength:32,
											emptyText:'ID Card',
											name:'f1',
											submit:'profile.btnSave',
											id:'profile.number',
											readOnly:true,
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
											name:'f2',
											emptyText:'First Name',
											width: 200,
											readOnly:true,
											submit:'profile.btnSave',
											id:'profile.firstName',
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
											name:'f3',
											emptyText:'Second Name',
											width: 200,
											readOnly:true,
											submit:'profile.btnSave',
											id:'profile.secondName',
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
											name:'f4',
											emptyText:'Last Name',
											width: 200,
											readOnly:true,
											submit:'profile.btnSave',
											id:'profile.lastName',
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
											id : 'profile.gender',
											emptyText:'Gender',
											name : 'f5',
											readOnly:true,
											submit:'profile.btnSave',
											allowBlank : false
										})
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label : 'Religion',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DropDown', {
											id : 'profile.religion',
											emptyText:'Religion',
											readOnly:true,
											name : 'f6',
											submit:'profile.btnSave',
											allowBlank : false
										})
									]
								}), 
								new Ext.create('App.cmp.Input', {
									label:'Birth Place',
									nullData : false,
									items : [
										new Ext.create('App.cmp.DynamicOption',{
											name:'f7',
											width: 200,
											readOnly:true,
											type:'DYNAMIC_CITY',
											submit:'profile.btnSave',
											id:'profile.birthPlace',
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
											name:'f8',
											readOnly:true,
											emptyText:'Birth Date',
											submit:'profile.btnSave',
											width: 100,
											id:'profile.birthDate',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Address',
									items:[
										new Ext.create('App.cmp.TextArea',{
											name:'f9',
											emptyText:'Address',
											width: 200,
											readOnly:true,
											maxLength:256,
											id:'profile.address'
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
											name:'f10',
											maxLength:64,
											readOnly:true,
											emptyText:'Email Address',
											width: 200,
											submit:'profile.btnSave',
											id:'profile.email',
											allowBlank: false
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Phone Number 1',
									items:[
										new Ext.create('App.cmp.TextField',{
											name:'f11',
											maxLength:16,
											readOnly:true,
											emptyText:'Phone Number 1',
											width: 200,
											submit:'profile.btnSave',
											id:'profile.phone1'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Phone Number 2',
									items:[
										new Ext.create('App.cmp.TextField',{
											name:'f12',
											emptyText:'Phone Number 2',
											width: 200,
											maxLength:16,
											readOnly:true,
											submit:'profile.btnSave',
											id:'profile.phone2'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Fax Number 1',
									items:[
										new Ext.create('App.cmp.TextField',{
											name:'f13',
											emptyText:'Fax Number 1',
											width: 200,
											readOnly:true,
											maxLength:16,
											submit:'profile.btnSave',
											id:'profile.fax1'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Fax Number 2',
									items:[
										new Ext.create('App.cmp.TextField',{
											name:'f14',
											emptyText:'Fax Number 2',
											width: 200,
											readOnly:true,
											maxLength:16,
											submit:'profile.btnSave',
											id:'profile.fax2'
										})
									]
								}),
								new Ext.create('App.cmp.Input',{
									label:'Foto',
									items:[
										new Ext.create('App.cmp.FotoUpload',{
											name: 'f15',
											id:'profile.foto',
											input:false
										})
									]
								})
							]
						})
					]
				})
			]
		})
	],
	fbar:[
      {
			text: 'Close',
			iconCls:'i-close',
			handler: function(a,b) {
				Ext.getCmp('profile').close();
			}
      }
    ],
    closeProfile:function(){
		Ext.getCmp('profile.btnEdit').enable();
		Ext.getCmp('profile.btnSave').disable();
		Ext.getCmp('profile.btnChangeUsername').enable();
		Ext.getCmp('profile.btnPassword').enable();
		Ext.getCmp('profile.firstName').setReadOnly(true);
		Ext.getCmp('profile.secondName').setReadOnly(true);
		Ext.getCmp('profile.lastName').setReadOnly(true);
		Ext.getCmp('profile.gender').setReadOnly(true);
		Ext.getCmp('profile.religion').setReadOnly(true);
		Ext.getCmp('profile.birthPlace').setReadOnly(true);
		Ext.getCmp('profile.birthDate').setReadOnly(true);
		Ext.getCmp('profile.address').setReadOnly(true);
		Ext.getCmp('profile.email').setReadOnly(true);
		Ext.getCmp('profile.phone1').setReadOnly(true);
		Ext.getCmp('profile.phone2').setReadOnly(true);
		Ext.getCmp('profile.fax1').setReadOnly(true);
		Ext.getCmp('profile.foto').input=false;
		Ext.getCmp('profile.fax2').setReadOnly(true);
    },
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('profile.panel').qGetForm() == false)
			Ext.getCmp('home.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'home.closeProfile',
				onY : function() {
					$this.qClose();
					$this.closeProfile();
				}
			});
		else{
			$this.qClose();
			$this.closeProfile();
		}
		return false;
	}
})