
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
		},
		testHello: function() {
			console.log('Initiating from: '+$('#siteurl').val());
		},
		activarCalendario: function() {
			$('#calendario').fullCalendar({
				header: {left: 'title',
					 center: '',
					 right: 'month,agendaWeek,agendaDay today prev,next'
					},
				navLinks: true
			});
			$('#content').css('height', 700);
		}
	}

}(jQuery))

var web = new $.websiteClass();

$(document).ready(function() {
	web.testHello();
	web.initForm();
	web.activarCalendario();
});
