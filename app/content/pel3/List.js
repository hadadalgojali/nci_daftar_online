Ext.define('App.content.pel3.List',{
	extend:'App.cmp.Table',
	id:'pel3.list',
	params:function(){
		return Ext.getCmp('pel3.search.panel').qParams();
	},
	url:url + 'app/pel3/getList',
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
						Ext.getCmp('pel3.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/pel3/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('pel3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel3.input.panel').qReset();
									Ext.getCmp('pel3.input.f1').addReset(r.data.l);
									Ext.getCmp('pel3.input.f3').addReset(r.data.l1);
									Ext.getCmp('pel3.input.p').setValue('ADD');
									Ext.getCmp('pel3.input').closing = false;
									Ext.getCmp('pel3.input').show();
									Ext.getCmp('pel3.input').setTitle('Jadwal Dokter - Tambah');
									Ext.getCmp('pel3.input.f1').focus();
									Ext.getCmp('pel3.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel3.list').setLoading(false);
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
		            	Ext.getCmp('pel3.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('pel3.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/pel3/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('pel3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel3.search').show();
									Ext.getCmp('pel3.search.f3').addReset(r.data.l);
									Ext.getCmp('pel3.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel3.list').setLoading(false);
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
		{ text: 'Hari',width: 100, dataIndex: 'f3',align:'center' },
		{ text: 'Pukul',width: 150, dataIndex: 'f4',align:'center' },
		{ text: 'Max',width: 80, dataIndex: 'f5',align:'right' },
		{ text: 'Durasi(menit)',width: 80, dataIndex: 'f6',align:'right' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('pel3.list').setLoading('Mengambil Poliklinik '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/pel3/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('pel3.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('pel3.input.panel').qReset();
							Ext.getCmp('pel3.input.i').setValue(record.data.i);
							Ext.getCmp('pel3.input.f1').addReset(r.data.l);
							Ext.getCmp('pel3.input.f3').addReset(r.data.l1);
							Ext.getCmp('pel3.input.f1').setValue(o.f1);
							Ext.getCmp('pel3.input.f2').setValue(o.f2);
							Ext.getCmp('pel3.input.f3').setValue(o.f3);
							Ext.getCmp('pel3.input.f4').setValue(o.f4);
							Ext.getCmp('pel3.input.f5').setValue(o.f5);
							Ext.getCmp('pel3.input.f6').setValue(o.f6);
							Ext.getCmp('pel3.input.p').setValue('UPDATE');
							Ext.getCmp('pel3.input').closing = false;
							Ext.getCmp('pel3.input').setTitle('Jadwal Dokter - Ubah');
							Ext.getCmp('pel3.input').show();
							Ext.getCmp('pel3.input.f1').focus();
							Ext.getCmp('pel3.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('pel3.list').setLoading(false);
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
				Ext.getCmp('pel3.confirm').confirm({
					msg : "Are you sure Delete Jadwal Dokter '"+record.raw.f1+"' ?",
					allow : 'pel3.delete',
					onY : function() {
						Ext.getCmp('pel3.list').setLoading('Deleting Jadwal Dokter '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/pel3/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('pel3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('pel3.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel3.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});