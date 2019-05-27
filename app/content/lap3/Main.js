Ext.define('App.content.lap3.Main',{
	extend : 'App.cmp.WindowMain',
	iconCls:'i-lap',
	id:'lap3',
	title:'Laporan Perbandingan Pendaftaran',
	fbar: [{
		text: 'Grafik',
		iconCls:'i-chart',
		id:'lap3.btnCetak',
		handler: function() {
			var req=Ext.getCmp('lap3.panel').qGetForm(true);
			if(req==false || req==true){
				Ext.getCmp('lap3.panel').setLoading('Mengambil Data.');
				Ext.Ajax.request({
					url : url + 'app/lap3/getPerbandingan',
					method : 'GET',
					params:Ext.getCmp('lap3.panel').qParams(),
					success : function(response) {
						Ext.getCmp('lap3.panel').setLoading(false);
						var r = ajaxSuccess(response);
						if (r.result == 'SUCCESS') {
							var store=Ext.create('Ext.data.JsonStore', {
							    fields: ['f1', 'f2', 'f3'],
							    data: r.data
							})
							var chart=null;
							var start=Ext.getCmp('lap3.f1').getValue();
							var end=Ext.getCmp('lap3.f2').getValue();
							var startVal=start.getDate()+'/'+(start.getMonth()+1)+'/'+start.getFullYear()+' s/d';
							var endVal=end.getDate()+'/'+(end.getMonth()+1)+'/'+end.getFullYear();
							new Ext.Window({
								title:'Grafik Laporan Perbandingan Pendaftaran',
								modal:true,
								iconCls:'i-chart',
								contrain: true,
								tbar:[
									{
										text:'Unduh Gambar',
										iconCls:'i-download',
										handler:function(){
											chart.save({ type: 'image/png' });
										}
									}
								],
								items:[
									chart=Ext.create('Ext.chart.Chart', {
									    width: 500,
									    height: 350,
									    animate: true,
									    store:store ,
									    legend: {
							                position: 'bottom'
							            },
							            items: [
						            		{
										      type  : 'text',
										      text  : 'Laporan Perbandingan',
										      font  : '14px Arial',
										      width : 100,
										      height: 100,
										      x : 10,
										      y : 15
										   },{
										      type  : 'text',
										      text  : 'Pendaftaran',
										      font  : '14px Arial',
										      width : 100,
										      height: 100,
										      x : 10,
										      y : 35
										   },{
										      type  : 'text',
										      text  : startVal,
										      font  : '14px Arial',
										      width : 100,
										      height: 100,
										      x : 10,
										      y : 55
										   },{
										      type  : 'text',
										      text  : endVal,
										      font  : '14px Arial',
										      width : 100,
										      height: 100,
										      x : 10,
										      y : 75
										   }
									   ],
									    theme: 'Base:gradients',
									    series: [{
									        type: 'pie',
									        axis: 'left',
									        angleField: 'f3',
									        showInLegend: true,
									        tips: {
									            trackMouse: true,
									            width: 140,
									            height: 28,
									            renderer: function(storeItem, item) {
									                var total = 0;
									                store.each(function(rec) {
									                    total += rec.get('f3');
									                });
									                this.setTitle(storeItem.get('f1'));
									            }
									        },
									        highlight: {
									            segment: {
									                margin: 10
									            }
									        },
									        label: {
									            field: 'f1',
									            display: 'rotate',
									            contrast: true,
									            font: '20px Arial',
									            renderer: function(storeItem, item,a) {
									                return a.data.f3+' % ';
									            }
									        }
									    }]
									})
								]
							}).show();
							Ext.getCmp('lap3').close();
						}
					},
					failure : function(jqXHR, exception) {
						Ext.getCmp('lap3.panel').setLoading(false);
						ajaxError(jqXHR, exception);
					}
				});
			}
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('lap3').close();
		}
	}],
	initComponent:function(){
		this.items=[
			new Ext.create('App.cmp.Panel',{
				bodyStyle : 'padding: 5px 10px',
				id : 'lap3.panel',
				width: 350,
				items:[
					new Ext.create('App.cmp.Input', {
						label : 'Periode',
						nullData : false,
						items : [
							new Ext.create('App.cmp.DateField', {
								id : 'lap3.f1',
								name : 'f1',
								value:new Date(),
								submit:'lap3.btnCetak',
								emptyText: 'Dari',
								allowBlank: false
							}),
							new Ext.create('Ext.form.DisplayField', {
								value:' &nbsp; - &nbsp; '
							}),
							new Ext.create('App.cmp.DateField', {
								id : 'lap3.f2',
								name : 'f2',
								value:new Date(),
								submit:'lap3.btnCetak',
								emptyText: 'Sampai',
								allowBlank: false
							})
						]
					})
					
				]
			})
		];
		this.callParent();
		Ext.Ajax.request({
			url : url + 'app/lap3/getVar',
			method : 'GET',
			success : function(response) {
				var r = ajaxSuccess(response);
				if (r.result == 'SUCCESS') {
					Ext.getCmp('lap3.panel').qReset();
					Ext.getCmp('lap3.panel').qSetForm();
				}else{
					$this.close();
				}
			},
			failure : function(jqXHR, exception) {
				ajaxError(jqXHR, exception);
			}
		});
	}
})