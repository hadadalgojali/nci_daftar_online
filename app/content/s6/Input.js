Ext.define('App.content.s6.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'s6.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'s6.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('s6.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('s6.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 's6.save',
					onY : function() {
						Ext.getCmp('s6.input').setLoading('Saving');
						var param = Ext.getCmp('s6.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/s6/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('s6.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s6.input').qClose();
									Ext.getCmp('s6.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s6.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('s6.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('s6.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 's6.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 420,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'s6.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'s6.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Klinik',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 's6.input.f1',
							width: 250,
							fields:['id','text'],
							emptyText:'Klinik',
							name : 'f1',
							submit:'s6.input.btnSave',
							allowBlank : false,
							listeners:{
								select:function(a){
									Ext.getCmp('s6.input.f2').setValue(null);
								}
							}
						})
					]
				}), 
				new Ext.create('App.cmp.Input', {
					label : 'Dokter',
					nullData : false,
					items : [
						new Ext.create('App.cmp.AutoComplete',{
							name:'f2',
							submit:'s6.input.btnSave',
							width: 250,
							params:function(){
								return {i:Ext.getCmp('s6.input.f1').getValue()};
							},
							id:'s6.input.f2',
							emptyText:'Dokter',
							url:url+'app/s6/getDokter',
							allowBlank : false
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('s6.input.panel').qGetForm() == false)
			Ext.getCmp('s6.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 's6.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})