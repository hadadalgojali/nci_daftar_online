Ext.define('App.system.Chat',{
	extend : 'App.cmp.Window',
	iconCls:'i-chat',
	id:'chat',
	title:'Message',
	modal:false,
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'chat.panel',
			width: 350,
			items:[
				new Ext.create('App.cmp.Input',{
					label:'New User Name',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'f1',
							id:'chat.f1',
							submit:'chat.btnSave',
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
							id:'chat.f2',
							submit:'chat.btnSave',
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
							id:'chat.f3',
							inputType: 'password' ,
							submit:'chat.btnSave',
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
			id:'chat.btnSave',
			iconCls:'i-save',
			handler:function(){
				var req=Ext.getCmp('chat.panel').qGetForm(true);
				if(req == false)
					Ext.getCmp('home.confirm').confirm({
						msg : 'Are you sure Save this Data ?',
						allow : 'profile.saveProfile',
						onY : function() {
							Ext.getCmp('chat').setLoading('Saving Username ');
							var param = Ext.getCmp('chat.panel').qParams();
							Ext.Ajax.request({
								url : url + 'admin/saveUsername',
								method : 'POST',
								params:param,
								success : function(response) {
									Ext.getCmp('chat').setLoading(false);
									var r = ajaxSuccess(response);
									if (r.result == 'SUCCESS') {
										session.userName=Ext.getCmp('chat.f1').getValue();
										Ext.getCmp('chat').closeProfile();
										Ext.getCmp('chat').qClose();
									}
								},
								failure : function(jqXHR, exception) {
									Ext.getCmp('chat').setLoading(false);
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
				Ext.getCmp('chat').close();
				Ext.getCmp('chat').closeProfile();
			}
      }
    ],
    closeProfile:function(){
    	Ext.getCmp('profile').show();
	},
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('chat.panel').qGetForm() == false)
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