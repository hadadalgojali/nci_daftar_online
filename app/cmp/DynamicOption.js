Ext.define('modelDynamicOption', {
    extend: 'Ext.data.Model',
    fields: [{ name: 'text' },{ name: 'id' }]
});
Ext.define('App.cmp.DynamicOption',{
	extend:'Ext.form.ComboBox',
	hideTrigger: true,
	q:{
		type:'autocomplete'
	},
	url:url+'get/getDynamicOption',
	typeAhead: false,
	queryMode: 'remote',
	displayField: 'text',
	valueField: 'id',
	minChars: 0,
	enableKeyEvents : true,
	selectOnFocus:true,
	initComponent:function(){
		var $this=this,
			list={};
		if($this.listeners!= undefined)
			list=$this.listeners;
		var blur=function($this){
			var val=$this.getRawValue().trim().replace(/  +/g, ' ');
			$this.setRawValue(val.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1);}));
			$this.setValue(val.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1);}));
		};
		$this.listeners={ 
			change:function(a){
				if(a.getValue()==null)
					a.setValue('');
			},
			keyup:function(a){
				delete a.lastQuery;
			},
			blur:blur,
			keypress:function(textfield,eo){
				if(eo.getCharCode()==Ext.EventObject.ENTER)
					if(textfield.submit != undefined){
						blur(textfield);
						Ext.get(textfield.submit).dom.click();
					}
			}
		};
		for(var i in list)
			$this.listeners[i]=list[i];
		this.store=Ext.create('Ext.data.Store', {
			autoLoad: true,
			model: modelDynamicOption,
			autoSync: true,
			remoteFilter: true,
			listeners: {
				beforeload: function(store, operation, options){
					store.proxy.extraParams={type:$this.type}
				}
			},
			proxy: {
				type: 'ajax',
				url: $this.url,
				reader: {
					type: 'json',
					root: 'data',
					totalProperty: 'total'
				},
				listeners: {
					exception: function(jqXHR, exception, operation, eOpts) {
						ajaxError(jqXHR, exception);
					}
				}
			}
		})
		this.callParent(arguments);
	}
})