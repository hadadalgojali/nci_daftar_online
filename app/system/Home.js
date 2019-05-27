Ext.define('App.system.Home', {
	extend : 'App.cmp.Panel',
	title : '',
	id:'main.tab.home',
	iconCls : 'i-home',
	initComponent:function(){
		var $this=this;
		var image=new Ext.create('App.cmp.Panel',{
			html:'<img style="width: 150px;height: 170px;border: 1px solid #99bce8;cursor:pointer;" src="'+url+'upload/NO.GIF"></img>',
			style:'padding: 10px;'
		})
		var name=new Ext.create('App.cmp.Panel',{
			html:'<b>None</b>',
			width: 500
		})
		$this.items=[
            new Ext.create('App.cmp.Confirm', {id : 'home.confirm'}),
//            new Ext.create('App.cmp.Panel',{
//            	title:'Obrolan',
//            	style:'position:fixed; bottom: 0px !important; right: 0px !important;',
//            	width: 150,
//            }),
		    new Ext.create('App.system.Profile'),
		    new Ext.create('App.system.ChangeUsername'),
		    new Ext.create('App.system.ChangePassword'),
			new Ext.create('App.cmp.Panel',{
				tbar:[
					Ext.create('Ext.panel.Panel', {
					    flex: 1,
					    border:false,
					    tbar: [{
					        xtype: 'buttongroup',
					        columns: 3,
					        title: 'User Menu',
					        items: [
					        	{
						            text: 'Profile',
						            scale: 'large',
						            iconCls: 'i-profile-large',
						            id:'home.btnProfile',
						            iconAlign: 'top',
						            handler : function(a) {
						            	Ext.getCmp('main.tab.home').setLoading('Getting Profile');
										Ext.Ajax.request({
											url : url + 'admin/getProfile',
											params:{i:session.i},
											method : 'GET',
											success : function(response) {
												Ext.getCmp('main.tab.home').setLoading(false);
												var r = ajaxSuccess(response);
												if (r.result == 'SUCCESS') {
													var o=r.data.o;
													if(o.f15 != undefined)
														Ext.getCmp('profile.foto').setFoto(o.f15);
													else
														Ext.getCmp('profile.foto').setNull();
													Ext.getCmp('profile.number').disable();
													Ext.getCmp('profile.gender').addReset(r.data.l);
													Ext.getCmp('profile.religion').addReset(r.data.l1);
													Ext.getCmp('profile.panel').qReset();
													Ext.getCmp('profile.number').setValue(o.f1);
													Ext.getCmp('profile.firstName').setValue(o.f2);
													Ext.getCmp('profile.secondName').setValue(o.f3);
													Ext.getCmp('profile.lastName').setValue(o.f4);
													Ext.getCmp('profile.gender').setValue(o.f5);
													Ext.getCmp('profile.religion').setValue(o.f6);
													Ext.getCmp('profile.birthPlace').setValue(o.f7);
													Ext.getCmp('profile.birthDate').setValue(o.f8);
													Ext.getCmp('profile.address').setValue(o.f9);
													Ext.getCmp('profile.email').setValue(o.f10);
													Ext.getCmp('profile.phone1').setValue(o.f11);
													Ext.getCmp('profile.phone2').setValue(o.f12);
													Ext.getCmp('profile.fax1').setValue(o.f13);
													Ext.getCmp('profile.fax2').setValue(o.f14);
													Ext.getCmp('profile.pid').setValue(session.i);
													Ext.getCmp('profile').closing = false;
													Ext.getCmp('profile').show();
													Ext.getCmp('profile.panel').qSetForm();
												}
											},
											failure : function(jqXHR, exception) {
												Ext.getCmp('main.tab.home').setLoading(false);
												ajaxError(jqXHR, exception);
											}
										});
									}
						        },{
						            text: 'Logout',
						            scale: 'large',
						            iconCls: 'i-logout-large',
						            iconAlign: 'top',
						            handler : function(a) {
						            	Ext.getCmp('main.confirm').confirm({
											msg : 'Are you sure logout ?',
											onY : function() {
												Ext.getBody().mask('Logout');
												Ext.Ajax.request({
													url : url + 'admin/logout',
													method : 'GET',
													success : function(response) {
														var r = ajaxSuccess(response);
														if (r.result == 'SUCCESS')
															location.reload();
														else
															Ext.getBody().unmask();
													},
													failure : function(jqXHR, exception) {
														Ext.getBody().unmask();
														ajaxError(jqXHR, exception);
													}
												});
											}
										});
									}
						        }
					        ]
					    }]
					}) 
				]
			}),
			new Ext.create('App.cmp.Panel',{
				title:'User Login',
				items:[
					{
						layout:'column',
						border:false,
						items:[
							image,
							name
						]
					}
				]
			})
		],
		this.updateUser=function(){
			Ext.Ajax.request({
				url : url + 'admin/getUser',
				method : 'GET',
				success : function(response) {
					var r = ajaxSuccess(response);
					if (r.result == 'SUCCESS') {
						image.update('<img style="width: 150px;height: 170px;border: 1px solid #99bce8;" src="'+url+'upload/'+r.data.foto+'"></img>');
						name.update('<div style="color:#99BCE8;"><h1>'+r.data.name+'</h1></div>');
					}
				},
				failure : function(jqXHR, exception) {
					ajaxError(jqXHR, exception);
				}
			});
		}
		this.callParent(arguments);
		this.updateUser();
	}
})