Ext.define('App.system.a9.List',{
	extend:'App.cmp.Table',
	id:'a9.list',
	params:function(){
		return Ext.getCmp('a9.search.panel').qParams();
	},
	url:url + 'app/a9/getList',
	result:function(response){
		if(session.tenant == null)
			Ext.getCmp('a9.list').columns[1].setVisible(true);
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
		            text: 'Add Template',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a9.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/a9/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a9.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a9.input.panel').qReset();
									Ext.getCmp('a9.input.f1').enable();
									Ext.getCmp('a9.input.f3').addReset(r.data.l);
									Ext.getCmp('a9.input.f4').addReset(r.data.l1);
									Ext.getCmp('a9.input.p').setValue('ADD');
									Ext.getCmp('a9.input').closing = false;
									Ext.getCmp('a9.input').show();
									Ext.getCmp('a9.input').setTitle('PDF Template - Add');
									if(r.data.tl != undefined){
										Ext.getCmp('a9.label.t').show();
										r.data.tl.unshift ({id:'',text:'Owner'});
										Ext.getCmp('a9.input.t').addReset(r.data.tl);
										Ext.getCmp('a9.input.t').setValue('');
										Ext.getCmp('a9.input.t').enable();
										Ext.getCmp('a9.input.t').focus();
									}else{
										Ext.getCmp('a9.input.t').setValue(session.tenant);
										Ext.getCmp('a9.label.t').hide();
										Ext.getCmp('a9.input.f1').focus();
									}
									Ext.getCmp('a9.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a9.list').setLoading(false);
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
		            	Ext.getCmp('a9.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a9.list').setLoading('Getting List');
						Ext.Ajax.request({
							url : url + 'app/a9/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a9.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a9.search.f5').addReset(r.data.l);
									Ext.getCmp('a9.search').show();
									Ext.getCmp('a9.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a9.list').setLoading(false);
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
		{ text: 'Template Code',width: 120, dataIndex: 'f1' },
		{ text: 'Template Name',width: 200,dataIndex: 'f2'},
		{ text: 'Paper Type',width: 150,dataIndex: 'f3' },
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
				Ext.getCmp('a9.list').setLoading('Getting Template Code '+record.data.f1);
				Ext.Ajax.request({
					url : url + 'app/a9/initUpdate',
					params:{i:record.data.i},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('a9.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.o;
							Ext.getCmp('a9.input.panel').qReset();
							Ext.getCmp('a9.input.f3').addReset(r.data.l);
							Ext.getCmp('a9.input.f4').addReset(r.data.l1);
							Ext.getCmp('a9.label.t').hide();
							Ext.getCmp('a9.input.f1').disable();
							Ext.getCmp('a9.input.i').setValue(record.data.i);
							if(o.f3=='PDF_CUSTOM'){
								Ext.getCmp('a9.input.f5').enable();
								Ext.getCmp('a9.input.f6').enable();
							}else{
								Ext.getCmp('a9.input.f5').disable();
								Ext.getCmp('a9.input.f6').disable();
							}
							Ext.getCmp('a9.input.f1').setValue(o.f1);
							Ext.getCmp('a9.input.f2').setValue(o.f2);
							Ext.getCmp('a9.input.f3').setValue(o.f3);
							Ext.getCmp('a9.input.f4').setValue(o.f4);
							Ext.getCmp('a9.input.f5').setValue(o.f5);
							Ext.getCmp('a9.input.f6').setValue(o.f6);
							Ext.getCmp('a9.input.f7').setValue(o.f7);
							Ext.getCmp('a9.input.f8').setValue(o.f8);
							Ext.getCmp('a9.input.f9').setValue(o.f9);
							Ext.getCmp('a9.input.f10').setValue(o.f10);
							Ext.getCmp('a9.input.f11').setValue(o.f11);
							Ext.getCmp('a9.input.f12').setValue(o.f12);
							Ext.getCmp('a9.input.p').setValue('UPDATE');
							Ext.getCmp('a9.input').closing = false;
							Ext.getCmp('a9.input').setTitle('PDF Template - Update');
							Ext.getCmp('a9.input').show();
							Ext.getCmp('a9.input.f2').focus();
							Ext.getCmp('a9.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a9.list').setLoading(false);
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
				Ext.getCmp('a9.confirm').confirm({
					msg : "Are you sure Delete Template Code '"+record.raw.f1+"' ?",
					allow : 'a9.delete',
					onY : function() {
						Ext.getCmp('a9.list').setLoading('Deleting Template Code '+record.raw.f1);
						Ext.Ajax.request({
							url : url + 'app/a9/delete',
							method : 'POST',
							params : {
								i : record.raw.i
							},
							success : function(response) {
								Ext.getCmp('a9.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('a9.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a9.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
		
	]
});