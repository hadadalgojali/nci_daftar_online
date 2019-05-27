Ext.define('App.cmp.Table', {
	extend : 'Ext.grid.Panel',
	pageSize : 25,
	page : 0,
	total : 0,
	totalPage : 0,
	flex : 1,
	style:'margin-top: -1px;',
	bodyStyle:'padding-right: -1px;',
	border : true,
	columnLines : true,
	store : new Ext.data.ArrayStore({
		fields : []
	}),
	dataRow:null,
	initComponent : function() {
		var $this = this;
		$this.listeners={
			cellclick : function(view, cell, cellIndex, record, row, rowIndex, e) {
				if($this.onSelect != undefined)
					$this.onSelect(view, cell, cellIndex, record, row, rowIndex, e);
					$this.dataRow=record.data;
		    }
		};
		this.bbar = new Ext.toolbar.Paging({
			store : $this.store,
			displayInfo : true,
			items : [ '-', {
				xtype : 'displayfield',
				value : 'Show Per Page: '
			}, Ext.create('App.cmp.DropDown', {
				data : [ {
					id : 1,
					text : 1
				}, {
					id : 5,
					text : 5
				}, {
					id : 10,
					text : 10
				}, {
					id : 25,
					text : 25
				}, {
					id : 50,
					text : 50
				}, {
					id : 100,
					text : 100
				}, {
					id : 200,
					text : 200
				} ],
				width : 50,
				value : $this.pageSize,
				listeners:{
					select : function(a) {
						$this.page = 0;
						$this.pageSize = a.getValue();
						$this.refresh();
					}
				}
			}) ],
			doRefresh : function() {
				$this.q.sort=undefined;
				$this.refresh();
			},
			moveFirst : function() {
				$this.page = 0;
				$this.refresh();
			},
			movePrevious : function() {
				$this.page -= 1;
				$this.refresh();
			},
			moveNext : function() {
				$this.page += 1;
				$this.refresh();
			},
			moveLast : function() {
				$this.page = $this.totalPage - 1;
				$this.refresh();
			},
			onLoad : function(a) {
				var val = parseInt($this.bbar.items.items[4].getValue());
				if (isNaN(val))
					$this.page = 0;
				else if(val > $this.totalPage)
					$this.page = $this.totalPage - 1;
				$this.bbar.items.items[4].on('blur', function() {
					this.setValue($this.page + 1);
				});
				$this.refresh();
			}
		})
		this.q = {};
		this.q.bbar = this.bbar;
		if (this.columns != undefined) {
			var fields = [];
			for (var i = 0,iLen=this.columns.length; i < iLen; i++)
				if (this.columns[i].dataIndex != undefined)
					fields.push(this.columns[i].dataIndex);
			this.store = new Ext.data.ArrayStore({
				fields : fields,
				sort: function(sorters) {
					if(sorters != undefined){
						$this.q.sort=sorters;
						$this.refresh();
					}
				}
			});
		}
		this.refresh = function(bo) {
			var $this = this, a = $this.q.bbar.items.items, to = 0;
			if($this.onNotSelect != undefined)
				$this.onNotSelect($this);
			$this.dataRow=null;
			this.setLoading('Loading');
			var params={};
			if($this.params != undefined &&(bo== undefined || (bo != undefined && bo == true)))
				params=$this.params();
			else
				$this.q.sort=undefined;
			params['page']=$this.page*$this.pageSize;
			params['pageSize']=$this.pageSize;
			if($this.q.sort != undefined){
				params['s']=$this.q.sort.property;
				params['d']=$this.q.sort.direction;
			}
			Ext.Ajax.request({
				url : $this.url,
				method : 'GET',
				params:params,
				success : function(response) {
					$this.setLoading(false);
					var r = ajaxSuccess(response);
					if (r.result == 'SUCCESS') {
						var data = $this.result(r),
							list = data.list,
							total = data.total;
						$this.store.loadData([], false);
						$this.store.add(list);
						$this.total = total;
						$this.totalPage = Math.ceil(total / $this.pageSize);
						if ($this.page > 0) {
							a[0].enable();
							a[1].enable();
						} else {
							a[0].disable();
							a[1].disable();
						}
						if (($this.page + 1) < $this.totalPage) {
							a[7].enable();
							a[8].enable();
						} else {
							a[7].disable();
							a[8].disable();
						}
						a[4].enable();
						a[4].setValue($this.page + 1);
						a[5].update(' of  ' + $this.totalPage);
						to = (($this.page * $this.pageSize) + $this.pageSize);
						if (to > total)
							to = total;
						a[15].update('Displaying '
								+ (($this.page * $this.pageSize) + 1) + ' - ' + to
								+ ' of ' + total + ' records');
					}
				},
				failure : function(jqXHR, exception) {
					$this.setLoading(false);
					ajaxError(jqXHR, exception);
				}
			});
		}
		this.callParent(arguments);
		this.refresh();
	}
});