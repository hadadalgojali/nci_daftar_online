Ext.define('App.cmp.TimeField',{
	extend: 'Ext.form.TimeField',
	result:'none',
	q:{
		type:'datefield'
	},
	width: 100,
	format:'H:i',
	enableKeyEvents:true,
	listeners:{
		keypress:function(textfield,eo){
			if(eo.getCharCode()==Ext.EventObject.ENTER)
				if(textfield.submit != undefined)
					Ext.get(textfield.submit).dom.click();
		}
	},
	val:function(data){
		var value=this.getValue(),
			format='';
		if(value != null)
			format=Ext.Date.format(value,'Y-m-d H:i:s');
		return format;
	}
});