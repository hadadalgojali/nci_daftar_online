Ext.define('App.content.s5.List',{
	extend:'App.cmp.Table',
	id:'s5.list',
	params:function(){
		return Ext.getCmp('s5.search.panel').qParams();
	},
	url:url + 'app/s5/getList',
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
						Ext.getCmp('s5.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s5/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s5.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s5.input.panel').qReset();
									Ext.getCmp('s5.input.f1').enable();
									Ext.getCmp('s5.input.f1').addReset(r.data.l);
									Ext.getCmp('s5.input.f2').addReset(r.data.l1);
									Ext.getCmp('s5.input.p').setValue('ADD');
									Ext.getCmp('s5.input').closing = false;
									Ext.getCmp('s5.input').show();
									Ext.getCmp('s5.input').setTitle('Kontraktor - Tambah');
									Ext.getCmp('s5.input.f1').focus();
									Ext.getCmp('s5.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s5.list').setLoading(false);
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
		            	Ext.getCmp('s5.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('s5.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s5/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s5.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s5.search').show();
									Ext.getCmp('s5.search.f2').addReset(r.data.l);
									Ext.getCmp('s5.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s5.list').setLoading(false);
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
		{ text: 'Customer',width: 150, dataIndex: 'f1' },
		{ text: 'Jenis Customer',width: 150, dataIndex: 'f2' },
		{ text: 'Kontak',width: 150, dataIndex: 'f3' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('s5.list').setLoading('Mengambil Kontraktor '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/s5/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('s5.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('s5.input.panel').qReset();
							Ext.getCmp('s5.input.i').setValue(record.data.i);
							Ext.getCmp('s5.input.f1').addReset(r.data.l);
							Ext.getCmp('s5.input.f1').disable();
							Ext.getCmp('s5.input.f2').addReset(r.data.l1);
							Ext.getCmp('s5.input.f1').setValue(o.f1);
							Ext.getCmp('s5.input.f2').setValue(o.f2);
							Ext.getCmp('s5.input.f3').setValue(o.f3);
							Ext.getCmp('s5.input.p').setValue('UPDATE');
							Ext.getCmp('s5.input').closing = false;
							Ext.getCmp('s5.input').setTitle('Kontraktor - Ubah');
							Ext.getCmp('s5.input').show();
							Ext.getCmp('s5.input.f2').focus();
							Ext.getCmp('s5.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('s5.list').setLoading(false);
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
				Ext.getCmp('s5.confirm').confirm({
					msg : "Are you sure Delete Kontraktor '"+record.raw.f1+"' ?",
					allow : 's5.delete',
					onY : function() {
						Ext.getCmp('s5.list').setLoading('Deleting Kontraktor '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/s5/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('s5.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('s5.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s5.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});