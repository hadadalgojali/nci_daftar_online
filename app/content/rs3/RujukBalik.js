Ext.define('App.content.rs3.RujukBalik',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'rs3.input',
	title:'Rujukan Balik',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Rujuk Balik',
		id:'rs3.input.btnSave',
		iconCls:'i-save',
		handler: function() {
			var req=Ext.getCmp('rs3.input.panel').qGetForm(true);
			if(req == false){
				Ext.getCmp('rs3.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'rs3.save',
					onY : function() {
						Ext.getCmp('rs3.input').setLoading('Saving');
						var param = Ext.getCmp('rs3.input.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/rs3/saveRujukanBalik',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('rs3.input').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('rs3.input').qClose();
									Ext.getCmp('rs3.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs3.input').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}else if(req==true){
				Ext.getCmp('rs3.input').qClose();
			}
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('rs3.input').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'rs3.input.panel',
			width: 350,
			items:[
				new Ext.create('App.cmp.Input',{
					label:'No. Rujukan',
					items:[
						new Ext.create('App.cmp.TextField',{
							maxLength:32,
							emptyText:'No. Rujukan',
							name:'f1',
							width: 200,
							id:'rs3.input.f1',
							disabled:true
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Diagnosa',
					nullData : false,
					items : [
						new Ext.create('App.cmp.AutoComplete',{
							name:'f2',
							submit:'rs3.input.btnSave',
							width: 200,
							id:'rs3.input.f2',
							emptyText:'Diagnosa',
							url:url+'app/rs3/getPenyakit',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Dokter',
					nullData : false,
					items : [
						new Ext.create('App.cmp.AutoComplete',{
							name:'f9',
							submit:'rs3.input.btnSave',
							width: 200,
							id:'rs3.input.f9',
							emptyText:'Dokter',
							url:url+'app/rs3/getDokter',
							allowBlank : false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Terapi',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextArea',{
							maxLength:128,
							name:'f3',
							emptyText:'Terapi',
							width: 200,
							id:'rs3.input.f3',
							allowBlank: false
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Obat',
					items:[
						new Ext.create('App.cmp.TextArea',{
							maxLength:128,
							name:'f4',
							emptyText:'Obat',
							width: 200,
							id:'rs3.input.f4'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Kontrol Kembali',
					items:[
						new Ext.create('App.cmp.DateField',{
							name:'f5',
							emptyText:'Kontrol Kembali',
							id:'rs3.input.f5'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Lain-lain',
					items:[
						new Ext.create('App.cmp.TextArea',{
							maxLength:128,
							name:'f6',
							emptyText:'Lain-lain',
							width: 200,
							id:'rs3.input.f6'
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Perlu R. Inap',
					items : [
						new Ext.create('App.cmp.CheckBox', {
							id : 'rs3.input.f7',
							name : 'f7',
							checked:false
						})
					]
				}),
				new Ext.create('App.cmp.Input', {
					label : 'Kons. Selesai',
					items : [
						new Ext.create('App.cmp.CheckBox', {
							id : 'rs3.input.f8',
							name : 'f8',
							checked:false
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('rs3.input.panel').qGetForm() == false) {
			Ext.getCmp('rs3.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'rs3.close',
				onY : function() {
					$this.qClose();
				}
			});
		} else {
			$this.qClose();
		}
		return false;
	}
})