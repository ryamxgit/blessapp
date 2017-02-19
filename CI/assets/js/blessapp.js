
(function($) {
	$.websiteClass = function(element) {
		this.element = (element instanceof $) ? element : $(element);
		this.host = $('#siteurl').val();
		this.uri = $('#uribase').val();
		this.listaT = new Array();
		this.pivotes = new Array();
	}
	$.websiteClass.prototype = {
		initForm: function() {
			$('#ghostbox').css('display', 'none');
			this.listaT = personas;
			this.pivotes = pivotes;
		},
		testHello: function() {
			console.log('Initiating from: '+$('#siteurl').val());
		},
		updTerapeutas: function(id) {
			var personas = this.pivotes[id];
			var pers = personas.split(',');
			var html = '<option value="0">Escoge una opcion...</option>';
			for(j=0; j < pers.length; j++) {
				$(this.listaT).each(function(i, item) {
						if(item.id == pers[j])
							html += '<option value="'+id+'">'+item.nombre+'</option>';
					});
			}
			$('#terapeuta').html(html);
		}
	}
}(jQuery))

var web = new $.websiteClass();

$(document).ready(function() {
	web.testHello();
	web.initForm();
});
