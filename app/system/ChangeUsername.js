Ext.define('App.system.ChangeUsername',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'profile.username',
	title:'Change Username',
	modal:true,
	closing : false,
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'profile.username.panel',
			width: 350,
			items:[
				new Ext.create('App.cmp.Input',{
					label:'New User Name',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'f1',
							id:'profile.username.f1',
							submit:'profile.username.btnSave',
							emptyText:'New User Name',
							result:'lower',
							space:false,
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Old User Name',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'f2',
							id:'profile.username.f2',
							submit:'profile.username.btnSave',
							emptyText:'Old User Name',
							result:'lower',
							space:false,
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Password',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'f3',
							width: 200,
							id:'profile.username.f3',
							inputType: 'password' ,
							submit:'profile.username.btnSave',
							emptyText:'Password',
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
			id:'profile.username.btnSave',
			iconCls:'i-save',
			handler:function(){
				var req=Ext.getCmp('profile.username.panel').qGetForm(true);
				if(req == false)
					Ext.getCmp('home.confirm').confirm({
						msg : 'Are you sure Save this Data ?',
						allow : 'profile.saveProfile',
						onY : function() {
							Ext.getCmp('profile.username').setLoading('Saving Username ');
							var param = Ext.getCmp('profile.username.panel').qParams();
							Ext.Ajax.request({
								url : url + 'admin/saveUsername',
								method : 'POST',
								params:param,
								success : function(response) {
									Ext.getCmp('profile.username').setLoading(false);
									var r = ajaxSuccess(response);
									if (r.result == 'SUCCESS') {
										session.userName=Ext.getCmp('profile.username.f1').getValue();
										Ext.getCmp('profile.username').closeProfile();
										Ext.getCmp('profile.username').qClose();
									}
								},
								failure : function(jqXHR, exception) {
									Ext.getCmp('profile.username').setLoading(false);
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
				Ext.getCmp('profile.username').close();
				Ext.getCmp('profile.username').closeProfile();
			}
      }
    ],
    closeProfile:function(){
    	Ext.getCmp('profile').show();
	},
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('profile.username.panel').qGetForm() == false)
			Ext.getCmp('home.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'home.closeUsername',
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