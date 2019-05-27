Ext.define('App.content.s2.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'s2.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'s2.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('s2.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('s2.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 's2.save',
					onY : function() {
						Ext.getCmp('s2.input').setLoading('Saving');
						var param = Ext.getCmp('s2.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/s2/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('s2.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s2.input').qClose();
									Ext.getCmp('s2.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s2.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('s2.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('s2.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 's2.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'s2.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'s2.input.i'
				}),
				new Ext.create('App.cmp.Input',{
					label:'Kode Penyakit',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:12,
							emptyText:'Kode Penyakit',
							name:'f1',
							width: 100,
							submit:'s2.input.btnSave',
							id:'s2.input.f1',
							result:'upper',
							space:false,
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Parent',
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:12,
							emptyText:'Parent',
							name:'f2',
							width: 100,
							submit:'s2.input.btnSave',
							id:'s2.input.f2',
							result:'upper',
							space:false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Penyakit',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:1024,
							emptyText:'Nama Penyakit',
							name:'f3',
							width: 200,
							submit:'s2.input.btnSave',
							id:'s2.input.f3',
							result:'dynamic',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Non Rujukan',
					items:[
						new Ext.create('App.cmp.CheckBox',{
							name:'f4',
							checked:false,
							id:'s2.input.f4'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('s2.input.panel').qGetForm() == false)
			Ext.getCmp('s2.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 's2.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})