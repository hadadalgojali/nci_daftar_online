Ext.define('App.content.drh1.List',{
	extend:'App.cmp.Table',
	id:'drh1.list',
	params:function(){
		return Ext.getCmp('drh1.search.panel').qParams();
	},
	url:url + 'app/drh1/getList',
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
		            text: 'Tambah Negara',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('drh1.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/drh1/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('drh1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh1.input.panel').qReset();
									Ext.getCmp('drh1.input.p').setValue('ADD');
									Ext.getCmp('drh1.input').closing = false;
									Ext.getCmp('drh1.input').show();
									Ext.getCmp('drh1.input').setTitle('Negara - Tambah');
									Ext.getCmp('drh1.input.f1').focus();
									Ext.getCmp('drh1.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh1.list').setLoading(false);
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
		            	Ext.getCmp('drh1.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('drh1.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/drh1/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('drh1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh1.search').show();
									Ext.getCmp('drh1.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh1.list').setLoading(false);
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
		{ text: 'Nama Negara',width: 200, dataIndex: 'f1' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('drh1.list').setLoading('Mengambil Negara '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/drh1/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('drh1.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('drh1.input.panel').qReset();
							Ext.getCmp('drh1.input.i').setValue(record.data.i);
							Ext.getCmp('drh1.input.f1').setValue(o.f1);
							Ext.getCmp('drh1.input.p').setValue('UPDATE');
							Ext.getCmp('drh1.input').closing = false;
							Ext.getCmp('drh1.input').setTitle('Negara - Ubah');
							Ext.getCmp('drh1.input').show();
							Ext.getCmp('drh1.input.f1').focus();
							Ext.getCmp('drh1.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('drh1.list').setLoading(false);
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
				Ext.getCmp('drh1.confirm').confirm({
					msg : "Are you sure Delete content Country Name '"+record.raw.f1+"' ?",
					allow : 'drh1.delete',
					onY : function() {
						Ext.getCmp('drh1.list').setLoading('Deleting Country Name '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/drh1/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('drh1.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('drh1.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh1.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});