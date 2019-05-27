Ext.define('App.cmp.DateField',{
	extend: 'Ext.form.DateField',
	result:'none',
	q:{
		type:'datefield'
	},
	space:true,
	width: 100,
	format:'d/m/Y',
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
			var format=value.getFullYear()+'-'+(value.getMonth()+1)+'-'+value.getDate();
		return format;
	}
});