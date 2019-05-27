Ext.define('App.cmp.FileField', {
	extend : 'Ext.form.field.File',
	q : {
		type : 'filefield'
	},
	result:null,
	listeners:{
		change:function(a){
			var file = a.getEl().down('input[type=file]').dom.files[0];
			var reader = new FileReader();
			reader.onload = (function(theFile) {
				return function(e) {
					a.result=e.target.result;
				};
			})(file);
			reader.readAsBinaryString(file);
		}
	}
});