function initRujukanBalik(id){
	Ext.getCmp('rs3.list').setLoading('Loading');
	Ext.Ajax.request({
		url : url + 'app/rs3/initRujukBalik',
		params:{i:id},
		method : 'GET',
		success : function(response) {
			Ext.getCmp('rs3.list').setLoading(false);
			var r = ajaxSuccess(response);
			if (r.result == 'SUCCESS') {
				var o=r.data.o;
				Ext.getCmp('rs3.input.panel').qReset();
				Ext.getCmp('rs3.input.f1').setValue(id);
				Ext.getCmp('rs3.input.f9').setValue(Ext.getCmp('rs3.list').dataRow.f7);
				Ext.getCmp('rs3.input').closing=false;
				Ext.getCmp('rs3.input').show();
				Ext.getCmp('rs3.input.panel').qSetForm();
				Ext.getCmp('rs3.input.f2').focus();
			}
		},
		failure : function(jqXHR, exception) {
			Ext.getCmp('rs3.list').setLoading(false);
			ajaxError(jqXHR, exception);
		}
	});
}
function initVerifikasi(id){
	Ext.getCmp('rs3.list').setLoading('Loading');
	Ext.Ajax.request({
		url : url + 'app/rs3/initVerifikasi',
		params:{i:id},
		method : 'GET',
		success : function(response) {
			Ext.getCmp('rs3.list').setLoading(false);
			var r = ajaxSuccess(response);
			if (r.result == 'SUCCESS') {
				var o=r.data.o;
				Ext.getCmp('rs3.verifikasi.panel').qReset();
				Ext.getCmp('rs3.verifikasi.i').setValue(id);
				Ext.getCmp('rs3.verifikasi.d1').setValue(o.d1);
				Ext.getCmp('rs3.verifikasi.d2').setValue(o.d2);
				Ext.getCmp('rs3.verifikasi.d3').setValue(o.d3);
				Ext.getCmp('rs3.verifikasi.d4').setValue(o.d4);
				Ext.getCmp('rs3.verifikasi.d5').setValue(o.d5);
				Ext.getCmp('rs3.verifikasi.d6').setValue(o.d6);
				Ext.getCmp('rs3.verifikasi.d7').setValue(o.d7);
				Ext.getCmp('rs3.verifikasi.d8').setValue(o.d8);
				Ext.getCmp('rs3.verifikasi.d9').setValue(o.d9);
				Ext.getCmp('rs3.verifikasi.d10').setValue(o.d10);
				Ext.getCmp('rs3.verifikasi.f2').disable();
				Ext.getCmp('rs3.verifikasi.f1').addReset(r.data.l)
				Ext.getCmp('rs3.verifikasi').closing=false;
				Ext.getCmp('rs3.verifikasi').show();
				Ext.getCmp('rs3.verifikasi.panel').qSetForm();
//				Ext.getCmp('rs3.input.f2').focus();
			}
		},
		failure : function(jqXHR, exception) {
			Ext.getCmp('rs3.list').setLoading(false);
			ajaxError(jqXHR, exception);
		}
	});
}
Ext.define('App.content.rs3.List',{
	extend:'App.cmp.Table',
	id:'rs3.list',
	params:function(){
		return Ext.getCmp('rs3.search.panel').qParams();
	},
	url:url + 'app/rs3/getList',
	result:function(response){
		return {list:response.data,total:response.total};
	},
	onSelect:function(view, cell, cellIndex, record, row, rowIndex, e){
		if(record.data.f9=='STATRUJ_OK'){
			Ext.getCmp('rs3.btnRujukBalik').enable();
		}else{
			Ext.getCmp('rs3.btnRujukBalik').disable();
		}
		if(record.data.f9=='STATRUJ_NONE'){
			Ext.getCmp('rs3.btnVerifikasi').enable();
		}else{
			Ext.getCmp('rs3.btnVerifikasi').disable();
		}
	},
	onNotSelect:function(){
		Ext.getCmp('rs3.btnRujukBalik').disable();
		Ext.getCmp('rs3.btnVerifikasi').disable();
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
		            text: 'Refresh',
		            scale: 'large',
		            iconCls: 'i-refresh-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	Ext.getCmp('rs3.list').refresh(false);
					}
		        },{
		            text: 'Search',
		            scale: 'large',
		            iconCls: 'i-search-large',
		            iconAlign: 'top',
		            handler:function(a){
						Ext.getCmp('rs3.list').setLoading('Getting Params');
						Ext.Ajax.request({
							url : url + 'app/rs3/initSearch',
							method : 'GET',
							success : function(response) {
								Ext.getCmp('rs3.list').setLoading(false);
								var r = ajaxSuccess(response);
								if (r.result == 'SUCCESS') {
									Ext.getCmp('rs3.search').show();
									Ext.getCmp('rs3.search.f1').focus();
								}
							},
							failure : function(jqXHR, exception) {
								Ext.getCmp('rs3.list').setLoading(false);
								ajaxError(jqXHR, exception);
							}
						});
					}
		        }]
		    },{
		        xtype: 'buttongroup',
		        columns: 2,
		        title: 'Action Menu',
		        items: [{
		            text: 'Rujuk Balik',
		            scale: 'large',
		            disabled:true,
		            id:'rs3.btnRujukBalik',
		            iconCls: 'i-back-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	initRujukanBalik(Ext.getCmp('rs3.list').dataRow.f1);
					}
		        },{
		            text: 'Verifikasi',
		            scale: 'large',
		            disabled:true,
		            id:'rs3.btnVerifikasi',
		            iconCls: 'i-verified-large',
		            iconAlign: 'top',
		            handler : function(a) {
		            	initVerifikasi(Ext.getCmp('rs3.list').dataRow.i);
					}
		        }]
		    },'->',
		    {
		        xtype: 'buttongroup',
		        columns: 1,
		        width: 250,
		        title: 'Info Rujukan Balik',
		        bodyStyle:'padding-left: 10px;',
		        items: [
					new Ext.create('App.cmp.Input',{
						label:'*)',
						xWidth: 10,
						separator:'',
						items:[
							new Ext.form.DisplayField({
								   value:'- Bisa dilakukan jika status terverifikasi.'
							})
						]
					}),
					new Ext.create('App.cmp.Input',{
						label:'',
						xWidth: 20,
						separator:'',
						items:[
							new Ext.form.DisplayField({
								   value:''
							})
						]
					})
		         ]
		    }]
		}) 
	],
	columns:[
		{ xtype: 'rownumberer'},
		{ hidden:true,hideable:false,dataIndex: 'i' },
		{ hidden:true,hideable:false,dataIndex: 'f7' },
		{ hidden:true,hideable:false,dataIndex: 'f9' },
		{ text: 'No. Rujukan',width: 150,dataIndex: 'f1',align:'center'  },
		{ text: 'Faskes',width: 200,dataIndex: 'f2'},
		{ text: 'Nama Pasien',width: 200,dataIndex: 'f3'},
		{ text: 'Verifikasi',width: 150,dataIndex: 'f4',sortable:false},
		{ text: 'Dokter RS',width: 150,dataIndex: 'f8' },
		{ text: 'Tgl. Rujuk', width: 100,dataIndex: 'f5',align:'center'  },
		{ text: 'Diagnosa', dataIndex: 'f6',flex:1},
		{
			text: 'Rujuk Balik',
			width: 80,
			menuDisabled: true,
			hideable:false,
			xtype: 'actioncolumn',
			align: 'center',
			iconCls: 'i-add',
			handler: function(grid, rowIndex, colIndex, actionItem, event, record, row) {
				initRujukanBalik(record.data.f1);
			},
			isDisabled : function(view, rowIdx, colIdx, item, record) {
				if(record.data.f9=='STATRUJ_OK'){
					return false;
				}else{
					return true;
				}
			}
		}
	]
});