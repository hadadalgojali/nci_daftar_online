Ext.define('App.cmp.NumberField',{
	extend: 'Ext.form.NumberField',
	result:'none',
	q:{
		type:'textfield'
	},
	space:true,
	enableKeyEvents:true,
	listeners:{
		keypress:function(textfield,eo){
			if(eo.getCharCode()==Ext.EventObject.ENTER)
				if(textfield.submit != undefined)
					Ext.get(textfield.submit).dom.click();
		}
	},
});