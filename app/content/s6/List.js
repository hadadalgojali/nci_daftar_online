Ext.define('App.content.s6.List',{
	extend:'App.cmp.Table',
	id:'s6.list',
	params:function(){
		return Ext.getCmp('s6.search.panel').qParams();
	},
	url:url + 'app/s6/getList',
	result:function(response){
		return {list:response.data,total:response.total};
	},
	tbar:[
		Ext.create('Ext.panel.Panel', {
		    flex: 1,
		    border:false,
		    tbar: [{
		        xtype: 'buttongroup',
		        columns: 3,
		        title: 'Menu',
		        items: [{
		            text: 'Tambah',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('s6.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s6/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s6.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s6.input.panel').qReset();
									Ext.getCmp('s6.input.f1').addReset(r.data.l);
									Ext.getCmp('s6.input.p').setValue('ADD');
									Ext.getCmp('s6.input').closing = false;
									Ext.getCmp('s6.input').show();
									Ext.getCmp('s6.input').setTitle('Dokter Klinik - Tambah');
									Ext.getCmp('s6.input.f1').focus();
									Ext.getCmp('s6.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s6.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        },{
		            text: 'Refresh',
		            scale: 'large',
		            iconCls: 'i-refresh-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	Ext.getCmp('s6.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('s6.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s6/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s6.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s6.search').show();
									Ext.getCmp('s6.search.f3').addReset(r.data.l);
									Ext.getCmp('s6.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s6.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    }]
		}) 
	],
	columns:[
		{ xtype: 'rownumberer'},
		{ hidden:true, hideable:false,dataIndex: 'i' },
		{ text: 'Klinik',width: 150, dataIndex: 'f1' },
		{ text: 'Dokter',flex:1, dataIndex: 'f2' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('s6.list').setLoading('Mengambil  Dokter Klinik '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/s6/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('s6.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('s6.input.panel').qReset();
							Ext.getCmp('s6.input.i').setValue(record.data.i);
							Ext.getCmp('s6.input.f1').addReset(r.data.l);
							Ext.getCmp('s6.input.f1').setValue(o.f1);
							Ext.getCmp('s6.input.f2').setValue(o.f2);
							Ext.getCmp('s6.input.p').setValue('UPDATE');
							Ext.getCmp('s6.input').closing = false;
							Ext.getCmp('s6.input').setTitle('Dokter Klinik - Ubah');
							Ext.getCmp('s6.input').show();
							Ext.getCmp('s6.input.f1').focus();
							Ext.getCmp('s6.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('s6.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		},{
			text: 'Delete',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-del',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('s6.confirm').confirm({
					msg : "Are you sure Delete Dokter Klinik '"+record.raw.f1+"' ?",
					allow : 's6.delete',
					onY : function() {
						Ext.getCmp('s6.list').setLoading('Deleting Dokter Klinik '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/s6/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('s6.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('s6.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s6.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});