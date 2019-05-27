Ext.define('App.content.s1.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'s1.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'s1.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('s1.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('s1.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 's1.save',
					onY : function() {
						Ext.getCmp('s1.input').setLoading('Saving');
						var param = Ext.getCmp('s1.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/s1/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('s1.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s1.input').qClose();
									Ext.getCmp('s1.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s1.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('s1.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('s1.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 's1.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 340,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'s1.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'s1.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Jenis Unit',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 's1.input.f1',
							width: 150,
							emptyText:'Jenis Unit',
							name : 'f1',
							submit:'s1.input.btnSave',
							allowBlank : false
						})
					]
				}), 
				new Ext.create('App.cmp.Input',{
					label:'Kode Unit',
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'Kode Unit',
							name:'f2',
							width: 200,
							submit:'s1.input.btnSave',
							id:'s1.input.f2',
							result:'upper',
							space:false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Nama Unit',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'Nama Unit',
							name:'f3',
							width: 200,
							submit:'s1.input.btnSave',
							id:'s1.input.f3',
							result:'dynamic',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Aktif',
					items:[
						new Ext.create('App.cmp.CheckBox',{
							name:'f4',
							checked:true,
							id:'s1.input.f4'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('s1.input.panel').qGetForm() == false)
			Ext.getCmp('s1.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 's1.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})