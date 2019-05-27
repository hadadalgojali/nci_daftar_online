Ext.define('App.content.s4.List',{
	extend:'App.cmp.Table',
	id:'s4.list',
	params:function(){
		return Ext.getCmp('s4.search.panel').qParams();
	},
	url:url + 'app/s4/getList',
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
						Ext.getCmp('s4.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s4/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s4.input.panel').qReset();
									Ext.getCmp('s4.input.p').setValue('ADD');
									Ext.getCmp('s4.input').closing = false;
									Ext.getCmp('s4.input').show();
									Ext.getCmp('s4.input').setTitle('Customer - Tambah');
									Ext.getCmp('s4.input.f1').focus();
									Ext.getCmp('s4.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s4.list').setLoading(false);
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
		            	Ext.getCmp('s4.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('s4.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/s4/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('s4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('s4.search').show();
									Ext.getCmp('s4.search.f1').focus();
								}
								
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s4.list').setLoading(false);
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
		{ text: 'Nama Customer',width: 150, dataIndex: 'f1' },
		{ text: 'Nama Code',width: 150, dataIndex: 'f2' },
		{
			text: 'Update',
			width: 55,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('s4.list').setLoading('Mengambil Customer '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/s4/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('s4.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('s4.input.panel').qReset();
							Ext.getCmp('s4.input.i').setValue(record.data.i);
							Ext.getCmp('s4.input.f1').setValue(o.f1);
							Ext.getCmp('s4.input.f2').setValue(o.f2);
							Ext.getCmp('s4.input.p').setValue('UPDATE');
							Ext.getCmp('s4.input').closing = false;
							Ext.getCmp('s4.input').setTitle('Customer - Ubah');
							Ext.getCmp('s4.input').show();
							Ext.getCmp('s4.input.f1').focus();
							Ext.getCmp('s4.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('s4.list').setLoading(false);
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
				Ext.getCmp('s4.confirm').confirm({
					msg : "Are you sure Delete Customer '"+record.raw.f1+"' ?",
					allow : 's4.delete',
					onY : function() {
						Ext.getCmp('s4.list').setLoading('Deleting Customer '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/s4/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('s4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('s4.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('s4.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});