Ext.define('App.content.fs1.List',{
	extend:'App.cmp.Table',
	id:'fs1.list',
	params:function(){
		return Ext.getCmp('fs1.search.panel').qParams();
	},
	url:url + 'app/fs1/getList',
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
		            text: 'Refresh',
		            scale: 'large',
		            iconCls: 'i-refresh-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	Ext.getCmp('fs1.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('fs1.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/fs1/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('fs1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('fs1.search').show();
									Ext.getCmp('fs1.search.f3').addReset(r.data.l);
									Ext.getCmp('fs1.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('fs1.list').setLoading(false);
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
		{ text: 'Kode Faskes',width: 100, dataIndex: 'f1' },
		{ text: 'Nama Faskes',width: 150, dataIndex: 'f2' },
		{ text: 'Alamat',flex:1, dataIndex: 'f3'},
		{ text: 'Telepon',width: 100, dataIndex: 'f4',align:'center' },
		{ text: 'Email',width: 150, dataIndex: 'f5' },
		{ text: 'Status',width: 80,sortable :false,dataIndex: 'f6',align:'center',
			renderer: function(value){
				if(value==true)
					return '<img src="' + icon('t') + '" style="margin: -5px;" />';
				else
					return '<img src="' + icon('f') + '" style="margin: -5px;" />';
			}
		},{
			text: 'Set Status',
			width: 80,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('fs1.list').setLoading('Mengambil Poliklinik '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/fs1/initUpdate',
					params:{i:record.data.f1},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('fs1.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('fs1.input.panel').qReset();
							Ext.getCmp('fs1.input.i').setValue(record.data.f1);
							Ext.getCmp('fs1.input.f1').setValue(o.f1);
							Ext.getCmp('fs1.input.f2').disable();
							Ext.getCmp('fs1.input.f3').disable();
							Ext.getCmp('fs1.input.btnRandom').disable();
							Ext.getCmp('fs1.input').closing = false;
							Ext.getCmp('fs1.input').setTitle('Verifikasi Faskes');
							Ext.getCmp('fs1.input').show();
							Ext.getCmp('fs1.input.f1').focus();
							Ext.getCmp('fs1.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('fs1.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			},
			isDisabled : function(view, rowIdx, colIdx, item, record) {
				if(record.data.f6==true)
					return true;
				else
					return false;
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
				Ext.getCmp('fs1.confirm').confirm({
					msg : "Are you sure Delete Jadwal Dokter '"+record.raw.f1+"' ?",
					allow : 'fs1.delete',
					onY : function() {
						Ext.getCmp('fs1.list').setLoading('Deleting Jadwal Dokter '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/fs1/delete',
							method : 'POST',
							params : {
								i : record.raw.f1
							},
							success : function(response) {
								Ext.getCmp('fs1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('fs1.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('fs1.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			},
			isDisabled : function(view, rowIdx, colIdx, item, record) {
				if(record.data.f6==true)
					return true;
				else
					return false;
			}
		}
	]
});