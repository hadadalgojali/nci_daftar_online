Ext.define('App.content.drh2.List',{
	extend:'App.cmp.Table',
	id:'drh2.list',
	params:function(){
		return Ext.getCmp('drh2.search.panel').qParams();
	},
	url:url + 'app/drh2/getList',
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
						Ext.getCmp('drh2.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/drh2/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('drh2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh2.input.panel').qReset();
									Ext.getCmp('drh2.input.p').setValue('ADD');
									Ext.getCmp('drh2.input').closing = false;
									Ext.getCmp('drh2.input').show();
									Ext.getCmp('drh2.input.f1').enable();
									Ext.getCmp('drh2.input').setTitle('Province - Add');
									Ext.getCmp('drh2.input.f1').focus();
									Ext.getCmp('drh2.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh2.list').setLoading(false);
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
		            	Ext.getCmp('drh2.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('drh2.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/drh2/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('drh2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh2.search').show();
									Ext.getCmp('drh2.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh2.list').setLoading(false);
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
		{ text: 'Nama Provinsi',width: 200, dataIndex: 'f2' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('drh2.list').setLoading('Getting Province '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/drh2/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('drh2.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('drh2.input.panel').qReset();
							Ext.getCmp('drh2.input.i').setValue(record.data.i);
							Ext.getCmp('drh2.input.f1').setValue(o.f1);
							Ext.getCmp('drh2.input.f2').setValue(o.f2);
							Ext.getCmp('drh2.input.f1').disable();
							Ext.getCmp('drh2.input.p').setValue('UPDATE');
							Ext.getCmp('drh2.input').closing = false;
							Ext.getCmp('drh2.input').setTitle('Province - Update');
							Ext.getCmp('drh2.input').show();
							Ext.getCmp('drh2.input.f1').focus();
							Ext.getCmp('drh2.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('drh2.list').setLoading(false);
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
				Ext.getCmp('drh2.confirm').confirm({
					msg : "Are you sure Delete content Province Name '"+record.raw.f1+"' ?",
					allow : 'drh2.delete',
					onY : function() {
						Ext.getCmp('drh2.list').setLoading('Deleting Province Name '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/drh2/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('drh2.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('drh2.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh2.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});