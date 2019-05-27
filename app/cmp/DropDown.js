Ext.define('App.cmp.DropDown',{
	extend:'Ext.form.ComboBox',
	store: new Ext.data.ArrayStore(),
	queryMode: 'local',
	q:{
		type:'dropdown'
	},
	forceSelection :true,
	displayField: 'text',
	valueField: 'id',
	emptyText:'Select -',
	enableKeyEvents:true,
	listeners:{},
	initComponent:function(){
		var fields=['id','text'],
			data=[];
		if(this.fields!= undefined)
			fields=this.fields;
		this.store=new Ext.data.Store({data:data,fields:fields});
		if(this.data!=undefined)
			this.store.add(this.data);
		this.listeners.keypress=function(textfield,eo){
			if(eo.getCharCode()==Ext.EventObject.ENTER)
				if(textfield.submit != undefined)
					Ext.get(textfield.submit).dom.click();
		}
		this.callParent(arguments);
	},
	addData:function(data){
		this.store.add(data);
	},
	addReset:function(data,first){
		var val=this.getValue();
		this.store.loadData([],false);
		this.store.add(data);
		this.setValue(val);
	}
});