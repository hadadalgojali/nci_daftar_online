Ext.application({
	name : 'App',
	launch : function() {
		Ext.getBody().mask('Authentication');
		Ext.Ajax.request({
			url : url + 'admin/getVar',
			method : 'GET',
			success : function(response) {
				var r = ajaxSuccess(response);
				Ext.getBody().unmask();
				if (r.result == 'SUCCESS') {
					session = r.data.session;
					Ext.create('App.system.Main');
				}
			}
		});
	}
});
var tabVar={};
setSession();
setInterval(function(){
	setSession();
},600000);
function setSession(){
	Ext.Ajax.request({
		url : url + 'admin/setSession',
		method : 'POST',
	});
}