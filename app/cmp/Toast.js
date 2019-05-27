Ext.define('App.cmp.Toast',{
	extend : 'App.cmp.Window',
	modal:false,
	xtype : 'toast',
	isToast : true,
	cls : Ext.baseCSSPrefix + 'toast',
	bodyPadding : 10,
	title : 'Info',
	autoClose : true,
	plain : false,
	draggable : false,
	resizable : false,
	shadow : false,
	focus : Ext.emptyFn,
	anchor : null,
	useXAxis : false,
	autoHeight:true,
	align : 'tr',
	animate : true,
	msg : '',
	spacing : 6,
	paddingX : 30,
	layout : {
		type : 'hbox',
		align : 'stretch'
	},
	paddingY : 10,
	slideInAnimation : 'easeIn',
	slideBackAnimation : 'bounceOut',
	slideInDuration : 1500,
	slideBackDuration : 1000,
	hideDuration : 500,
	autoCloseDelay : 3000,
	stickOnClick : true,
	stickWhileHover : true,
	closeOnMouseDown : false,
	isHiding : false,
	border : false,
	isFading : false,
	destroyAfterHide : false,
	closeOnMouseOut : false,
	xPos : 0,
	yPos : 0,
	listeners:{
		show:function(a){
			a.getEl().setStyle('z-index','80000');
		}
	},
	maxWidth : 350,
	toast : function(dat) {
		if (dat.msg != undefined)
			this.items.items[1].setValue(dat.msg);
		if (dat.type != undefined) {
			if (dat.type == 'warning') {
				this.title = 'Warning';
				this.items.items[0].src = 'vendor/icon/warning.png';
			} else if (dat.type == 'error') {
				this.title = 'Error';
				this.items.items[0].src = 'vendor/icon/error.png';
			} else if (dat.type == 'privilege') {
				this.title = 'Privilege';
				this.items.items[0].src = 'vendor/icon/privilege.png';
			} else if (dat.type == 'success') {
				this.title = 'Success';
				this.items.items[0].src = 'vendor/icon/success.png';
			}
		} else {
			this.title = 'Information';
			this.items.items[0].src = 'vendor/icon/confirm.png';
		}
		this.show();
		this.setHeight(this.items.items[1].getHeight()+60);
		Ext.WindowManager.bringToFront(this);
	},
	initComponent : function() {
		var me = this;
		me.items = [
			new Ext.Img({
				src : 'vendor/icon/confirm.png',
				width : 30,
				height : 30
			}),{
				xtype : 'displayfield',
				style : 'margin-top:5px;margin-right:10px;margin-left:10px;',
				maxWidth : 280,
				autoHeight: true,
				value : me.msg
			} 
		]
		me.updateAlignment(me.align);
		me.setAnchor(me.anchor);
		me.callParent();
	},
	onRender : function() {
		var me = this;
		me.callParent(arguments);
		me.el.hover(me.onMouseEnter, me.onMouseLeave, me);
		if (me.closeOnMouseDown)
			Ext.getDoc().on('mousedown',me.onDocumentMousedown, me);
	},
	alignmentProps : {
		br : {
			paddingFactorX : -1,
			paddingFactorY : -1,
			siblingAlignment : "br-br",
			anchorAlign : "tr-br"
		},
		bl : {
			paddingFactorX : 1,
			paddingFactorY : -1,
			siblingAlignment : "bl-bl",
			anchorAlign : "tl-bl"
		},
		tr : {
			paddingFactorX : -1,
			paddingFactorY : 1,
			siblingAlignment : "tr-tr",
			anchorAlign : "br-tr"
		},
		tl : {
			paddingFactorX : 1,
			paddingFactorY : 1,
			siblingAlignment : "tl-tl",
			anchorAlign : "bl-tl"
		},
		b : {
			paddingFactorX : 0,
			paddingFactorY : -1,
			siblingAlignment : "b-b",
			useXAxis : 0,
			anchorAlign : "t-b"
		},
		t : {
			paddingFactorX : 0,
			paddingFactorY : 1,
			siblingAlignment : "t-t",
			useXAxis : 0,
			anchorAlign : "b-t"
		},
		l : {
			paddingFactorX : 1,
			paddingFactorY : 0,
			siblingAlignment : "l-l",
			useXAxis : 1,
			anchorAlign : "r-l"
		},
		r : {
			paddingFactorX : -1,
			paddingFactorY : 0,
			siblingAlignment : "r-r",
			useXAxis : 1,
			anchorAlign : "l-r"
		},
		x : {
			br : {
				anchorAlign : "bl-br"
			},
			bl : {
				anchorAlign : "br-bl"
			},
			tr : {
				anchorAlign : "tl-tr"
			},
			tl : {
				anchorAlign : "tr-tl"
			}
		}
	},
	updateAlignment : function(align) {
		var me = this, alignmentProps = me.alignmentProps, props = alignmentProps[align], xprops = alignmentProps.x[align];
		if (xprops && me.useXAxis)
			Ext.applyIf(me, xprops);
		Ext.applyIf(me, props);
	},
	getXposAlignedToAnchor : function() {
		var me = this, align = me.align, anchor = me.anchor, anchorEl = anchor
				&& anchor.el, el = me.el, xPos = 0;
		if (anchorEl && anchorEl.dom)
			if (!me.useXAxis)
				xPos = el.getLeft();
			else if (align === 'br' || align === 'tr'
					|| align === 'r') {
				xPos += anchorEl.getAnchorXY('r')[0];
				xPos -= (el.getWidth() + me.paddingX);
			} else {
				xPos += anchorEl.getAnchorXY('l')[0];
				xPos += me.paddingX;
			}
		return xPos;
	},
	getYposAlignedToAnchor : function() {
		var me = this, align = me.align, anchor = me.anchor, anchorEl = anchor
				&& anchor.el, el = me.el, yPos = 0;
		if (anchorEl && anchorEl.dom)
			if (me.useXAxis)
				yPos = el.getTop();
			else if (align === 'br' || align === 'bl'|| align === 'b') {
				yPos += anchorEl.getAnchorXY('b')[1];
				yPos -= (el.getHeight() + me.paddingY);
			} else {
				yPos += anchorEl.getAnchorXY('t')[1];
				yPos += me.paddingY;
			}
		return yPos;
	},
	getXposAlignedToSibling : function(sibling) {
		var me = this, align = me.align, el = me.el, xPos;
		if(!me.useXAxis)
			xPos = el.getLeft();
		else if(align === 'tl' || align === 'bl' || align === 'l')
			xPos = (sibling.xPos + sibling.el.getWidth() + sibling.spacing);
		else
			xPos = (sibling.xPos - el.getWidth() - me.spacing);
		return xPos;
	},
	getYposAlignedToSibling : function(sibling) {
		var me = this, align = me.align, el = me.el, yPos;
		if (me.useXAxis) {
			yPos = el.getTop();
		} else if (align === 'tr' || align === 'tl'
				|| align === 't') {
			yPos = (sibling.yPos + sibling.el.getHeight() + sibling.spacing);
		} else {
			yPos = (sibling.yPos - el.getHeight() - sibling.spacing);
		}
		return yPos;
	},
	getToasts : function() {
		var anchor = this.anchor, alignment = this.anchorAlign, activeToasts = anchor.activeToasts
				|| (anchor.activeToasts = {});
		return activeToasts[alignment]
				|| (activeToasts[alignment] = []);
	},
	setAnchor : function(anchor) {
		var me = this, Toast;
		me.anchor = anchor = ((typeof anchor === 'string') ? Ext
				.getCmp(anchor)
				: anchor);
		if (!anchor) {
			Toast = App.cmp.Toast;
			me.anchor = Toast.bodyAnchor
					|| (Toast.bodyAnchor = {
						el : Ext.getBody()
					});
		}
	},
	beforeShow : function() {
		var me = this;
		if (me.stickOnClick)
			me.body.on('click', function() {
				me.cancelAutoClose();
			});
		if (me.autoClose) {
			if (!me.closeTask)
				me.closeTask = new Ext.util.DelayedTask(me.doAutoClose, me);
			me.closeTask.delay(me.autoCloseDelay);
		}
		me.el.setX(-10000);
		me.el.setOpacity(1);
	},
	afterShow : function() {
		var me = this, el = me.el, activeToasts, sibling, length, xy;
		me.callParent(arguments);
		activeToasts = me.getToasts();
		length = activeToasts.length;
		sibling = length && activeToasts[length - 1];
		if (sibling) {
			el.alignTo(sibling.el, me.siblingAlignment,
					[ 0, 0 ]);
			me.xPos = me.getXposAlignedToSibling(sibling);
			me.yPos = me.getYposAlignedToSibling(sibling);
		} else {
			el.alignTo(me.anchor.el, me.anchorAlign, [
					(me.paddingX * me.paddingFactorX),
					(me.paddingY * me.paddingFactorY) ], false);
			me.xPos = me.getXposAlignedToAnchor();
			me.yPos = me.getYposAlignedToAnchor();
		}
		Ext.Array.include(activeToasts, me);
		if (me.animate) {
			xy = el.getXY();
			el.animate({
				from : {
					x : xy[0],
					y : xy[1]
				},
				to : {
					x : me.xPos,
					y : me.yPos,
					opacity : 1
				},
				easing : me.slideInAnimation,
				duration : me.slideInDuration,
				dynamic : true
			});
		} else
			me.setLocalXY(me.xPos, me.yPos);
	},
	onDocumentMousedown : function(e) {
		if (this.isVisible() && !this.owns(e.getTarget()))
			this.hide();
	},
	slideBack : function() {
		var me = this, anchor = me.anchor, anchorEl = anchor
				&& anchor.el, el = me.el, activeToasts = me
				.getToasts(), index = Ext.Array.indexOf(
				activeToasts, me);
		if (!me.isHiding && el && el.dom && anchorEl
				&& anchorEl.isVisible()) {
			if (index) {
				me.xPos = me.getXposAlignedToSibling(activeToasts[index - 1]);
				me.yPos = me.getYposAlignedToSibling(activeToasts[index - 1]);
			} else {
				me.xPos = me.getXposAlignedToAnchor();
				me.yPos = me.getYposAlignedToAnchor();
			}
			me.stopAnimation();
			if (me.animate) {
				el.animate({
					to : {
						x : me.xPos,
						y : me.yPos
					},
					easing : me.slideBackAnimation,
					duration : me.slideBackDuration,
					dynamic : true
				});
			}
		}
	},
	update : function() {
		var me = this;
		if (me.isVisible()) {
			me.isHiding = true;
			me.hide();
		}
		me.callParent(arguments);
		me.show();
	},
	cancelAutoClose : function() {
		var closeTask = this.closeTask;
		if (closeTask)
			closeTask.cancel();
	},
	doAutoClose : function() {
		var me = this;
		if (!(me.stickWhileHover && me.mouseIsOver))
			me.close();
		else
			me.closeOnMouseOut = true;
	},
	onMouseEnter : function() {
		this.mouseIsOver = true;
	},
	onMouseLeave : function() {
		var me = this;
		me.mouseIsOver = false;
		if (me.closeOnMouseOut) {
			me.closeOnMouseOut = false;
			me.close();
		}
	},
	removeFromAnchor : function() {
		var me = this, activeToasts, index;
		if (me.anchor) {
			activeToasts = me.getToasts();
			index = Ext.Array.indexOf(activeToasts, me);
			if (index !== -1) {
				Ext.Array.erase(activeToasts, index, 1);
				for (; index < activeToasts.length; index++)
					activeToasts[index].slideBack();
			}
		}
	},
	getFocusEl : Ext.emptyFn,
	hide : function() {
		var me = this, el = me.el;
		me.cancelAutoClose();
		if (me.isHiding) {
			if (!me.isFading) {
				me.callParent(arguments);
				me.removeFromAnchor();
				me.isHiding = false;
			}
		} else {
			me.isHiding = true;
			me.isFading = true;
			me.cancelAutoClose();
			if (el) {
				if (me.animate) {
					el.fadeOut({
						opacity : 0,
						easing : 'easeIn',
						duration : me.hideDuration,
						listeners : {
							afteranimate : function() {
								me.isFading = false;
								me.hide(me.animateTarget,
										me.doClose, me);
							}
						}
					});
				} else {
					me.isFading = false;
					me.hide(me.animateTarget, me.doClose, me);
				}
			}
		}
		return me;
	}
});