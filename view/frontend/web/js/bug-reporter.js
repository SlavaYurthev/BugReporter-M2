require(
	[
		'jquery',
		'Magento_Ui/js/modal/modal'
	],
	function(jQuery, modal){
		jQuery(function(){
			var options = {
				buttons: [{
					text: jQuery.mage.__('Send'),
					class: 'bug-reporter-button-send primary',
					click: function () {
						if(jQuery('#bug-reporter-form').valid()){
							jQuery('#bug-reporter-form').submit();
						}
					}
				}]
			};
			if(jQuery('#bug-reporter-modal').length>0){
				modal(options, jQuery('#bug-reporter-modal'));
			}
			bug_report = function(){
				jQuery('#bug-reporter-modal').modal('openModal');
			}
		});
	}
);