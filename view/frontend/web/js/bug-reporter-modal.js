/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
define(
	[
		'jquery',
		'Magento_Ui/js/modal/modal'
	],
	function(jQuery, modal){
		return function(config, element){
			modal({
				buttons: [{
					text: jQuery.mage.__('Send'),
					class: 'bug-reporter-button-send primary',
					click: function () {
						if(jQuery(element).children('form').valid()){
							jQuery(element).children('form').submit();
						}
					}
				}]
			}, jQuery(element));
			window.bugReporterModal = jQuery(element);
		}
	}
);