Ext.define('App.system.a10.List',{
	extend:'App.cmp.Table',
	id:'a10.list',
	params:function(){
		return Ext.getCmp('a10.search.panel').qParams();
	},
	url:url + 'app/a10/getList',
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
						Ext.getCmp('a10.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/a10/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a10.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a10.input.panel').qReset();
									Ext.getCmp('a10.input.f2').setFoto(null);
									Ext.getCmp('a10.input.p').setValue('ADD');
									Ext.getCmp('a10.input').closing = false;
									Ext.getCmp('a10.input').show();
									Ext.getCmp('a10.input').setTitle('Banner - Add');
									Ext.getCmp('a10.input.f1').focus();
									Ext.getCmp('a10.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a10.list').setLoading(false);
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
		            	Ext.getCmp('a10.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a10.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/a10/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a10.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a10.search').show();
									Ext.getCmp('a10.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a10.list').setLoading(false);
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
		{ text: 'Judul',width: 200, dataIndex: 'f1' },
		{ text: 'Gambar',dataIndex: 'f2',flex: 1,
			renderer: function(value){
				return '<img src="'+url+'upload/' + value + '" style="margin: -5px;width:300px;" />';
			}
		},
		{
			text: 'Update',
			width: 50,
			hideable:false,
			menuDisabled: true,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a10.list').setLoading('Getting Banner '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/a10/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('a10.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('a10.input.panel').qReset();
							Ext.getCmp('a10.input.i').setValue(record.data.i);
							Ext.getCmp('a10.input.f1').setValue(o.f1);
							Ext.getCmp('a10.input.f2').setFoto(o.f2);
							Ext.getCmp('a10.input.p').setValue('UPDATE');
							Ext.getCmp('a10.input').closing = false;
							Ext.getCmp('a10.input').setTitle('Banner - Update');
							Ext.getCmp('a10.input').show();
							Ext.getCmp('a10.input.f1').focus();
							Ext.getCmp('a10.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a10.list').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		},{
			text: 'Delete',
			width: 50,
			hideable:false,
			menuDisabled: true,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-del',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a10.confirm').confirm({
					msg : "Are you sure Delete Banner '"+record.raw.f1+"' ?",
					allow : 'a10.delete',
					onY : function() {
						Ext.getCmp('a10.list').setLoading('Deleting Banner '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/a10/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('a10.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('a10.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a10.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});