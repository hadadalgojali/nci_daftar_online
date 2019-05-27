Ext.define('App.content.pel6.List',{
	extend:'App.cmp.Table',
	id:'pel6.list',
	params:function(){
		return Ext.getCmp('pel6.search.panel').qParams();
	},
	url:url + 'app/pel6/getList',
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
						Ext.getCmp('pel6.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/pel6/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('pel6.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel6.input.panel').qReset();
									Ext.getCmp('pel6.input.p').setValue('ADD');
									Ext.getCmp('pel6.input').closing = false;
									Ext.getCmp('pel6.input').show();
									Ext.getCmp('pel6.input').setTitle('Artikel - Tambah');
									Ext.getCmp('pel6.input.f1').focus();
									Ext.getCmp('pel6.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel6.list').setLoading(false);
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
		            	Ext.getCmp('pel6.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('pel6.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/pel6/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('pel6.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('pel6.search').show();
									Ext.getCmp('pel6.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel6.list').setLoading(false);
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
		{ text: 'Judul Artikel',flex:1, dataIndex: 'f2' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('pel6.list').setLoading('Mengambil Artikel '+record.data.f2);
				Ext.Ajax.request({
					url : url + 'app/pel6/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('pel6.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('pel6.input.panel').qReset();
							Ext.getCmp('pel6.input.i').setValue(record.data.i);
							Ext.getCmp('pel6.input.f1').setValue(o.f1);;
							Ext.getCmp('pel6.input.f4').setValue(o.f4);
							Ext.getCmp('pel6.input.p').setValue('UPDATE');
							Ext.getCmp('pel6.input').closing = false;
							Ext.getCmp('pel6.input').setTitle('Artikel - Ubah');
							Ext.getCmp('pel6.input').show();
							Ext.getCmp('pel6.input.f1').focus();
							Ext.getCmp('pel6.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('pel6.list').setLoading(false);
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
				Ext.getCmp('pel6.confirm').confirm({
					msg : "Are you sure Delete Artikel '"+record.raw.f2+"' ?",
					allow : 'pel6.delete',
					onY : function() {
						Ext.getCmp('pel6.list').setLoading('Deleting Artikel '+record.raw.f2);
						Ext.Ajax.request({
							url : url + 'app/pel6/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('pel6.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('pel6.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('pel6.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});