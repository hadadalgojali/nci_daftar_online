Ext.define('App.cmp.WindowMain', {
	extend : 'Ext.window.Window',
	constrain : true,
	closeAction : 'destroy',
	autoScroll: true,
	resizable : false,
	modal : false,
	bodyStyle:'padding-right: -1px;',
	minimizable:true,
	minimize:function(){
		this.hide();
	},
	listeners:{
		close:function(a){
			Ext.getCmp('main.toolbar.window.'+a.id).destroy();
		}
	},
	q : {
		type : 'window'
	},
	layout : 'fit'
});