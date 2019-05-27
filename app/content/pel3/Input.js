Ext.define('App.content.pel3.Input',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'pel3.input',
	title:'Employee',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		id:'pel3.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('pel3.input.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('pel3.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'pel3.save',
					onY : function() {
						Ext.getCmp('pel3.input').setLoading('Saving');
						var param = Ext.getCmp('pel3.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/pel3/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('pel3.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel3.input').qClose();
									Ext.getCmp('pel3.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel3.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('pel3.input').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('pel3.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'pel3.input.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 420,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'p',
					id:'pel3.input.p'
				}),
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'pel3.input.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Klinik',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'pel3.input.f1',
							width: 250,
							fields:['id','text'],
							emptyText:'Klinik',
							name : 'f1',
							submit:'pel3.input.btnSave',
							allowBlank : false,
							listeners:{
								select:function(a){
									Ext.getCmp('pel3.input.f2').setValue(null);
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
							submit:'pel3.input.btnSave',
							width: 250,
							params:function(){
								return {i:Ext.getCmp('pel3.input.f1').getValue()};
							},
							id:'pel3.input.f2',
							emptyText:'Dokter',
							url:url+'app/pel3/getDokter',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Hari',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'pel3.input.f3',
							width: 100,
							emptyText:'Hari',
							name : 'f3',
							submit:'pel3.input.btnSave',
							allowBlank : false
						})
					]
				}), 
				new Ext.create('App.cmp.Input',{
					label:'Pukul',
					items:[
						new Ext.create('App.cmp.TimeField',{
							emptyText:'Pukul',
							name:'f4',
							width: 100,
							submit:'pel3.input.btnSave',
							id:'pel3.input.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Max Antrian',
					nullData : false,
					items:[
						new Ext.create('App.cmp.NumberField',{
							emptyText:'Max Antrian',
							name:'f5',
							submit:'pel3.input.btnSave',
							id:'pel3.input.f5',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Durasi(menit)',
					nullData : false,
					items:[
						new Ext.create('App.cmp.NumberField',{
							emptyText:'Durasi',
							name:'f6',
							submit:'pel3.input.btnSave',
							id:'pel3.input.f6',
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
		if (Ext.getCmp('pel3.input.panel').qGetForm() == false)
			Ext.getCmp('pel3.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'pel3.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})