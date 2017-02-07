
(function($) {
	$.websiteClass = function(element) {
		this.element = (element instanceof $) ? element : $(element);
		this.host = $('#siteurl').val();
		this.uri = $('#uribase').val();
	}
	$.websiteClass.prototype = {
		initForm: function() {
			$('#ghostbox').css('display', 'none');
		},
		testHello: function() {
			console.log('Initiating from: '+$('#siteurl').val());
		}
	}
}(jQuery))

var web = new $.websiteClass();

$(document).ready(function() {
	web.testHello();
	web.initForm();
});
