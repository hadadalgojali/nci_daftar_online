Ext.define('App.content.rs2.Hadir',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'rs2.hadir',
	title:'hadir Kehadiran',
	closing : false,
	modal : true,
	fbar: [{
		text: 'Save',
		iconCls:'i-save',
		id:'rs2.hadir.btnSave',
		handler: function() {
			var req=Ext.getCmp('rs2.hadir.panel').qGetForm(true);
			if(req == false){
				Ext.getCmp('rs2.confirm').confirm({
					msg : 'Are you sure Save this Data ?',
					allow : 'rs2.hadirSave',
					onY : function() {
						Ext.getCmp('rs2.hadir').setLoading('Saving');
						var param = Ext.getCmp('rs2.hadir.panel').qParams();
						Ext.Ajax.request({
							url : url + 'app/rs2/setHadir',
							method : 'POST',
							params:param,
							success : function(response) {
								Ext.getCmp('rs2.hadir').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('rs2.hadir').qClose();
									Ext.getCmp('rs2.list').refresh();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs2.hadir').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}else if(req==true){
				Ext.getCmp('rs2.hadir').qClose();
			}
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('rs2.hadir').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.Panel',{
			bodyStyle : 'padding: 5px 10px',
			id : 'rs2.hadir.panel',
			width: 350,
			items:[
				new Ext.create('App.cmp.HiddenField',{
					name:'i',
					id:'rs2.hadir.i'
				}),
				new Ext.create('App.cmp.Input',{
					label:'No. Pendaftaran',
					nullData : false,
					items:[
						new Ext.create('App.cmp.TextField',{
							name:'f1',
							disabled:true,
							emptyText:'No. Pendaftaran',
							width: 200,
							id:'rs2.hadir.f1'
						})
					]
				}),
				new Ext.create('App.cmp.Input',{
					label:'Dilayani',
					items:[
						new Ext.create('App.cmp.CheckBox',{
							name:'f2',
							id:'rs2.hadir.f2'
						})
					]
				})
			]
		})
	],
	qBeforeClose : function() {
		var $this = this;
		$this.closing = false;
		if (Ext.getCmp('rs2.hadir.panel').qGetForm() == false) {
			Ext.getCmp('rs2.confirm').confirm({
				msg :'Whether You Will Ignore All Data ?',
				allow : 'rs2.hadirClose',
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