Ext.define('App.content.s2.List',{
	extend:'App.cmp.Table',
	id:'s2.list',
	params:function(){
		return Ext.getCmp('s2.search.panel').qParams();
	},
	url:url + 'app/s2/getList',
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
						Ext.getCmp('s2.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s2/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s2.input.panel').qReset();
									Ext.getCmp('s2.input.f1').enable();
									Ext.getCmp('s2.input.p').setValue('ADD');
									Ext.getCmp('s2.input').closing = false;
									Ext.getCmp('s2.input').show();
									Ext.getCmp('s2.input').setTitle('Penyakit - Tambah');
									Ext.getCmp('s2.input.f1').focus();
									Ext.getCmp('s2.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s2.list').setLoading(false);
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
		            	Ext.getCmp('s2.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('s2.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s2/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s2.search').show();
									Ext.getCmp('s2.search.f4').addReset(r.data.l);
									Ext.getCmp('s2.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s2.list').setLoading(false);
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
		{ text: 'Kode Penyakit',width: 150, dataIndex: 'f1' },
		{ text: 'Parent',width: 150, dataIndex: 'f2' },
		{ text: 'Nama Penyakit',flex:1, dataIndex: 'f3' },
		{ text: 'Non Rujuk',width: 100,sortable :false,dataIndex: 'f4',align:'center',
			renderer: function(value){
				if(value==true)
					return '<img src="' + icon('t') + '" style="margin: -5px;" />';
				else
					return '<img src="' + icon('f') + '" style="margin: -5px;" />';
			}
		},{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('s2.list').setLoading('Mengambil Penyakit '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/s2/initUpdate',
					params:{i:record.data.f1},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('s2.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('s2.input.panel').qReset();
							Ext.getCmp('s2.input.i').setValue(record.data.f1);
							Ext.getCmp('s2.input.f1').disable();
							Ext.getCmp('s2.input.f1').setValue(o.f1);
							Ext.getCmp('s2.input.f2').setValue(o.f2);
							Ext.getCmp('s2.input.f3').setValue(o.f3);
							Ext.getCmp('s2.input.f4').setValue(o.f4);
							Ext.getCmp('s2.input.p').setValue('UPDATE');
							Ext.getCmp('s2.input').closing = false;
							Ext.getCmp('s2.input').setTitle('Penyakit - Ubah');
							Ext.getCmp('s2.input').show();
							Ext.getCmp('s2.input.f2').focus();
							Ext.getCmp('s2.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('s2.list').setLoading(false);
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
				Ext.getCmp('s2.confirm').confirm({
					msg : "Are you sure Delete Penyakit '"+record.raw.f1+"' ?",
					allow : 's2.delete',
					onY : function() {
						Ext.getCmp('s2.list').setLoading('Deleting Penyakit '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/s2/delete',
							method : 'POST',
							params : {
								i : record.raw.f1
							},
							success : function(response) {
								Ext.getCmp('s2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('s2.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});