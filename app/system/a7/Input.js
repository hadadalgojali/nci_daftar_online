Ext.define('App.system.a7.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'a7.input',
	title:'User',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'a7.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('a7.input.panel').qGetForm(true);
			if(req == false){
				var err=false;
				var mes='';
				if(Ext.getCmp('a7.input.pageType').getValue()=='ADD' || Ext.getCmp('a7.input.pageType').getValue()=='CHANGE')
					if(Ext.getCmp('a7.input.password').getValue() !=Ext.getCmp('a7.input.retryPassword').getValue()){
						err=true;
						Ext.getCmp('a7.input.password').setValue('');
						Ext.getCmp('a7.input.retryPassword').setValue('');
						Ext.getCmp('a7.input.password').focus();
						mes='Your Password NoT Same.';
					}
				if(err==false)
					Ext.getCmp('a7.confirm').confirm({
						msg : 'Are you sure Save this Data ?',
						allow : 'a7.save',
						onY : function() {
							Ext.getCmp('a7.input').setLoading('Saving');
							var param = Ext.getCmp('a7.input.panel').qParams();
							Ext.Ajax.request({
								url : url + 'app/a7/save',
								method : 'POST',
								params:param,
								success : function(response) {
									Ext.getCmp('a7.input').setLoading(false);
									var r = ajaxSuccess(response);
									if (r.result == 'SUCCESS') {
										Ext.getCmp('a7.input').qClose();
										Ext.getCmp('a7.list').refresh();
									}
								},
								failure : function(jqXHR, exception) {
									Ext.getCmp('a7.input').setLoading(false);
									ajaxError(jqXHR, exception);
								}
							});
						}
					});
				else
					Ext.create('App.cmp.Toast').toast({msg : mes,type : 'warning'});
			}else if(req==true)
				Ext.getCmp('a7.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('a7.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'a7.input.panel',
			width: 350,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'pageType',
					id:'a7.input.pageType'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'pid',
					id:'a7.input.pid'
				}),
				new Ext.create('App.cmp.Input',{
					label:'Tenant',
					hiddem:true,
					id:'a7.label.tenant',
					items:[
						new Ext.create('App.cmp.DropDown', {
							id : 'a7.input.tenant',
							name : 'tenant',
							submit:'a7.input.btnSave',
							emptyText:'Tenant',
							listeners:{
								select:function(a){
									Ext.getCmp('a7.input').setLoading('Loading');
									Ext.Ajax.request({
										url : url + 'app/a7/initTenant',
										method : 'GET',
										params:{pid:a.getValue()},
										success : function(response) {
											Ext.getCmp('a7.input').setLoading(false);
											var r = ajaxSuccess(response);
											if (r.result == 'SUCCESS') {
												Ext.getCmp('a7.input.role').addReset(r.data.roleList);
												Ext.getCmp('a7.input.employee').setValue('');
											}
										},
										failure : function(jqXHR, exception) {
											Ext.getCmp('a7.input').setLoading(false);
											ajaxError(jqXHR, exception);
										}
									});
								}
							}
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'User Name',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'userCode',
							id:'a7.input.userCode',
							submit:'a7.input.btnSave',
							emptyText:'User Name',
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
							name:'password',
							width: 200,
							id:'a7.input.password',
							inputType: 'password' ,
							submit:'a7.input.btnSave',
							emptyText:'Password',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Retry Password',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'retryPassword',
							submit:'a7.input.btnSave',
							width: 200,
							id:'a7.input.retryPassword',
							inputType: 'password' ,
							emptyText:'Retry Password',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Role',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'a7.input.role',
							name : 'role',
							width: 200,
							emptyText:'Role',
							submit:'a7.input.btnSave',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Employee',
					nullData : false,
					items : [
						new Ext.create('App.cmp.AutoComplete',{
							name:'employee',
							submit:'a7.input.btnSave',
							width: 200,
							params:function(){
								if(session.tenant==null)
									return {tenant:Ext.getCmp('a7.input.tenant').getValue()};
								else
									return {tenant:session.tenant};
							},
							id:'a7.input.employee',
							emptyText:'Employee',
							url:url+'app/a7/getEmployeeList',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Active',
					items:[
						new Ext.create('App.cmp.CheckBox',{
							name:'activeFlag',
							checked:true,
							id:'a7.input.activeFlag'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('a7.input.panel').qGetForm() == false)
			Ext.getCmp('a7.confirm').confirm({
				msg : 'Whether You Will Ignore All Data ?',
				allow : 'a7.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})