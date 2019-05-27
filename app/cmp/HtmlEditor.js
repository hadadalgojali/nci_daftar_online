Ext.define('App.cmp.HtmlEditor',{
	extend : 'Ext.Panel',
	q:{
		type:'htmleditor',
		param:0
	},
	layout:'fit',
	border:false,
	initComponent:function(){
		var style=new Ext.create('App.cmp.TextArea'),
			inputVideo=new Ext.create('App.cmp.TextField'),
			$this=this;
		$this.q.editor=new Ext.form.HtmlEditor({
			border:false,
			flex:1,
			id:$this.id+'.htmlEditor',
			style:'margin: -1px;'
		});
		this.tbar=[
			new Ext.Button({
				iconCls: 'i-foto',
				tooltip:'<b>Add Foto</b><p>Tambah Foto',
				handler:function(){
					file.fileInputEl.set({
						accept:'image/*'
					});
					file.fileInputEl.dom.click();
				}
			}),
			'-',
			new Ext.Button({
				iconCls: 'i-reset',
				tooltip:'<b>Reset Html</b><p>Reset Html',
				handler:function(){
					$this.setValue('');
				}
			}),
			'-',
			new Ext.Button({
				iconCls: 'i-add',
				tooltip:'<b>Add Parameter</b><p>Tambah Parameter',
				handler:function(){
					$this.q.editor.execCmd('InsertHTML', '&lt;&lt;PARAM{index}&gt;&gt;');
				}
			}),'-',
			new Ext.Button({
				iconCls: 'i-add',
				tooltip:'<b>Add Video</b><p>Tambah Video',
				handler:function(){
					windowVideo.show();
				}
			})
		];
		var windowFoto=new Ext.create('App.cmp.Window',{
			title:'Style',
			modal:true,
			iconCls:'i-foto',
			fbar:[
				{
					text:'Ok',
					iconCls:'i-yes',
					handler:function(){
						$this.q.editor.execCmd('InsertHTML', '<img style="'+style.getValue()+'" src="data:image/png;base64,'+$this.result+'" />');
						windowFoto.close();
					}
				},{
					text:'Batal',
					iconCls:'i-close',
					handler:function(){
						windowFoto.close();
					}
				}
			],
			items:[
				new Ext.create('App.cmp.Panel',{
					items:[
						new Ext.create('App.cmp.Input',{
							label:'Style',
							style:'margin: 4px;',
							items:[
								style
							]
						})
					]
				})
			]
		});
		var windowVideo=new Ext.create('App.cmp.Window',{
			title:'Video',
			modal:true,
			iconCls:'i-foto',
			fbar:[
				{
					text:'Ok',
					iconCls:'i-yes',
					handler:function(){
						$this.q.editor.execCmd('InsertHTML', '<iframe width="100%" style="max-width: 420px;max-height: 345px;" src="https://www.youtube.com/embed/'+inputVideo.getValue()+'"> </iframe>');
						windowVideo.close();
					}
				},{
					text:'Batal',
					iconCls:'i-close',
					handler:function(){
						windowVideo.close();
					}
				}
			],
			items:[
				new Ext.create('App.cmp.Panel',{
					items:[
						new Ext.create('App.cmp.Input',{
							label:'Link Video',
							style:'margin: 4px;',
							items:[
								inputVideo
							]
						})
					]
				})
			]
		});
		var file=new Ext.form.field.File({
			type : 'filefield',
			hidden:true,
			result:null,
			listeners:{
				change:function(a){
					var file = a.getEl().down('input[type=file]').dom.files[0];
					var reader = new FileReader();
					reader.onload = (function(theFile) {
						return function(e) {
							$this.result=btoa(e.target.result);
							windowFoto.show();
							style.setValue('');
							style.focus();
						};
					})(file);
					reader.readAsBinaryString(file);
				}
			}
		});
		this.items=[
			file,
			$this.q.editor
		];
		$this.setValue=function(val){
			console.log($this.id);
			Ext.getCmp($this.id+'.htmlEditor').setValue(val);
		}
		$this.getValue=function(){
			return Ext.getCmp($this.id+'.htmlEditor').getValue();
		}
		this.callParent(arguments);	
	}
});