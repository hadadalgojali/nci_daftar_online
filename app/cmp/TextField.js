Ext.define('App.cmp.TextField',{
	extend: 'Ext.form.TextField',
	result:'none',
	q:{
		type:'textfield'
	},
	space:true,
	enableKeyEvents:true,
	initComponent:function(){
		this.listeners={
			blur:function($this){
				var val=$this.getValue().trim().replace(/  +/g, ' '),
					res=$this.result;
				if($this.space==false)
					val=val.replace(/ /g,'');
				
				switch(res) {
				    case 'upper':
				    	$this.setValue(val.toUpperCase());
				        break;
				    case 'lower':
				    	$this.setValue(val.toLowerCase());
				        break;
				    case 'dynamic':
				    	$this.setValue(val.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1);}));
				        break;
				}
			},
			keypress:function(textfield,eo){
				if(eo.getCharCode()==Ext.EventObject.ENTER){
					if(this.pressEnter != undefined)
						this.pressEnter();
					if(textfield.submit != undefined)
						Ext.get(textfield.submit).dom.click();
				}
					
			}
		};
		this.callParent(arguments);
	},
	val:function(data){
		var $this=this;
		data=data.trim().replace(/  +/g, ' ');
		if($this.space==false)
			data=data.replace(/ /g,'');
		if($this.result=='upper'){
			data=data.toUpperCase();
		}else if($this.result=='lower'){
			data=data.toLowerCase();
		}else if($this.result=='dynamic'){
			data=data.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1);});
		}
		$this.setValue(data);
	}
});