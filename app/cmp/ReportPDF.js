Ext.define('App.cmp.ReportPDF',{
	extend : 'App.cmp.Window',
	title:'Report',
	maximized: true,
	autoScroll: false,
	modal:true,
	initComponent:function(){
		var $this=this;
		this.toPDF=function(){
			var param=$this.params();
			var par='';
			for(var i in param){
				if(par != ''){
					par+='&';
				}
				par+=i+'='+param[i];
			}
			$this.update("<iframe style='width: 100%; height: 100%;' src='"+$this.url+"?"+par+"'></iframe>");
			$this.show();
//			Ext.getCmp($this.parent).setLoading('Loading PDF');
//			Ext.Ajax.request({
//				url : $this.url,
//				method : 'GET',
//				params:$this.params(),
//				success : function(response) {
//					Ext.getCmp($this.parent).setLoading(false);
//					var r = ajaxSuccess(response,true);
//					if (r.result == 'SUCCESS') {
//						$this.update("<iframe style='width: 100%; height: 100%;' src='data:application/pdf;base64,"+btoa(unescape(encodeURIComponent(response.responseText)))+"'></iframe>");
//						$this.show();
//					}
//				},
//				failure : function(jqXHR, exception) {
//					Ext.getCmp($this.parent).setLoading(false);
//					ajaxError(jqXHR, exception);
//				}
//			});
		};
		this.callParent();
	}
})