Ext.define('App.cmp.Panel',{
	extend : 'Ext.form.Panel',
	border : false,
	autoWidth : true,
	autoHeight : true,
	anchor:'100%',
	autoScroll: true,
	bodyStyle:'padding-right: -1px;',
	autoSize : true,
	q : {
		type : 'panel'
	},
	fReq:true,
	scrollable : true,
	qLastForm : {},
	initComponent:function(){
		var bodyStyle='';
		if(this.bodyStyle != undefined)
			bodyStyle=this.bodyStyle;
		if(this.title != undefined){
			this.border=true;
			this.style='margin: -1px 0 0 -1px;';
		}
		this.callParent();
	},
	qFinder : function(arr, $this) {
		var t=this,
			valid=false;
		if ($this.q != undefined&& ($this.q.type == 'textfield'|| $this.q.type == 'dropdown' || $this.q.type == 'hidden' || $this.q.type == 'checkbox' || $this.q.type == 'autocomplete')) {
			arr[$this.name] = $this.getValue();
			if(t.req==true && $this.validate()==false){
				valid=true;
				if(t.fReq==true){
					t.fReq=false;
					$this.focus();
				}
			}
		}else if ($this.q != undefined && $this.q.type == 'htmleditor')
			arr[$this.name] = $this.getValue();
		else if($this.q != undefined && $this.q.type == 'datefield'){
			arr[$this.name] = $this.val();
			if(t.req==true && $this.validate()==false){
				valid=true;
				if(t.fReq==true){
					t.fReq=false;
					$this.focus();
				}
			}
		} else if($this.q != undefined &&( $this.q.type == 'filefield'||$this.q.type == 'fotoupload')){
			arr[$this.name] = $this.result;
		} else if($this.q != undefined && $this.q.type == 'tableeditor'){
			$this.val(arr);
			if(t.fReq==true && t.req==true && $this.check()==false){
				valid=true;
				t.fReq=false;
			}
		}else{
			if ($this.items != undefined) {
				for (var i = 0,iLen=$this.items.length; i <iLen ; i++) {
					var val=this.qFinder(arr, $this.items.items[i]);
					if(val==true &&  t.req==true)
						valid=true;
				}
			}
		}
		return valid;
	},
	qSetForm : function() {
		this.req=false;
		var arr = {};
		this.qFinder(arr, this);
		this.qLastForm = arr;
	},
	qGetForm : function(req) {
		var arr = {};
		if(req != undefined && req==true){
			this.req=true;
			this.fReq=true;
		}else
			this.req=false;
		var hasil=this.qFinder(arr, this);
		var sama = true;
		
		var params = arr;
		var last = this.qLastForm;
		for ( var i in last) {
			if (Array.isArray(params[i]) === false && Array.isArray(last[i]) === false) {
				if (params[i] != last[i]) {
					sama = false;
					break;
				}
			} else {
				if (params[i].length == undefined && last[i].length == undefined) {
					sama = false;
					break;
				} else {
					if (params[i].length == last[i].length ) {
						for (var j = 0,jLen=params[i].length; j <jLen ; j++) {
							if (params[i][j] != last[i][j]) {
								sama = false;
								break;
							}
						}
					} else {
						sama = false;
						break;
					}
				}
			}
		}
		if(sama==false && hasil==true && this.req==true)
			sama=null;
		this.req=false;
		return sama;
	},
	qParams : function() {
		var arr = {};
		this.qFinder(arr, this);
		return arr;
	},
	qReset : function() {
		this.getForm().reset(true);
	}
});