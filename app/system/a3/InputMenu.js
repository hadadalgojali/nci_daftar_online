Ext.define('App.system.a3.InputMenu',{
	extend : 'App.cmp.Window',
	iconCls:'i-role',
	id:'a3.inputMenu',
	title:'Role Menu',
	modal : true,
	fbar: [{
		text: 'Save',
		iconCls:'i-save',
		handler: function() {
			Ext.getCmp('a3.confirm').confirm({
				msg : 'Are you sure Save this Data ?',
				allow : 'a3.save',
				onY : function() {
					Ext.getCmp('a3.inputMenu').setLoading('Saving');
					function getChild(a,child){
						for(var i=0,iLen=child.length; i< iLen; i++){
							var o=child[i];
							if(o.data.checked==true){
								a.push(o.raw.menu_code);
								getChild(a,o.childNodes);
							}
						}
					}
					var a={};
					a['roleCode']=Ext.getCmp('a3.inputMenu.roleCode').getValue();
					a['id']=Ext.getCmp('a3.inputMenu.id').getValue();
					var child=Ext.getCmp('a3.input.tree').store.tree.root.childNodes,
						b=[];
					for(var i=0,iLen=child.length; i<iLen ; i++){
						var o=child[i];
						if(o.data.checked==true){
							b.push(o.raw.menu_code);
							getChild(b,o.childNodes);
						}
					}
					a['menuCode']=Ext.encode(b);
					Ext.Ajax.request({
						url : url + 'app/A3/saveMenu',
						method : 'POST',
						params:a,
						success : function(response) {
							Ext.getCmp('a3.inputMenu').setLoading(false);
							var r =ajaxSuccess(response);
							if (r.result == 'SUCCESS') {
								Ext.getCmp('a3.inputMenu').qClose();
								Ext.getCmp('a3.list').refresh();
							}
						},
						failure : function(jqXHR, exception) {
							Ext.getCmp('a3.inputMenu').setLoading(false);
							ajaxError(jqXHR, exception);
						}
					});
				}
			});
		}
	},{
		text: 'Close',
		iconCls:'i-close',
		handler: function() {
			Ext.getCmp('a3.inputMenu').close();
		}
	}],
	items:[
		new Ext.create('App.cmp.HiddenField',{
			id:'a3.inputMenu.roleCode'
		}),
		new Ext.create('App.cmp.HiddenField',{
			id:'a3.inputMenu.id'
		}),
		new Ext.tree.Panel({
			border:false,
			height: 300,
			title:'Menu',
			style:'margin-top: -1px;',
			width: 300,
			maxWidth: 300,
			autoScroll :true,
			id : 'a3.input.tree',
			store: Ext.create('Ext.data.TreeStore', {
				root: {
					expanded: true,
					children: []
				}
			}),
			rootVisible: false,
			listeners: {
				checkchange : function(node, checked, opts) {
					function clearNodeSelection(node){
						leafNode = node.raw.leaf;
						if(!leafNode)
							node.cascadeBy(function(node) {node.set('checked', false);})
					}
					if(!checked){
						clearNodeSelection(node);
					}
					function selectParentNodes(node){
						var parentNode = node.parentNode;
						if(parentNode && node.id != 'root'){
							parentNode.set('checked', true);
							selectParentNodes(parentNode);
						}
					}
					selectParentNodes(node);
					if(node.getChildAt(0) && node.isExpanded()) {
						node.eachChild(function(childNode) {
							var childRecord = this.getView().getRecord(childNode);
							childRecord.set('checked', checked);
						}, this);
					}
				}
			}
		})
	]
})