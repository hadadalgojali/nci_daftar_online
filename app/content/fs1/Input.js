Ext.define('App.content.fs1.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'fs1.input',
	modal : true,
	fbar: [{
		text: 'Simpan/Kirim Verifikasi',
		id:'fs1.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('fs1.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('fs1.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'fs1.save',
					onY : function() {
						Ext.getCmp('fs1.input').setLoading('Saving');
						var param = Ext.getCmp('fs1.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/fs1/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('fs1.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('fs1.input').qClose();
									Ext.getCmp('fs1.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('fs1.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('fs1.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('fs1.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'fs1.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 350,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'fs1.input.i'
				}),
				new Ext.create('App.cmp.Input',{
					label:'Status Verifikasi',
					items:[
						new Ext.create('App.cmp.CheckBox',{
							name:'f1',
							checked:false,
							id:'fs1.input.f1',
							listeners:{
								change:function(a){
									if(a.getValue()==true){
										Ext.getCmp('fs1.input.f2').enable();
										Ext.getCmp('fs1.input.f3').enable();
										Ext.getCmp('fs1.input.btnRandom').enable();
									}else{
										Ext.getCmp('fs1.input.f2').disable();
										Ext.getCmp('fs1.input.f3').disable();
										Ext.getCmp('fs1.input.f2').setValue('');
										Ext.getCmp('fs1.input.f3').setValue('');
										Ext.getCmp('fs1.input.btnRandom').disable();
									}
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
							emptyText:'User Name',
							name:'f2',
							submit:'fs1.input.btnSave',
							id:'fs1.input.f2',
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
							emptyText:'Password',
							name:'f3',
							submit:'fs1.input.btnSave',
							id:'fs1.input.f3',
							space:false,
							allowBlank: false
						}),
						new Ext.Button({
							iconCls:'i-refresh',
							id:'fs1.input.btnRandom',
							handler:function(){
								Ext.getCmp('fs1.input.f3').setValue(randomPassword());
							}
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('fs1.input.panel').qGetForm() == false)
			Ext.getCmp('fs1.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'fs1.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})