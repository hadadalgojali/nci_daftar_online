Ext.define('App.system.a5.View',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	closeAction:'destroy',
	title:'Employee',
	modal:true,
	initComponent:function(){
		var $this=this;
		var id,name,birthDate,birthPlace,gender,religion,address,email,phone,fax,foto;
		$this.fbar=[{
			text: 'Close',
			iconCls:'i-close',
			handler: function(a,b) {
				$this.hide();
			}
		}];
		this.items=[
			new Ext.create('App.cmp.Panel',{
				width: 350,
				title:'Data Employee',
				bodyStyle : 'padding: 5px 10px',
				items:[
					new Ext.create('App.cmp.Input',{
						label:'ID Number',
						bold:true,
						items:[
							id=new Ext.form.DisplayField({})
						]
					}),   
					new Ext.create('App.cmp.Input',{
						label:'Name',
						bold:true,
						items:[
							name=new Ext.form.DisplayField({})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Birth date',
						bold:true,
						items:[
							birthDate=new Ext.form.DisplayField({})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Birth Place',
						bold:true,
						items:[
							birthPlace=new Ext.form.DisplayField({})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Gender',
						bold:true,
						items:[
							gender=new Ext.form.DisplayField({})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Religion',
						bold:true,
						items:[
							religion=new Ext.form.DisplayField({})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Address',
						bold:true,
						items:[
							address=new Ext.form.DisplayField({})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Email',
						bold:true,
						items:[
							email=new Ext.form.DisplayField({})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Phone Number',
						bold:true,
						items:[
							phone=new Ext.form.DisplayField({})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Fax Number',
						bold:true,
						items:[
							fax=new Ext.form.DisplayField({})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'Foto',
						bold:true,
						items:[
							foto=new Ext.create('App.cmp.FotoUpload',{
								input:false
							})
						]
					})
				]
			})
		]
		this.callParent();
		Ext.getBody().mask('Loading');
		Ext.Ajax.request({
			url : url + 'app/a5/getById',
			method : 'GET',
			params:{i:$this.dataId},
			success : function(response) {
				Ext.getBody().unmask();
				var r = ajaxSuccess(response);
				if (r.result == 'SUCCESS') {
					var o=r.data;
					id.setValue(o.f1);
					name.setValue(o.f2);
					birthDate.setValue(o.f3);
					birthPlace.setValue(o.f4);
					gender.setValue(o.f5);
					religion.setValue(o.f6);
					address.setValue(o.f7);
					email.setValue(o.f8);
					phone.setValue(o.f9);
					fax.setValue(o.f10);
					foto.setFoto(o.f11);
					$this.show();
					$this.center();
				}
			},
			failure : function(jqXHR, exception) {
				Ext.getBody().unmask();
				ajaxError(jqXHR, exception);
			}
		});
	}
})