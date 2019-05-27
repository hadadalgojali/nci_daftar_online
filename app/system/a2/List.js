Ext.define('App.system.a2.List', {
	extend : 'Ext.tree.Panel',
	xtype : 'filtered-tree',
	id : 'a2.list',
	border : false,
	rootVisible : false,
	lines : true,
	rowLines : true,
	root : {
		expanded : true
	},
	tbar : [
		Ext.create('Ext.panel.Panel', {
		    flex: 1,
		    border:false,
		    tbar: [{
		        xtype: 'buttongroup',
		        columns: 2,
		        title: 'Menu',
		        items: [{
		            text: 'Add Menu',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler : function(a) {
						Ext.getCmp('main.tabA2').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/A2/doInput',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('main.tabA2').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a2.input.menuType').addReset(r.data.menuTypeList);
									Ext.getCmp('a2.input').closing = false;
									Ext.getCmp('a2.input.panel').qReset();
									Ext.getCmp('a2.input.menuCommand').disable();
									Ext.getCmp('a2.input.menuCommand').setValue('-');
									Ext.getCmp('a2.input.menuCode').enable();
									Ext.getCmp('a2.input.menuType').enable();
									Ext.getCmp('a2.input.activeFlag').setValue(true);
									Ext.getCmp('a2.input.pageType').setValue('ADD');
									Ext.getCmp('a2.input.panel').qSetForm();
									Ext.getCmp('a2.input').show();
									Ext.getCmp('a2.input').setTitle('Menu - Add');
									Ext.getCmp('a2.input.menuCode').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('main.tabA2').setLoading(false);
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
						Ext.getCmp('main.tabA2').setLoading('Loading');
						Ext.Ajax.request({
							url : url + 'app/A2/getList',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('main.tabA2').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a2.list').store.setRootNode([]);
									var c = Ext.getCmp('a2.list').store.getRootNode();
									c.insertChild(1, r.data);
									Ext.getCmp('a2.list').expandAll()
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('main.tabA2').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    }]
		})    
	],
	columns : [
		{
			xtype : 'treecolumn',
			text : 'Menu Name',
			flex : 1,
			dataIndex : 'text'
		}, {
			text : 'Add',
			width : 55,
			hideable:false,
			menuDisabled : true,
			xtype : 'actioncolumn',
			align : 'center',
			iconCls : 'i-add',
			handler : function(grid, rowIndex, colIndex, actionItem, event,record, row) {
				Ext.getCmp('main.tabA2').setLoading('Getting Params');
				Ext.Ajax.request({
					url : url + 'app/A2/doInput',
					method : 'GET',
					success : function(response) {
						Ext.getCmp('main.tabA2').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							Ext.getCmp('a2.input.panel').qReset();
							Ext.getCmp('a2.input.parentCode').setValue(record.raw.menu_code);
							Ext.getCmp('a2.input.menuType').addReset(r.data.menuTypeList);
							Ext.getCmp('a2.input').closing = false;
							Ext.getCmp('a2.input.menuCommand').disable();
							Ext.getCmp('a2.input.menuCommand').setValue('-');
							Ext.getCmp('a2.input.menuCode').enable();
							Ext.getCmp('a2.input.menuType').enable();
							Ext.getCmp('a2.input.activeFlag').setValue(true);
							Ext.getCmp('a2.input.pageType').setValue('ADD');
							Ext.getCmp('a2.input.panel').qSetForm();
							Ext.getCmp('a2.input').show();
							Ext.getCmp('a2.input').setTitle('Menu - Add');
							Ext.getCmp('a2.input.menuCode').focus();
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('main.tabA2').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			},
			isDisabled : function(view, rowIdx, colIdx, item, record) {
				return record.data.leaf;
			}
		}, {
			text : 'Update',
			width : 55,
			menuDisabled : true,
			xtype : 'actioncolumn',
			align : 'center',
			hideable:false,
			iconCls : 'i-edit',
			handler : function(grid, rowIndex, colIndex, actionItem, event,record, row) {
				Ext.getCmp('main.tabA2').setLoading('Getting Data Menu Code '+record.raw.menu_code);
				Ext.Ajax.request({
					url : url + 'app/A2/initUpdate',
					method : 'GET',
					params:{pid:record.raw.menu_code},
					success : function(response) {
						Ext.getCmp('main.tabA2').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							Ext.getCmp('a2.input.panel').qReset();
							var o=r.data.menu;
							Ext.getCmp('a2.input.parentCode').setValue(record.raw.menu_code);
							Ext.getCmp('a2.input.menuType').addReset(r.data.menuTypeList);
							Ext.getCmp('a2.input').closing = false;
							Ext.getCmp('a2.input.menuCode').disable();
							Ext.getCmp('a2.input.menuCode').setValue(o.menuCode);
							Ext.getCmp('a2.input.menuName').setValue(o.menuName);
							Ext.getCmp('a2.input.menuType').setValue(o.menuType);
							if(o.menuType=='MENUTYPE_FOLDER'){
								Ext.getCmp('a2.input.menuCommand').disable();
							}else{
								Ext.getCmp('a2.input.menuCommand').enable();
							}
							Ext.getCmp('a2.input.menuCommand').setValue(o.menuCommand);
							if(o.child>0){
								Ext.getCmp('a2.input.menuType').disable();
							}else{
								Ext.getCmp('a2.input.menuType').enable();
							}
							Ext.getCmp('a2.input.activeFlag').setValue(o.activeFlag);
							Ext.getCmp('a2.input.systemFlag').setValue(o.systemFlag);
							Ext.getCmp('a2.input.adminFlag').setValue(o.adminFlag);
							Ext.getCmp('a2.input.windowFlag').setValue(o.windowFlag);
							Ext.getCmp('a2.input.pageType').setValue('UPDATE');
							Ext.getCmp('a2.input.panel').qSetForm();
							Ext.getCmp('a2.input').show();
							Ext.getCmp('a2.input').setTitle('Menu - Update');
							Ext.getCmp('a2.input.menuName').focus();
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('main.tabA2').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		}, {
			text : 'Delete',
			width : 55,
			menuDisabled : true,
			xtype : 'actioncolumn',
			align : 'center',
			iconCls : 'i-del',
			handler : function(grid, rowIndex, colIndex, actionItem, event,record, row) {
				Ext.getCmp('a2.confirm').confirm({
					msg : "Are you sure Delete Menu Code '"+record.raw.menu_code+"' ?",
					allow : 'a2.delete',
					onY : function() {
						Ext.getCmp('main.tabA2').setLoading('Deleting Data Menu Code '+record.raw.menu_code);
						Ext.Ajax.request({
							url : url + 'app/A2/delete',
							method : 'POST',
							params : {
								menuCode : record.raw.menu_code
							},
							success : function(response) {
								Ext.getCmp('main.tabA2').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('main.tabA2').setLoading('Loading');
									Ext.Ajax.request({
										url : url + 'app/A2/getList',
										method : 'GET',
										success : function(response) {
											Ext.getCmp('main.tabA2').setLoading(false);
											var r = ajaxSuccess(response);
											if (r.result == 'SUCCESS') {
												Ext.getCmp('a2.list').store.setRootNode([]);
												var c = Ext.getCmp('a2.list').store.getRootNode();
												c.insertChild(1, r.data);
												Ext.getCmp('a2.list').expandAll()
											}
										},
										failure : function(jqXHR, exception) {
											Ext.getCmp('main.tabA2').setLoading(false);
											ajaxError(jqXHR, exception);
										}
									});
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('main.tabA2').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			},
			isDisabled : function(view, rowIdx, colIdx, item, record) {
				return record.raw.deleted;
			}
		}
	],
	constructor : function(a) {
		this.callParent(arguments);
	},
	initComponent : function(a) {
		this.callParent(arguments);
		Ext.Ajax.request({
			url : url + 'app/A2/getList',
			method : 'GET',
			success : function(response) {
				Ext.getCmp('main.tabA2').setLoading(false);
				var r = ajaxSuccess(response);
				if (r.result == 'SUCCESS') {
					Ext.getCmp('a2.list').store.setRootNode([]);
					var c = Ext.getCmp('a2.list').store.getRootNode();
					c.insertChild(1, r.data);
					Ext.getCmp('a2.list').expandAll();
				}
			},
			failure : function(jqXHR, exception) {
				Ext.getCmp('main.tabA2').setLoading(false);
				ajaxError(jqXHR, exception);
			}
		});
	}
});