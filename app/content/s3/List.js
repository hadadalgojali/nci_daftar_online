Ext.define('App.content.s3.List',{
	extend:'App.cmp.Table',
	id:'s3.list',
	params:function(){
		return Ext.getCmp('s3.search.panel').qParams();
	},
	url:url + 'app/s3/getList',
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
						Ext.getCmp('s3.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s3/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s3.input.panel').qReset();
									Ext.getCmp('s3.input.f1').enable();
									Ext.getCmp('s3.input.f1').addReset(r.data.l);
									Ext.getCmp('s3.input.f8').setNull();
									Ext.getCmp('s3.input.p').setValue('ADD');
									Ext.getCmp('s3.input').closing = false;
									Ext.getCmp('s3.input').show();
									Ext.getCmp('s3.input').setTitle('Tentang Klinik - Tambah');
									Ext.getCmp('s3.input.f1').focus();
									Ext.getCmp('s3.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s3.list').setLoading(false);
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
		            	Ext.getCmp('s3.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('s3.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s3/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s3.search').show();
									Ext.getCmp('s3.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s3.list').setLoading(false);
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
		{ hidden:true,hideable:false,dataIndex: 'i' },
		{ text: 'Poliklinik',width: 150, dataIndex: 'f1' },
		{ text: 'Judul',width: 150, dataIndex: 'f2' },
		{ text: 'Email',width:150, dataIndex: 'f3' },
		{ text: 'Alamat',flex:1, dataIndex: 'f4' },
		{ text: 'Telepon',width:100,dataIndex: 'f5' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('s3.list').setLoading('Mengambil Tentang Klinik '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/s3/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('s3.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('s3.input.panel').qReset();
							Ext.getCmp('s3.input.i').setValue(record.data.i);
							Ext.getCmp('s3.input.f1').disable();
							Ext.getCmp('s3.input.f1').setRawValue(o.f1);
							Ext.getCmp('s3.input.f2').setValue(o.f2);
							Ext.getCmp('s3.input.f3').setValue(o.f3);
							Ext.getCmp('s3.input.f4').setValue(o.f4);
							Ext.getCmp('s3.input.f5').setValue(o.f5);
							Ext.getCmp('s3.input.f6').setValue(o.f6);
							Ext.getCmp('s3.input.f7').setValue(o.f7);
							Ext.getCmp('s3.input.f8').setFoto(o.f8);
							Ext.getCmp('s3.input.p').setValue('UPDATE');
							Ext.getCmp('s3.input').closing = false;
							Ext.getCmp('s3.input').setTitle('Tentang Klinik - Ubah');
							Ext.getCmp('s3.input').show();
							Ext.getCmp('s3.input.f2').focus();
							Ext.getCmp('s3.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('s3.list').setLoading(false);
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
				Ext.getCmp('s3.confirm').confirm({
					msg : "Are you sure Delete Tentang Klinik '"+record.raw.f1+"' ?",
					allow : 's3.delete',
					onY : function() {
						Ext.getCmp('s3.list').setLoading('Deleting Tentang Klinik '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/s3/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('s3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('s3.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s3.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});