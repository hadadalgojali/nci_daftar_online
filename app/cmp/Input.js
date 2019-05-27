Ext.define('App.cmp.Input',{
	extend: 'Ext.Panel',
	//
	label:'',
	xWidth:100,
	q:{
		type:'input'
	},
	yWidth:'auto',
	separator:':',
	nullData:true,
	separatorWidth:10,
	//
	layout:'column',
	bold:false,
	style:'margin: 4px 0;',
	bodyStyle:' background: transparent;',
	border:false,
	initComponent:function(){
		var cmp=this.items;
		var $this=this;
		if($this.tooltip != undefined)
			cmp.push(new Ext.Button({
				iconCls:'i-info',
				tooltip:$this.tooltip,
				border: 0,
				style:'background: none;'
			}));
		var nullData='';
		if($this.bold==true){
			$this.label='<b>'+$this.label+'</b>';
		}
		if(this.nullData==false)
			nullData='<font color="red">*</font>';
		var size = {
		  width: window.innerWidth || document.body.clientWidth,
		  height: window.innerHeight || document.body.clientHeight
		}
		if(size.width<350){
			$this.layout='form';
			$this.style='margin: 0px;';
		}
		this.items=[
			{
				layout:'column',
				bodyStyle:'background: transparent;',
				border:false,
				items:[
					{
						xtype:'displayfield',
						q:{
							type:'displayfield'
						},
						value:this.label+nullData,
						width:this.xWidth
					},{
						xtype:'displayfield',
						q:{
							type:'displayfield'
						},
						value:this.separator,
						width:this.separatorWidth
					}
				]
			},{
				layout:'column',
				bodyStyle:'background: transparent;',
				q:{
					type:'column'
				},
				width:this.yWidth,
				border:false,
				items:cmp
			}
		]
		this.callParent(arguments);
	}
});