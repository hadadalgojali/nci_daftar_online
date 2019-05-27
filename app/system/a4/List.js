Ext.define('App.system.a4.List',{
	extend:'App.cmp.Table',
	id:'a4.list',
	params:function(){
		return Ext.getCmp('a4.search.panel').qParams();
	},
	url:url + 'app/a4/getList',
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
		            text: 'Add Param',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a4.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/a4/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a4.input.tableOption').resetTable();
									Ext.getCmp('a4.input.panel').qReset();
									Ext.getCmp('a4.input.parameterCode').enable();
									Ext.getCmp('a4.input.pageType').setValue('ADD');
									Ext.getCmp('a4.input').closing = false;
									Ext.getCmp('a4.input').show();
									Ext.getCmp('a4.input').setTitle('Parameter - Add');
									Ext.getCmp('a4.input.parameterCode').focus();
									Ext.getCmp('a4.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a4.list').setLoading(false);
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
		            	Ext.getCmp('a4.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a4.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/a4/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a4.search.f4').addReset(r.data.l);
									Ext.getCmp('a4.search').show();
									Ext.getCmp('a4.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a4.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    },{
		        xtype: 'buttongroup',
		        columns: 2,
		        title: 'Export',
		        items: [{
		            text: 'To PDF',
		            scale: 'large',
		            iconCls: 'i-export-pdf',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a4.report').toPDF();
					}
		        },{
		            text: 'To Excel',
		            scale: 'large',
		            iconCls: 'i-excel-large',
		            iconAlign: 'top',
		            handler:function(a){
						window.open(url+'app/a4/toExcel?f1='+Ext.getCmp('a4.search.f1').getValue()+'&f2='+Ext.getCmp('a4.search.f2').getValue()+'&f3='+Ext.getCmp('a4.search.f3').getValue()+'&f4='+Ext.getCmp('a4.search.f4').getValue());
					}
		        }]
		    }]
		})
	],
	columns:[
		{ xtype: 'rownumberer'},
		{ text: 'Parameter Code',width: 120, dataIndex:'f1'},
		{ text: 'Parameter Name',width: 150,dataIndex:'f2'},
		{ text: 'Resume',flex: 1, dataIndex:'f3'},
		{ hidden:true,hideable:false,dataIndex: 'f5' },
		{ text: 'Active', width: 50,sortable :false,dataIndex: 'f4',align:'center',
			renderer: function(value){
				if(value==true)
					return '<img src="' + icon('t') + '" style="margin: -5px;" />';
				else
					return '<img src="' + icon('f') + '" style="margin: -5px;" />';
			}
		},{
			text: 'Update',
			width: 55,
			hideable:false,
			menuDisabled: true,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a4.list').setLoading("Getting data Parameter Code "+record.data.f1+"");
				Ext.Ajax.request({
					url : url + 'app/a4/initUpdate',
					params:{i:record.data.f1},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('a4.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('a4.input.panel').qReset();
							Ext.getCmp('a4.input.tableOption').setVal(r.data.l);
							Ext.getCmp('a4.input.parameterCode').disable();
							Ext.getCmp('a4.input.parameterCode').setValue(o.f1);
							Ext.getCmp('a4.input.parameterName').setValue(o.f2);
							Ext.getCmp('a4.input.description').setValue(o.f3);
							Ext.getCmp('a4.input.activeFlag').setValue(o.f4);
							Ext.getCmp('a4.input.systemFlag').setValue(o.f5);
							Ext.getCmp('a4.input.pageType').setValue('UPDATE');
							Ext.getCmp('a4.input').closing = false;
							Ext.getCmp('a4.input').setTitle('Parameter - Update');
							Ext.getCmp('a4.input').show();
							Ext.getCmp('a4.input.parameterName').focus();
							Ext.getCmp('a4.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a4.list').setLoading(false);
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
				Ext.getCmp('a4.confirm').confirm({
					msg : "Are you sure Delete data Parameter Code '"+record.raw.f1+"' ?",
					allow : 'a4.delete',
					onY : function() {
						Ext.getCmp('a4.list').setLoading("Deleting data Parameter Code "+record.raw.f1+"");
						Ext.Ajax.request({
							url : url + 'app/a4/delete',
							method : 'POST',
							params : {
								i : record.raw.f1
							},
							success : function(response) {
								Ext.getCmp('a4.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('a4.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a4.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			},
			isDisabled : function(view, rowIdx, colIdx, item, record) {
				if(record.data.f5==true)
					return true;
				else
					return false;
			}
		}
	]
});