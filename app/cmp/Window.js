Ext.define('App.cmp.Window', {
	extend : 'Ext.window.Window',
	constrain : true,
	closeAction : 'hide',
	autoScroll: true,
	resizable : false,
	bodyStyle:'padding-right: -1px;',
	modal : true,
	closing : true,
	q : {
		type : 'window'
	},
	full:false,
	layout : 'fit',
	listeners : {
		show : function(a) {
			a.center();
			if (a.qShow != undefined)
				a.qShow();
		},
		close : function(a) {
			if (a.qHide != undefined)
				a.qHide();
		},
		beforeclose : {
			fn : function(t) {
				var close = true;
				if (t.qBeforeClose != undefined && t.closing == false)
					close = t.qBeforeClose();
				if (close == true && t.closing == true)
					return true;
				else
					return false;
			}
		}
	},
	initComponent:function(){
		var size = {
		  width: window.innerWidth || document.body.clientWidth,
		  height: window.innerHeight || document.body.clientHeight
		}
		if(this.full==false){
			this.maxWidth=size.width-4;
			this.maxHeight=size.height-75;
		}else{
			this.maxWidth=size.width;
			this.maxHeight=size.height;
		}
		this.callParent();
	},
	qClose : function() {
		this.closing = true;
		this.close();
	}
});