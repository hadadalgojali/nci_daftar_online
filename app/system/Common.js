Ext.Loader.setConfig({
	disableCaching: false
});
Ext.Ajax.disableCaching = false;
var string={};
var session={};
function openPP(html,width,height){
	if(width == undefined || width==null){
		width=500;
	}
	if(height == undefined || height==null){
		height=600;
	}
	 var printWindow = window.open("", "", "location=1,status=1,scrollbars=1,width="+width+",height="+height);
	 printWindow.document.open();
	 printWindow.document.write('<!DOCTYPE html><html><head>');
	 printWindow.document.write('<style type="text/css">@media print{.no-print, .no-print *{display: none !important;}}</style>');
	 printWindow.document.write('</head><body>');
	 printWindow.document.write('<div style="width:100%;text-align:right;margin-bottom: 20px;">');
	 printWindow.document.write('<input type="button" id="btnPrint" value="Print" class="no-print" style="width:100px" onclick="window.print()" />');
	 printWindow.document.write('<input type="button" id="btnCancel" value="Cancel" class="no-print"  style="width:100px" onclick="window.close()" />');
	 printWindow.document.write('</div>');
	 printWindow.document.write(html);
	 printWindow.location.origin='http://www.evil.com';
	 printWindow.document.write('</body></html>');
	 printWindow.document.close();
	 printWindow.focus();
}
window.openPP = openPP;
function randomPassword(jumlah){
	var digit=8;
	if(jumlah != undefined){
		digit=jumlah;
	}
 	var letters = ['a','b','c','d','e','f','g','h','i','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',0,1,2,3,4,5,6,7,8,9];
	var randomstring = '';
    for(var i=0;i<digit;i++){
        var rlet = Math.floor(Math.random()*letters.length);
        randomstring += letters[rlet];
    }
    return randomstring;
}
function ajaxError(jqXHR, exception) {
	if (jqXHR.status === 0) {
		Ext.create('App.cmp.Toast').toast({
			msg : 'Not connect. Verify Network .',
			type : 'error'
		});
	} else if (jqXHR.status == 404) {
		Ext.create('App.cmp.Toast').toast({
			msg : 'Requested page not found. [404]',
			type : 'error'
		});
	} else if (jqXHR.status == 500) {
		Ext.create('App.cmp.Toast').toast({
			msg : 'Internal Server Error .[ 500 ]',
			type : 'error'
		});
	} else if (exception === 'parsererror') {
		Ext.create('App.cmp.Toast').toast({
			msg : 'Requested JSON parse failed.',
			type : 'error'
		});
	} else if (exception === 'timeout') {
		Ext.create('App.cmp.Toast').toast({
			msg : 'Time out error .',
			type : 'error'
		});
	} else if (exception === 'abort') {
		Ext.create('App.cmp.Toast').toast({
			msg : 'Ajax request aborted.',
			type : 'error'
		});
	} else {
		Ext.create('App.cmp.Toast').toast({
			msg : 'Error is not known , please contact Admin .',
			type : 'error'
		});
	}
}
function loadView(js,id){
	new Ext.create(js,{
		dataId:id
	});
}
function ajaxSuccess(r,nonObject) {
	if (typeof r=='object') {
		if (/^[\],:{}\s]*$/.test(r.responseText.replace(/\\["\\\/bfnrtu]/g, '@').
				replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
				replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
			var response=Ext.decode(r.responseText),
				res=response.result,
				mes=response.message;
			switch(res) {
			    case 'SUCCESS':
			    	if (mes != '')
						Ext.create('App.cmp.Toast').toast({msg : mes,type : 'success'});
			        break;
			    case 'WARNING':
			    	if (mes != '')
			    		Ext.create('App.cmp.Toast').toast({msg : mes,type : 'warning'});
			        break;
			    case 'ERROR':
			    	if (mes != '')
			    		Ext.create('App.cmp.Toast').toast({msg : mes,type : 'error'});
			        break;
			    case 'PRIVILEGE':
			    	Ext.create('App.cmp.Toast').toast({msg : 'you do not have access ..',type : 'privilege'});
			        break;
			    case 'SESSION':
			    	Ext.create('App.system.Session').show();
			    	Ext.getCmp('session.f1').setValue(session.userName);
			    	Ext.getCmp('session.f2').focus();
			        break;
			    default:
			    	Ext.create('App.cmp.Toast').toast({msg : 'Submissions are not known , contact the Admin.[3]',type : 'error'});
			    	break; 
			}
			return response;
		}else if(nonObject != undefined && nonObject==true){
			return {result:'SUCCESS'};
		}else{
			Ext.create('App.cmp.Toast').toast({msg : 'Submissions are not known , contact the Admin.[2]',type : 'error'});
			return {result:'ERROR'};
		}
	}else{
		Ext.create('App.cmp.Toast').toast({msg : 'Submissions are not known , contact the Admin.[1]',type : 'error'});
		return {result:'ERROR'};
	}
}
function icon(r) {
	var c = {
		t:'./vendor/icon/stop_green.png',
		f:'./vendor/icon/stop_red.png'
	}
	return c[r];
}