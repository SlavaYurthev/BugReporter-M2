require(
	[
		'jquery',
		'Magento_Ui/js/modal/modal'
	],
	function($, modal){
		var options = {
			buttons: [{
				text: $.mage.__('Send'),
				class: 'bug-reporter-button-send primary',
				click: function () {
					if($('#bug-reporter-form').valid()){
						$('#bug-reporter-form').submit();
					}
				}
			}]
		};
		if($('#bug-reporter-modal').length>0){
			modal(options, $('#bug-reporter-modal'));
		}
		bug_report = function(){
			$('#bug-reporter-modal').modal('openModal');
		}
	}
);