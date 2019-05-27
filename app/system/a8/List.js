Ext.define('App.system.a8.List',{
	extend:'App.cmp.Table',
	id:'a8.list',
	params:function(){
		return Ext.getCmp('a8.search.panel').qParams();
	},
	url:url + 'app/a8/getList',
	result:function(response){
		if(session.tenant == null)
			Ext.getCmp('a8.list').columns[1].setVisible(true);
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
		            text: 'Add Sequence',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a8.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/a8/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a8.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a8.input.panel').qReset();
									Ext.getCmp('a8.input.f1').enable();
									Ext.getCmp('a8.input.p').setValue('ADD');
									Ext.getCmp('a8.input.f6').addReset(r.data.l);
									Ext.getCmp('a8.input').closing = false;
									Ext.getCmp('a8.input').show();
									Ext.getCmp('a8.input').setTitle('Sequence - Add');
									if(r.data.tl != undefined){
										Ext.getCmp('a8.label.t').show();
										r.data.tl.unshift ({id:'',text:'Owner'});
										Ext.getCmp('a8.input.t').addReset(r.data.tl);
										Ext.getCmp('a8.input.t').setValue('');
										Ext.getCmp('a8.input.t').enable();
										Ext.getCmp('a8.input.t').focus();
									}else{
										Ext.getCmp('a8.input.t').setValue(session.tenant);
										Ext.getCmp('a8.label.t').hide();
										Ext.getCmp('a8.input.f1').focus();
									}
									Ext.getCmp('a8.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a8.list').setLoading(false);
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
		            	Ext.getCmp('a8.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a8.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/a8/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a8.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a8.search.f5').addReset(r.data.l);
									Ext.getCmp('a8.search.f3').addReset(r.data.l1);
									Ext.getCmp('a8.search').show();
									Ext.getCmp('a8.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a8.list').setLoading(false);
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
		{ text: 'Tenant',hideable:false,width: 150,sortable :false,hidden:true, dataIndex: 't' },
		{ hidden:true, hideable:false,dataIndex: 'i' },
		{ text: 'Sequence Code',width: 120, dataIndex: 'f1' },
		{ text: 'Sequence Name',width: 200,dataIndex: 'f2'},
		{ text: 'Last Value',width: 150,dataIndex: 'f3' },
		{ text: 'Repeat Type',width: 150,dataIndex: 'f6' },
		{ text: 'Format',flex:1,dataIndex: 'f4' },
		{ text: 'Active',width: 50,sortable :false,dataIndex: 'f5',align:'center',
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
				Ext.getCmp('a8.list').setLoading('Getting Sequence Code '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/a8/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('a8.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('a8.label.t').hide();
							Ext.getCmp('a8.input.panel').qReset();
							Ext.getCmp('a8.input.f1').disable();
							Ext.getCmp('a8.input.f6').addReset(r.data.l);
							Ext.getCmp('a8.input.i').setValue(record.data.i);
							Ext.getCmp('a8.input.f1').setValue(o.f1);
							Ext.getCmp('a8.input.f2').setValue(o.f2);
							Ext.getCmp('a8.input.f3').setValue(o.f3);
							Ext.getCmp('a8.input.f4').setValue(o.f4);
							Ext.getCmp('a8.input.f5').setValue(o.f5);
							Ext.getCmp('a8.input.f6').setValue(o.f6);
							Ext.getCmp('a8.input.f7').setValue(o.f7);
							Ext.getCmp('a8.input.p').setValue('UPDATE');
							Ext.getCmp('a8.input').closing = false;
							Ext.getCmp('a8.input').setTitle('Sequence - Update');
							Ext.getCmp('a8.input').show();
							Ext.getCmp('a8.input.f2').focus();
							Ext.getCmp('a8.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a8.list').setLoading(false);
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
				Ext.getCmp('a8.confirm').confirm({
					msg : "Are you sure Delete Sequence Code '"+record.raw.f1+"' ?",
					allow : 'a8.delete',
					onY : function() {
						Ext.getCmp('a8.list').setLoading('Deleting data Sequence Code '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/a8/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('a8.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('a8.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a8.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
		
	]
});