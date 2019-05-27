Ext.define('modelAutoComplete', {
    extend: 'Ext.data.Model',
    fields: [{ name: 'text' },{ name: 'id' }]
});
Ext.define('App.cmp.AutoComplete',{
	extend:'Ext.form.ComboBox',
	hideTrigger: true,
	forceSelection :true,
	q:{
		type:'autocomplete'
	},
	url:'',
	typeAhead: false,
	queryMode: 'remote',
	displayField: 'text',
	valueField: 'id',
	minChars: 0,
	enableKeyEvents : true,
	selectOnFocus:true,
	initComponent:function(){
		var $this=this
			list={};
		if($this.listeners!= undefined)
			list=$this.listeners;
		$this.listeners={ 
			change:function(a){
				if(a.getValue()==null)
					a.setValue('');
			},
			keyup:function(a){
				delete a.lastQuery;
			},
			blur:function(a){
				delete a.lastQuery;
			},
			keypress:function(textfield,eo){
				if(eo.getCharCode()==Ext.EventObject.ENTER)
					if(textfield.submit != undefined)
						Ext.get(textfield.submit).dom.click();
			}
		};
		for(var i in list)
			$this.listeners[i]=list[i];
		this.store=Ext.create('Ext.data.Store', {
			autoLoad: true,
			model: modelAutoComplete,
			autoSync: true,
			remoteFilter: true,
			listeners: {
				beforeload: function(store, operation, options){
					if($this.params != undefined)
						store.proxy.extraParams=$this.params();
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