Ext.define('App.cmp.Confirm', {
	extend : 'Ext.window.Window',
	msg : '',
	title : 'Confirmation',
	constrain : true,
	bodyStyle : 'background:transparent;',
	q : {
		type : 'confirm'
	},
	modal : true,
	als : '',
	closeAction : 'hide',
	resizable : false,
	minWidth : 200,
	maxWidth : 350,
	autoWidth : true,
	border : false,
	allow : [],
	confirm : function(dat) {
		var item=this.items.items[1],
			datAllow=this.allow[dat.allow];
		item.setValue(false);
		item.hide();
		this.als = '';
		if (dat.msg != undefined)
			this.items.items[0].items.items[1].setValue(dat.msg);
		if (dat.onY != undefined)
			this.onY = dat.onY;
		if (dat.onN != undefined)
			this.onN = dat.onN;
		if (dat.allow != undefined) {
			if (datAllow == undefined)
				datAllow = false;
			if (datAllow == false) {
				this.als = dat.allow;
				item.show();
				this.show();
			}else
				if(this.onY != undefined){
					this.close();
					this.onY();
				}
		}else
			this.show();
	},
	listeners : {
		show : function(a) {
			a.center();
			a.qYesButton.focus();
		}
	},
	initComponent : function() {
		var $this = this;
		$this.items = [
			Ext.create('App.cmp.Panel', {
				bodyStyle : 'background:transparent;',
				layout : {
					type : 'hbox',
					align : 'stretch'
				},
				items : [
					new Ext.Img({
						src : 'vendor/icon/confirm.png',
						width : 50,
						height : 50
					}), {
						xtype : 'displayfield',
						style : 'margin-top:10px;margin-right:10px;',
						maxWidth : 280,
						value : $this.msg
					}
				]
			}), new Ext.form.field.Checkbox({
				style : 'margin-left: 10px;',
				boxLabel : 'Do not ask again.'
			})
		];
		$this.fbar = [
			$this.qYesButton= new Ext.Button({
				text : 'Yes',
				iconCls : 'i-yes',
				handler : function() {
					$this.close();
					if ($this.als != '' && $this.items.items[1].getValue() == true) 
						$this.allow[$this.als] = true;
					if ($this.onY != undefined)
						$this.onY();
				}
			}),new Ext.Button({
				text : 'No',
				iconCls : 'i-no',
				handler : function() {
					$this.close();
					if ($this.onN != undefined)
						$this.onN();
				}
			})
		];
		$this.callParent(arguments);
	}
});