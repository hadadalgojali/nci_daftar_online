Ext.define('App.content.drh4.List',{
	extend:'App.cmp.Table',
	id:'drh4.list',
	params:function(){
		return Ext.getCmp('drh4.search.panel').qParams();
	},
	url:url + 'app/drh4/getList',
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
		            text: 'Tambah Kec.',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('drh4.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/drh4/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('drh4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh4.input.panel').qReset();
									Ext.getCmp('drh4.input.p').setValue('ADD');
									Ext.getCmp('drh4.input').closing = false;
									Ext.getCmp('drh4.input').show();
									Ext.getCmp('drh4.input.f1').enable();
									Ext.getCmp('drh4.input').setTitle('Kecamatan - Add');
									Ext.getCmp('drh4.input.f1').focus();
									Ext.getCmp('drh4.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh4.list').setLoading(false);
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
		            	Ext.getCmp('drh4.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('drh4.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/drh4/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('drh4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('drh4.search').show();
									Ext.getCmp('drh4.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh4.list').setLoading(false);
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
		{ text: 'Nama Kota',width: 200, dataIndex: 'f1' },
		{ text: 'Nama Kecamatan',width: 200, dataIndex: 'f2' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('drh4.list').setLoading('Getting City '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/drh4/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('drh4.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('drh4.input.panel').qReset();
							Ext.getCmp('drh4.input.i').setValue(record.data.i);
							Ext.getCmp('drh4.input.f1').setValue(o.f1);
							Ext.getCmp('drh4.input.f2').setValue(o.f2);
							Ext.getCmp('drh4.input.f1').disable();
							Ext.getCmp('drh4.input.p').setValue('UPDATE');
							Ext.getCmp('drh4.input').closing = false;
							Ext.getCmp('drh4.input').setTitle('Kecamatan - Update');
							Ext.getCmp('drh4.input').show();
							Ext.getCmp('drh4.input.f1').focus();
							Ext.getCmp('drh4.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('drh4.list').setLoading(false);
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
				Ext.getCmp('drh4.confirm').confirm({
					msg : "Are you sure Delete content Districts Name '"+record.raw.f1+"' ?",
					allow : 'drh4.delete',
					onY : function() {
						Ext.getCmp('drh4.list').setLoading('Deleting Districts Name'+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/drh4/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('drh4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('drh4.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('drh4.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});