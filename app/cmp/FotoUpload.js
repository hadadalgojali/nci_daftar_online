Ext.define('App.cmp.FotoUpload', {
	extend : 'Ext.Panel',
	q : {
		type : 'fotoupload'
	},
	result:null,
	tempResult:null,
	border:false,
	closeAction:'destroy',
	width: 150,
	height: 170,
	input:true,
	html:'<img style="width: 150px;height: 170px;border: 1px solid #99bce8;cursor:pointer;" src="'+url+'upload/NO.GIF"></img>',
	initComponent:function(){
		var btnDeleteImage=null,
			btnReplaceImage=null;
		disabled=false;
		if(this.input==false)
			disabled=true;
		var size = {
				  width: window.innerWidth || document.body.clientWidth,
				  height: window.innerHeight || document.body.clientHeight
			},
			$this=this,
			panelWindow=new Ext.create('App.cmp.Panel',{
				html:'<img src="'+url+'upload/NO.GIF"></img>'
			}),
			buttonDownload=new Ext.Button({
				tooltip:'Download Image',
				iconCls:'i-download',
				handler:function(){
					var base64Matcher = new RegExp("^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=)?$");
					var src='';
					if (base64Matcher.test($this.tempResult)) {
						src='data:image/png;base64,'+$this.tempResult;
					} else {
					    src=url+'upload/'+$this.tempResult;
					}
					window.open(src);
				}
			}),
			windowFoto=new Ext.create('App.cmp.Window',{
				title:'Foto',
				modal:true,
				iconCls:'i-foto',
				tbar:[
					btnDeleteImage=new Ext.Button({
						tooltip:'Replace Image/ Upload',
						iconCls:'i-replace',
						disabled:disabled,
						handler:function(){
							file.fileInputEl.set({
								accept:'image/*'
							});
							file.fileInputEl.dom.click();
						}
					}),'-',
					btnReplaceImage=new Ext.Button({
						tooltip:'Delete Image',
						iconCls:'i-reset',
						disabled:disabled,
						handler:function(){
							panelWindow.update('<img src="'+url+'upload/NO.GIF"></img>');
							$this.setNull();
							windowFoto.center();
							buttonDownload.disable();
						}
					}),'-',
					buttonDownload
				],
				items:[
					panelWindow
				],
				listeners:{
					show:function(a){
						if($this.input==false){
							btnDeleteImage.disable();
							btnReplaceImage.disable();
						}else{
							btnDeleteImage.enable();
							btnReplaceImage.enable();
						}
						if($this.result != null){
							buttonDownload.enable();
							var base64Matcher = new RegExp("^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=)?$");
							var src='';
							if (base64Matcher.test($this.tempResult)) {
								src='data:image/png;base64,'+$this.tempResult;
							} else {
							    src=url+'upload/'+$this.tempResult;
							}
							panelWindow.update('<img style="max-width:'+(size.width-200)+'px;max-height:'+(size.height-200)+'px;"  src="'+src+'"></img>');
						}else{
							buttonDownload.disable();
							panelWindow.update('<img style="max-width:'+(size.width-200)+'px;max-height:'+(size.height-200)+'px;" src="'+url+'upload/NO.GIF"></img>');
						}
						a.center();
					}
				}
			}),
			file=new Ext.form.field.File({
				type : 'filefield',
				hidden:true,
				result:null,
				listeners:{
					change:function(a){
						var file = a.getEl().down('input[type=file]').dom.files[0],
						reader = new FileReader();
						windowFoto.close();
						reader.onload = (function(theFile) {
							return function(e) {
//								if(theFile.size<= 1024000){
									$this.result=btoa(e.target.result);
									$this.tempResult=btoa(e.target.result);
									$this.update('<img style="width: '+($this.width-2)+'px;height: '+($this.height-2)+'px; border: 1px solid #99bce8;cursor:pointer;" src="data:image/png;base64,'+btoa(e.target.result)+'"></img>');
									panelWindow.update('<img style="max-width:'+(size.width-50)+'px;max-height:'+(size.height-100)+'px;"  src="data:image/png;base64,'+btoa(e.target.result)+'"></img>');
									windowFoto.center();
									buttonDownload.enable();
//								}else{
//									Ext.create('App.cmp.Toast').toast({msg : 'Image can not be more than 1 Mb.'});
//								}
							};
						})(file);
						reader.readAsBinaryString(file);
					}
				}
			});
		this.items=[
			file
		]
		this.listeners={
		   'render': function(panel) {
				panel.body.on('click', function(){
					windowFoto.show();
				});
			}
		}
		this.callParent(arguments);
	},
	setFoto:function(foto){
		var $this=this;
		if(foto != null && foto != ''){
			$this.result=true;
			$this.tempResult=foto;
			var base64Matcher = new RegExp("^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=)?$");
			var src='';
			if (base64Matcher.test(foto)) {
				src='data:image/png;base64,'+foto;
			} else {
			    src=url+'upload/'+foto;
			}
			$this.update('<img style="width: '+($this.width-2)+'px;height: '+($this.height-2)+'px; border: 1px solid #99bce8;cursor:pointer;" src="'+src+'"></img>');
		}else
			$this.setNull();
	},
	setNull:function(){
		var $this=this;
		$this.result=null;
		$this.tempResult=null;
		$this.update('<img style="width: 150px;height: 170px;border: 1px solid #99bce8;cursor:pointer;" src="'+url+'upload/NO.GIF"></img>');
	}
});