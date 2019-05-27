Ext.define('App.system.ChangePassword',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'profile.password',
	title:'Change Password',
	modal:true,
	closing : false,
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'profile.password.panel',
			width: 350,
			items:[
				new Ext.create('App.cmp.Input',{
					label:'New Password',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'f1',
							width: 200,
							id:'profile.password.f1',
							inputType: 'password' ,
							submit:'profile.password.btnSave',
							emptyText:'New Password',
							result:'dynamic',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'User Name',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'f2',
							id:'profile.password.f2',
							submit:'profile.password.btnSave',
							emptyText:'User Name',
							result:'lower',
							space:false,
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Old Password',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'f3',
							width: 200,
							id:'profile.password.f3',
							inputType: 'password' ,
							submit:'profile.password.btnSave',
							emptyText:'Old Password',
							allowBlank: false
						})
					]
				}),
			]
		})
	],
	fbar:[
		new Ext.Button({
			text:'Save',
			id:'profile.password.btnSave',
			iconCls:'i-save',
			handler:function(){
				var req=Ext.getCmp('profile.password.panel').qGetForm(true);
				if(req == false)
					Ext.getCmp('home.confirm').confirm({
						msg : 'Are you sure Save this Data ?',
						allow : 'profile.saveProfile',
						onY : function() {
							Ext.getCmp('profile.password').setLoading('Saving password ');
							var param = Ext.getCmp('profile.password.panel').qParams();
							Ext.Ajax.request({
								url : url + 'admin/savePassword',
								method : 'POST',
								params:param,
								success : function(response) {
									Ext.getCmp('profile.password').setLoading(false);
									var r = ajaxSuccess(response);
									if (r.result == 'SUCCESS') {
										session.password=Ext.getCmp('profile.password.f1').getValue();
										Ext.getCmp('profile.password').closeProfile();
										Ext.getCmp('profile.password').qClose();
									}
								},
								failure : function(jqXHR, exception) {
									Ext.getCmp('profile.password').setLoading(false);
									ajaxError(jqXHR, exception);
								}
							});
						}
					});
			}
		}),
      {
			text: 'Close',
			iconCls:'i-close',
			handler: function(a,b) {
				Ext.getCmp('profile.password').close();
				Ext.getCmp('profile.password').closeProfile();
			}
      }
    ],
    closeProfile:function(){
    	Ext.getCmp('profile').show();
	},
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('profile.password.panel').qGetForm() == false)
			Ext.getCmp('home.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'home.closePassword',
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