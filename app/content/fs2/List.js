Ext.define('App.content.fs2.List',{
	extend:'App.cmp.Table',
	id:'fs2.list',
	params:function(){
		return Ext.getCmp('fs2.search.panel').qParams();
	},
	url:url + 'app/fs2/getList',
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
						Ext.getCmp('fs2.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/fs2/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('fs2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('fs2.input.panel').qReset();
									Ext.getCmp('fs2.input.f1').enable();
									Ext.getCmp('fs2.input.f2').enable();
									Ext.getCmp('fs2.input.f3').enable();
									Ext.getCmp('fs2.input.f4').enable();
									Ext.getCmp('fs2.input.f5').enable();
									Ext.getCmp('fs2.input.f6').enable();
									Ext.getCmp('fs2.input.p').setValue('ADD');
									Ext.getCmp('fs2.input').closing = false;
									Ext.getCmp('fs2.input').show();
									Ext.getCmp('fs2.input').setTitle('Faskes - Tambah');
									Ext.getCmp('fs2.input.f1').focus();
									Ext.getCmp('fs2.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('fs2.list').setLoading(false);
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
		            	Ext.getCmp('fs2.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('fs2.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/fs2/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('fs2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('fs2.search').show();
									Ext.getCmp('fs2.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('fs2.list').setLoading(false);
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
		{ text: 'Nama Faskes',width: 150, dataIndex: 'f1' },
		{ text: 'Nama Akun',width: 150, dataIndex: 'f2' },
		{ text: 'Email',width: 150, dataIndex: 'f3' },
		{ text: 'Nama Pengguna',width: 200, dataIndex: 'f4' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('fs2.list').setLoading('Mengambil Akun Faskes '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/fs2/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('fs2.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('fs2.input.panel').qReset();
							Ext.getCmp('fs2.input.i').setValue(record.data.i);
							Ext.getCmp('fs2.input.f1').disable();
							Ext.getCmp('fs2.input.f2').enable();
							Ext.getCmp('fs2.input.f3').enable();
							Ext.getCmp('fs2.input.f4').enable();
							Ext.getCmp('fs2.input.f5').disable();
							Ext.getCmp('fs2.input.f6').disable();
							Ext.getCmp('fs2.input.f1').setValue(o.f1);
							Ext.getCmp('fs2.input.f2').setValue(o.f2);
							Ext.getCmp('fs2.input.f3').setValue(o.f3);
							Ext.getCmp('fs2.input.f4').setValue(o.f4);
							Ext.getCmp('fs2.input.p').setValue('UPDATE');
							Ext.getCmp('fs2.input').closing = false;
							Ext.getCmp('fs2.input').setTitle('Faskes Akun - Ubah');
							Ext.getCmp('fs2.input').show();
							Ext.getCmp('fs2.input.f2').focus();
							Ext.getCmp('fs2.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('fs2.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		},{
			text: 'Ubah Password',
			width: 100,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('fs2.list').setLoading('Mengambil Akun Faskes '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/fs2/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('fs2.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('fs2.input.panel').qReset();
							Ext.getCmp('fs2.input.i').setValue(record.data.i);
							Ext.getCmp('fs2.input.f1').disable();
							Ext.getCmp('fs2.input.f2').disable();
							Ext.getCmp('fs2.input.f3').disable();
							Ext.getCmp('fs2.input.f4').disable();
							Ext.getCmp('fs2.input.f5').enable();
							Ext.getCmp('fs2.input.f6').enable();
							Ext.getCmp('fs2.input.f1').setValue(o.f1);
							Ext.getCmp('fs2.input.f2').setValue(o.f2);
							Ext.getCmp('fs2.input.f3').setValue(o.f3);
							Ext.getCmp('fs2.input.f4').setValue(o.f4);
							Ext.getCmp('fs2.input.p').setValue('CHANGE');
							Ext.getCmp('fs2.input').closing = false;
							Ext.getCmp('fs2.input').setTitle('Faskes Akun - Ubah Password');
							Ext.getCmp('fs2.input').show();
							Ext.getCmp('fs2.input.f5').focus();
							Ext.getCmp('fs2.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('fs2.list').setLoading(false);
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
				Ext.getCmp('fs2.confirm').confirm({
					msg : "Are you sure Delete Akun Faskes '"+record.raw.f1+"' ?",
					allow : 'fs2.delete',
					onY : function() {
						Ext.getCmp('fs2.list').setLoading('Deleting Akun Faskes '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/fs2/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('fs2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('fs2.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('fs2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});