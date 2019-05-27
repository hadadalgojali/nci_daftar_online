Ext.define('App.content.fs2.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'fs2.input',
	modal : true,
	fbar: [{
		text: 'Save',
		id:'fs2.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('fs2.input.panel').qGetForm(true);
			if(req == false){
				var err=false;
				var mes='';
				if(Ext.getCmp('fs2.input.p').getValue()=='ADD' || Ext.getCmp('fs2.input.p').getValue()=='CHANGE')
					if(Ext.getCmp('fs2.input.f5').getValue() !=Ext.getCmp('fs2.input.f6').getValue()){
						err=true;
						Ext.getCmp('fs2.input.f5').setValue('');
						Ext.getCmp('fs2.input.f6').setValue('');
						Ext.getCmp('fs2.input.f5').focus();
						mes='Your Password NoT Same.';
					}
				if(err==false)
					Ext.getCmp('fs2.confirm').confirm({
						msg : 'Are you sure Save this Data ?',
						allow : 'fs2.save',
						onY : function() {
							Ext.getCmp('fs2.input').setLoading('Saving');
							var param = Ext.getCmp('fs2.input.panel').qParams();
							Ext.Ajax.request({
								url : url + 'app/fs2/save',
								method : 'POST',
								params:param,
								success : function(response) {
									Ext.getCmp('fs2.input').setLoading(false);
									var r = ajaxSuccess(response);
									if (r.result == 'SUCCESS') {
										Ext.getCmp('fs2.input').qClose();
										Ext.getCmp('fs2.list').refresh();
									}
								},
								failure : function(jqXHR, exception) {
									Ext.getCmp('fs2.input').setLoading(false);
									ajaxError(jqXHR, exception);
								}
							});
						}
					});
				else
					Ext.create('App.cmp.Toast').toast({msg : mes,type : 'warning'});
			}else if(req==true)
				Ext.getCmp('fs2.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('fs2.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'fs2.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 350,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'fs2.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'fs2.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Faskes',
					nullData : false,
					items : [
						new Ext.create('App.cmp.AutoComplete',{
							name:'f1',
							submit:'fs2.input.btnSave',
							width: 200,
							id:'fs2.input.f1',
							emptyText:'Faskes',
							url:url+'app/fs2/getFaskesList',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Akun',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'Nama Akun',
							name:'f2',
							width: 200,
							result:'dynamic',
							submit:'fs2.input.btnSave',
							id:'fs2.input.f2',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Email',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:128,
							emptyText:'Email',
							name:'f3',
							width: 200,
							submit:'fs2.input.btnSave',
							id:'fs2.input.f3',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'User Name',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:64,
							emptyText:'User Name',
							name:'f4',
							width: 200,
							submit:'fs2.input.btnSave',
							id:'fs2.input.f4',
							result:'lower',
							space:false,
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Password',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							name:'f5',
							width: 200,
							id:'fs2.input.f5',
							inputType: 'password' ,
							submit:'fs2.input.btnSave',
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
							name:'f6',
							submit:'fs2.input.btnSave',
							width: 200,
							id:'fs2.input.f6',
							inputType: 'password' ,
							emptyText:'Retry Password',
							allowBlank: false
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('fs2.input.panel').qGetForm() == false)
			Ext.getCmp('fs2.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'fs2.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})