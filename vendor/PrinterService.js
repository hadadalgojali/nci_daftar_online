var ws = new WebSocket("ws://127.0.0.1:1010/");
var status;

ws.onopen = function() {
	status = "connected";
    getStatus(status);
    ws.send("Hello Server");
};

ws.onmessage = function (evt) {
    var printerList = evt.data;
    //document.getElementById('cmbPrinterList').innerHTML = fillCmbPrint(printerList.split('#'));
};

ws.onclose = function() {
    ws = new WebSocket("ws://127.0.0.1:1010/");
	status = "reconnecting...";
    console.log(status);
    getStatus(status);
};

ws.onerror = function(err) {
	status = "error connecting to server";
    getStatus(status);
    console.log("Error: " + err);
};

(function(){
	ws.onopen = function() {
		setInterval(function(){ ws.send("PING"); console.log("ping")}, 60000);
	}
})();