Ext.define('App.content.s1.List',{
	extend:'App.cmp.Table',
	id:'s1.list',
	params:function(){
		return Ext.getCmp('s1.search.panel').qParams();
	},
	url:url + 'app/s1/getList',
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
						Ext.getCmp('s1.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s1/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s1.input.panel').qReset();
									Ext.getCmp('s1.input.f1').addReset(r.data.l);
									Ext.getCmp('s1.input.p').setValue('ADD');
									Ext.getCmp('s1.input').closing = false;
									Ext.getCmp('s1.input').show();
									Ext.getCmp('s1.input').setTitle('Poliklinik - Tambah');
									Ext.getCmp('s1.input.f1').focus();
									Ext.getCmp('s1.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s1.list').setLoading(false);
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
		            	Ext.getCmp('s1.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('s1.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s1/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s1.search').show();
									Ext.getCmp('s1.search.f1').addReset(r.data.l);
									Ext.getCmp('s1.search.f4').addReset(r.data.l1);
									Ext.getCmp('s1.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s1.list').setLoading(false);
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
		{ text: 'Jenis Unit',width: 150, dataIndex: 'f1' },
		{ text: 'Kode Unit',width: 150, dataIndex: 'f2' },
		{ text: 'Nama Unit',width: 150, dataIndex: 'f3' },
		{ text: 'Active',width: 50,sortable :false,dataIndex: 'f4',align:'center',
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
				Ext.getCmp('s1.list').setLoading('Mengambil Poliklinik '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/s1/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('s1.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('s1.input.panel').qReset();
							Ext.getCmp('s1.input.i').setValue(record.data.i);
							Ext.getCmp('s1.input.f1').addReset(r.data.l);
							Ext.getCmp('s1.input.f1').setValue(o.f1);
							Ext.getCmp('s1.input.f2').setValue(o.f2);
							Ext.getCmp('s1.input.f3').setValue(o.f3);
							Ext.getCmp('s1.input.f4').setValue(o.f4);
							Ext.getCmp('s1.input.p').setValue('UPDATE');
							Ext.getCmp('s1.input').closing = false;
							Ext.getCmp('s1.input').setTitle('Poliklinik - Ubah');
							Ext.getCmp('s1.input').show();
							Ext.getCmp('s1.input.f1').focus();
							Ext.getCmp('s1.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('s1.list').setLoading(false);
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
				Ext.getCmp('s1.confirm').confirm({
					msg : "Are you sure Delete Poliklinik '"+record.raw.f1+"' ?",
					allow : 's1.delete',
					onY : function() {
						Ext.getCmp('s1.list').setLoading('Deleting Poliklinik '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/s1/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('s1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('s1.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s1.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});