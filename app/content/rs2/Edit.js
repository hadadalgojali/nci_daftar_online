Ext.define('App.content.rs2.Edit',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'rs2.edit',
	title:'Kunjungan - Ubah',
	modal : true,
	fbar: [{
		text: 'Save',
		id:'rs2.edit.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('rs2.edit.panel').qGetForm(true);
			if(req == false)
				Ext.getCmp('rs2.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'rs2.save',
					onY : function() {
						Ext.getCmp('rs2.edit').setLoading('Saving');
						var param = Ext.getCmp('rs2.edit.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/rs2/save',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('rs2.edit').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('rs2.edit').qClose();
									Ext.getCmp('rs2.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs2.edit').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			else if(req==true)
				Ext.getCmp('rs2.edit').qClose();
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('rs2.edit').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			id : 'rs2.edit.panel',
			bodyStyle : 'padding: 5px 10px',
			width: 420,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'rs2.edit.i'
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Klinik',
					nullData : false,
					items : [
						new Ext.create('App.cmp.DropDown', {
							id : 'rs2.edit.f1',
							width: 250,
							fields:['id','text'],
							emptyText:'Klinik',
							name : 'f1',
							submit:'rs2.edit.btnSave',
							allowBlank : false,
							listeners:{
								select:function(a){
									Ext.getCmp('rs2.edit.f2').setValue(null);
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
							submit:'rs2.edit.btnSave',
							width: 250,
							params:function(){
								return {i:Ext.getCmp('rs2.edit.f1').getValue()};
							},
							id:'rs2.edit.f2',
							emptyText:'Dokter',
							url:url+'app/RS2/getDokter',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Alasan Perubahan',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextArea',{
							maxLength:128,
							emptyText:'Alasan Perubahan',
							name:'f3',
							width: 200,
							submit:'drh3.input.btnSave',
							id:'drh3.input.f3',
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
		if (Ext.getCmp('rs2.edit.panel').qGetForm() == false)
			Ext.getCmp('rs2.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'rs2.close',
				onY : function() {
					$this.qClose();
				}
			});
		else
			$this.qClose();
		return false;
	}
})