Ext.define('App.cmp.TableEditor',{
	extend:'Ext.grid.Panel',
	selType: 'cellmodel',
	buttonAdd:true,
	border:false,
	q:{
		type:'tableeditor'
	},
	buttonDelete:true,
	columnLines :true,
	plugins: new Ext.create('Ext.grid.plugin.CellEditing', {
		clicksToEdit: 1
	}),
	initComponent:function(){
		var $this=this,
			fields=[],
			data={},
			col=null;
		for(var i=0,iLen=$this.columns.length ; i<iLen; i++){
			col=$this.columns[i];
			if(col.name != undefined){
				fields.push(col.name);
				col.dataIndex=col.name;
				col.sortable= false;
				col.menuDisabled = true;
			}
			if(col.value != undefined)
				data[col.name]=col.value;
		}
		if($this.buttonDelete==true){
			var column={};
			column.xtype='actioncolumn';
			column.text='Delete';
			column.width=50;
			column.align='center';
			column.menuDisabled = true;
			column.items=[{
				iconCls:'i-del',
                tooltip: 'Delete',
				text:'',
                handler: function(grid, rowIndex, colIndex) {
                    var rec = grid.getStore().removeAt(rowIndex);
					if(grid.getStore().getRange().length==0)
						$this.addLine();
                }
            }];
			this.columns.unshift(column);
		}
		this.columns.unshift( {xtype: 'rownumberer'});
		var store=new Ext.data.ArrayStore({
			fields:fields
		});
		$this.store=store;
		if($this.buttonAdd ==true){
			$this.tbar=[
				{
					text:'Add',
					iconCls:'i-add',
					handler:function(){
						$this.addLine();
					}
				}
			]
		};
		$this.addLine=function(arr){
			if(arr != undefined){
				$this.store.add(arr);
			}else{
				$this.store.add(data);
			}
		}
		$this.resetTable=function(){
			$this.store.loadData([],false);
			$this.addLine();
		}
		$this.check=function(){
			var range=$this.getStore().getRange(),
				allow=true,
				bre=null,
				col=null;
			for(var i=0,iLen=range.length ; i<iLen; i++){
				bre=false;
				for(var j=0,jLen=$this.columns.length; j<jLen; j++){
					col=$this.columns[j];
					if(col.name != undefined && col.allowBlank==false)
						if(range[i].data[col.name]== undefined || range[i].data[col.name].trim()==''){
							Ext.create('App.cmp.Toast').toast({
								msg : 'Required for '+$this.title+" in column '"+col.text+"' line-"+(i+1),
								type : 'warning'
							});
							$this.editingPlugin.startEdit(i,j);
							allow=false;
							bre=true;
							break;
						}
				}
				if(bre==true)
					break;
			}
			if(allow==true){
				for(var i=0,iLen=range.length; i<iLen ; i++){
					var bre=false;
					for(var j=0,jLen=$this.columns.length; j<jLen; j++){
						var bre1=false;
						if($this.columns[j].name != undefined)
							if($this.columns[j].primary != undefined && $this.columns[j].primary==true)
								for(var k=0,kLen=range.length; k<kLen ; k++)
									if(i != k && range[i].data[$this.columns[j].name]==range[k].data[$this.columns[j].name]){
										Ext.create('App.cmp.Toast').toast({
											msg : 'Data for '+$this.title+" in column '"+$this.columns[j].text+"' line-"+(i+1)+" Not Same with line-"+(k+1),
											type : 'warning'
										});
										allow=false;
										bre=true;
										bre1=true;
										break;
									}
						if(bre1==true)
							break;
					}
					if(bre==true)
						break;
				}
			}
			return allow;
		}
		$this.val=function(arr){
			var range=$this.getStore().getRange();
			for(var j=0,jLen=fields.length; j<jLen; j++)
				arr[fields[j]+'[]']=[];
			for(var i=0,iLen=range.length; i< iLen; i++)
				for(var j=0; j<fields.length; j++)
					arr[fields[j]+'[]'].push(range[i].data[fields[j]]);
		}
		$this.setVal=function(arr){
			$this.store.loadData([],false);
			$this.store.add(arr);
		}
		this.callParent(arguments);
		$this.addLine();
	}
})