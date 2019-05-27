Ext.define('App.system.a5.List',{
	extend:'App.cmp.Table',
	id:'a5.list',
	params:function(){
		return Ext.getCmp('a5.search.panel').qParams();
	},
	url:url + 'app/a5/getList',
	result:function(response){
		if(session.tenant == null)
			Ext.getCmp('a5.list').columns[1].setVisible(true);
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
		            text: 'Add Emp',
		            scale: 'large',
		            iconCls: 'i-add-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a5.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/a5/initAdd',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a5.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a5.input.panel').qReset();
									Ext.getCmp('a5.input.foto').setNull();
									Ext.getCmp('a5.input.number').enable();
									Ext.getCmp('a5.input.gender').addReset(r.data.genderList);
									Ext.getCmp('a5.input.religion').addReset(r.data.religionList);
									Ext.getCmp('a5.input.job').addReset(r.data.jobList);
									Ext.getCmp('a5.input.pageType').setValue('ADD');
									Ext.getCmp('a5.input.activeFlag').setValue(true);
									Ext.getCmp('a5.input').closing = false;
									Ext.getCmp('a5.input').show();
									Ext.getCmp('a5.input').setTitle('Employee - Add');
									if(r.data.tenantList != undefined){
										Ext.getCmp('a5.label.tenant').show();
										r.data.tenantList.unshift ({id:'',text:'Owner'});
										Ext.getCmp('a5.input.tenant').addReset(r.data.tenantList);
										Ext.getCmp('a5.input.tenant').setValue('');
										Ext.getCmp('a5.input.tenant').enable();
										Ext.getCmp('a5.input.tenant').focus();
									}else{
										Ext.getCmp('a5.input.tenant').setValue(session.tenant);
										Ext.getCmp('a5.label.tenant').hide();
										Ext.getCmp('a5.input.number').focus();
									}
									Ext.getCmp('a5.input.panel').qSetForm();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a5.list').setLoading(false);
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
		            	Ext.getCmp('a5.list').refresh();
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('a5.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/a5/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('a5.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('a5.search.srchActiveFlag').addReset(r.data.l);
									Ext.getCmp('a5.search.f3').addReset(r.data.l1);
									Ext.getCmp('a5.search').show();
									Ext.getCmp('a5.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a5.list').setLoading(false);
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
		{ text: 'Tenant',width: 150, hideable:false,sortable :false,hidden:true, dataIndex: 't'},
		{ hidden:true,hideable:false,dataIndex: 'pid' },
		{ text: 'ID Number',width: 100, dataIndex: 'f1' },
		{ text: 'Name',width: 200,dataIndex: 'f2'},
		{ text: 'Gender',width: 100,align:'center', dataIndex:'f3' },
		{ text: 'Birth Date',width: 100,align:'center', dataIndex: 'f4' },
		{ text: 'Job',width: 100,dataIndex: 'f6' },
		{ text: 'Address',width: 100,dataIndex: 'f7',flex:1 },
		{ text: 'Active',width: 50,sortable :false,dataIndex: 'f5',align:'center',
			renderer: function(value){
				if(value==true)
					return '<img src="' + icon('t') + '" style="margin: -5px;" />';
				else
					return '<img src="' + icon('f') + '" style="margin: -5px;" />';
			}
		},{
			text: 'Update',
			width: 50,
			hideable:false,
			menuDisabled: true,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-edit',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				Ext.getCmp('a5.list').setLoading('Getting Employee IdNumber '+record.data.f2);
				Ext.Ajax.request({
					url : url + 'app/a5/initUpdate',
					params:{pid:record.data.pid},
					method : 'GET',
					success : function(response) {
						Ext.getCmp('a5.list').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var o=r.data.employee;
							if(o.foto != undefined)
								Ext.getCmp('a5.input.foto').setFoto(o.foto);
							else
								Ext.getCmp('a5.input.foto').setNull();
							Ext.getCmp('a5.label.tenant').hide();
							Ext.getCmp('a5.input.number').disable();
							Ext.getCmp('a5.input.gender').addReset(r.data.genderList);
							Ext.getCmp('a5.input.religion').addReset(r.data.religionList);
							Ext.getCmp('a5.input.job').addReset(r.data.jobList);
							Ext.getCmp('a5.input.panel').qReset();
							Ext.getCmp('a5.input.number').setValue(o.idNumber);
							Ext.getCmp('a5.input.firstName').setValue(o.firstName);
							Ext.getCmp('a5.input.secondName').setValue(o.secondName);
							Ext.getCmp('a5.input.lastName').setValue(o.lastName);
							Ext.getCmp('a5.input.gender').setValue(o.gender);
							Ext.getCmp('a5.input.religion').setValue(o.religion);
							Ext.getCmp('a5.input.birthPlace').setValue(o.birthPlace);
							Ext.getCmp('a5.input.birthDate').setValue(o.birthDate);
							Ext.getCmp('a5.input.address').setValue(o.address);
							Ext.getCmp('a5.input.email').setValue(o.emailAddress);
							Ext.getCmp('a5.input.phone1').setValue(o.phoneNumber1);
							Ext.getCmp('a5.input.phone2').setValue(o.phoneNumber2);
							Ext.getCmp('a5.input.fax1').setValue(o.faxNumber1);
							Ext.getCmp('a5.input.fax2').setValue(o.faxNumber2);
							Ext.getCmp('a5.input.pid').setValue(record.data.pid);
							Ext.getCmp('a5.input.job').setValue(o.job);
							Ext.getCmp('a5.input.activeFlag').setValue(o.activeFlag);
							Ext.getCmp('a5.input.pageType').setValue('UPDATE');
							Ext.getCmp('a5.input').closing = false;
							Ext.getCmp('a5.input').setTitle('Employee - Update');
							Ext.getCmp('a5.input').show();
							Ext.getCmp('a5.input.firstName').focus();
							Ext.getCmp('a5.input.panel').qSetForm()
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('a5.list').setLoading(false);
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
				Ext.getCmp('a5.confirm').confirm({
					msg : "Are you sure Delete Employee ID Number '"+record.raw.f2+"' ?",
					allow : 'a5.delete',
					onY : function() {
						Ext.getCmp('a5.list').setLoading('Deleting Employee ID Number '+record.raw.f2);
						Ext.Ajax.request({
							url : url + 'app/a5/delete',
							method : 'POST',
							params : {
								pid : record.raw.pid
							},
							success : function(response) {
								Ext.getCmp('a5.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS')
									Ext.getCmp('a5.list').refresh();
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('a5.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
				});
			}
		}
	]
});