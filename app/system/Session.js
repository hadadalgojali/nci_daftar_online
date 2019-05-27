Ext.define('App.system.Session', {
	extend : 'App.cmp.Window',
	title : 'Login - Session Expired, Entry Your Password.',
	closable : false,
	id:'session',
	modal : true,
	iconCls: 'i-user',
	closeAction:'destroy',
	fbar: [{
		text: 'Login',
		id:'a8.input.btnSave',
		handler: function() {
			var tabArray=[];
			for ( var i in tabVar){
				tabArray.push(tabVar[i]);
			}
			var ses=session,
				param={
					menu:Ext.encode(ses.menu),
					tab:Ext.encode(tabArray),
					username:ses.userName,
					password:Ext.getCmp('session.f2').getValue()
				}
			Ext.getCmp('session').setLoading('Check Login');
			Ext.Ajax.request({
				url : url + 'admin/login',
				method : 'POST',
				params:param,
				success : function(response) {
					Ext.getCmp('session').setLoading(false);
					var r = ajaxSuccess(response);
					if (r.result == 'SUCCESS') {
						Ext.getCmp('session').close();
					}
				},
				failure : function(jqXHR, exception) {
					Ext.getCmp('session').setLoading(false);
					ajaxError(jqXHR, exception);
				}
			});
		}
	},{
		text: 'Other Login',
		handler: function() {
			Ext.getCmp('main.confirm').confirm({
				msg : 'Are you sure Other Login ?',
				onY : function() {
					location.reload();
				}
			});
		}
	}],
	initComponent:function(){
		var $this=this;
		$this.items=[
			new Ext.create('App.cmp.Panel',{
				bodyStyle : 'padding: 5px 10px',
				width: 350,
				items:[
					new Ext.create('App.cmp.Input',{
						label:'User',
						items:[
							new Ext.create('App.cmp.TextField',{
								name:'f1',
								width: 200,
								disabled:true,
								submit:'a8.input.btnSave',
								id:'session.f1',
								allowBlank: false
							})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Password',
						items:[
							new Ext.create('App.cmp.TextField',{
								emptyText:'Password',
								name:'f1',
								width: 200,
								inputType: 'password' ,
								submit:'a8.input.btnSave',
								id:'session.f2',
								allowBlank: false
							})
						]
					}),
				]
			})
		]
		$this.callParent();
	}
})