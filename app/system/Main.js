Ext.define('App.system.Main', {
	extend : 'Ext.container.Viewport',
	controllers : ['main'],
	layout : {
		type : 'vbox',
		align : 'stretch'
	},
	loadMenu : function(a) {
		var $this = this,
			mainTab=Ext.getCmp('main.tab'+ a.code);
		if (a.win == false)
			if (mainTab == undefined)
				$this.addTab(a);
			else {
				if (mainTab.closing == false)
					Ext.getCmp('main.body').setActiveTab(mainTab);
				else{
					Ext.getCmp('main.body').add(mainTab);
					mainTab.closing = false;
					Ext.getCmp('main.body').setActiveTab(mainTab);
					mainTab.setLoading('Loading');
					Ext.Ajax.request({
						url : url + 'app/' + a.code + '/getVar',
						method : 'GET',
						success : function(response) {
							var resp = ajaxSuccess(response);
							mainTab.setLoading(false);
							if (resp.result == 'SUCCESS'){
								tabVar[a.code]={
									code:a.code,
									role:a.role,
									text:a.text
								}
								Ext.getCmp('main.tab' + a.code).unmask();
							}else
								Ext.getCmp('main.body').remove(mainTab);
						},
						failure : function(jqXHR, exception) {
							mainTab.setLoading(false);
							Ext.getCmp('main.body').remove(mainTab);
							ajaxError(jqXHR, exception);
						}
					});
				}
			}
		else{
			var win=Ext.getCmp(a.code.toLowerCase());
			if(win == undefined){
				win=new Ext.create(a.role);
				Ext.getCmp('main.toolbar.window').insert(0,new Ext.Button({
					text:a.text,
					iconCls:'i-window',
					maxWidth: 120,
					id:'main.toolbar.window.'+a.code.toLowerCase(),
					handler:function(){
						win.show();
					}
				}));
			}
			win.show();
		}
	},
	findingMenu : function(a) {
		var $this = this,
			menu = [],
			iVar=null;
		for (var i = 0,iLen=a.length; i <iLen ; i++) {
			iVar=a[i];
			if(iVar.handler != undefined) {
				iVar.handler = function(){
					$this.loadMenu(this);
				}
				menu.push(iVar);
			}else
				if (iVar.menu != undefined) 
					menu.push($this.findingMenu(iVar.menu.items));
		}
		return menu;
	},
	addTab : function(r) {
		var $this = this,
			mainTab=null;
		Ext.getCmp('main.body').add({
			title : r.text,
			id : 'main.tab' + r.code,
			code : r.code,
			closable : true,
			closing : false,
			closeAction : 'hide',
			layout : 'fit',
			listeners : {
				beforeclose : {
					fn : function(t) {
						if (t.closing == false) {
							var win = t.query('window'),
								hidden = true;
							for (var i = 0, iLen = win.length; i < iLen; i++)
								if (win[i].hidden == false) {
									hidden = false;
									break;
								}
							if (hidden == true)
								Ext.getCmp('main.confirm').confirm({
									msg : 'Are You Sure Close This Tab?',
									allow : 'main.close.tab',
									onY : function() {
										Ext.getCmp('main.tab' + t.code).setLoading('Deleting');
										Ext.Ajax.request({
											url : url + 'admin/delTab',
											method : 'POST',
											params : {
												code : t.code
											},
											success : function(response) {
												var r = ajaxSuccess(response);
												Ext.getCmp('main.tab' + t.code).setLoading(false);
												if (r.result == 'SUCCESS') {
													Ext.getCmp('main.tab'+ t.code).closing = true;
													Ext.getCmp('main.body').remove(t);
													delete tabVar[t.code];
												}
											},
											failure : function(jqXHR, exception) {
												Ext.getCmp('main.tab' + t.code).setLoading(false);
												ajaxError(jqXHR, exception);
											}
										});
									}
								});
							else
								new Ext.create('App.cmp.Toast').toast({msg : 'Please Close All Windows.',type : 'information'});
							return false;
						}else
							return true;
					}
				}
			}
		});
		mainTab=Ext.getCmp('main.tab' + r.code);
		Ext.getCmp('main.body').setActiveTab(mainTab);
		mainTab.setLoading('Loading');
		Ext.Ajax.request({
			url : url + 'app/' + r.code + '/getVar',
			method : 'GET',
			success : function(response) {
				var resp = ajaxSuccess(response);
				if (resp.result == 'SUCCESS'){
					tabVar[r.code]={
						code:r.code,
						role:r.role,
						text:r.text
					}
					mainTab.add(new Ext.create(r.role));
				}else
					Ext.getCmp('main.body').remove(mainTab);
			},
			failure : function(jqXHR, exception) {
				Ext.getCmp('main.body').remove(mainTab);
				ajaxError(jqXHR, exception);
			}
		});
	},
	items : [
        new Ext.toolbar.Toolbar({
			id : 'main.toolbar',
			style:'margin-top: -1px;',
			layout : {
				overflowHandler : 'Menu'
			}
		}), 
		new Ext.tab.Panel({
			id : 'main.body',
			style : {
				'margin-top' : '5px'
			},
			autoDestroy : false,
			flex : 1,
			scrollable : false,
			autoScroll : false,
			layout : 'fit',
			items : [new Ext.create('App.system.Home')]
		}), new Ext.create('App.cmp.Confirm', {
			id : 'main.confirm'
		}),
		new Ext.toolbar.Toolbar({
			id : 'main.toolbar.window',
			style:'margin-top: -2px;',
			bodyStyle:'padding-right: -1px;',
			layout : {
				overflowHandler : 'Menu'
			},
			
			items:['->','-',
				new Ext.form.DisplayField({
					width : 80,
					style:'text-align:center;',
					id:'main.time',
					value : '00:00:00'
				})
			]
		})
    ],
	initComponent : function() {
		var $this = this,
			toolbar=Ext.getCmp('main.toolbar'),
			menuSession=session.menu,
			tabSession=session.tab;
		toolbar.add(new Ext.form.DisplayField({
			id : 'main.toolbar.title',
			width : 100,
			value : '<b>NCI MEDISMART</b>'
		}), '-');
        Ext.create('App.system.Chat',{
        	renderTo:Ext.getBody()
        })
		$this.findingMenu(menuSession);
		for (var i = 0,iLen=menuSession.length; i <iLen ; i++)
			toolbar.add(menuSession[i]);
		for (var i = 0,iLen=tabSession.length; i <iLen ; i++) {
			var l = i;
			$this.addTab(tabSession[l]);
		}
		toolbar.add('->',
//				'-',
//				{
//			text:'(1)',
//			iconCls : 'i-chat',
//			handler:function(){
//				this.setText('');
//				Ext.getCmp('chat').show();
//			}
//		},
		'-',{
			text : '<b>' + session.fullName + '</b>',
			iconCls : 'i-user',
			menu : {
				xType : 'menu',
				plain : true,
				items : [
			        {
						text : 'Profile',
						iconCls : 'i-profile',
						handler:function(){
							Ext.getCmp('main.body').setActiveTab(Ext.getCmp('main.tab.home'));
							Ext.getCmp('home.btnProfile').btnEl.dom.click();
						}
					}, '-', {
						text : 'Logout',
						iconCls : 'i-off',
						handler : function() {
							Ext.getCmp('main.confirm').confirm({
								msg : 'Are you sure logout ?',
								onY : function() {
									Ext.getBody().mask('Logout');
									Ext.Ajax.request({
										url : url + 'admin/logout',
										method : 'GET',
										success : function(response) {
											var r = ajaxSuccess(response);
											if (r.result == 'SUCCESS')
												location.reload();
											else
												Ext.getBody().unmask();
										},
										failure : function(jqXHR, exception) {
											Ext.getBody().unmask();
											ajaxError(jqXHR, exception);
										}
									});
								}
							});
						}
					}
				]
			}
		}, '-');
		this.callParent(arguments);
		startTime();
		function startTime() {
		    var today = new Date();
		    var h = today.getHours();
		    var m = today.getMinutes();
		    var s = today.getSeconds();
		    m = checkTime(m);
		    s = checkTime(s);
		    Ext.getCmp('main.time').setValue(h + ":" + m + ":" + s);
		    var t = setTimeout(startTime, 500);
		}
		function checkTime(i) {
		    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		    return i;
		}
	}
});