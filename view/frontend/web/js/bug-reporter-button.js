/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
define(
	[
		'jquery'
	],
	function(jQuery, modal){
		return function(config, element){
			jQuery(element).on('click', function(){
				if(typeof window.bugReporterModal != 'undefined'){
					jQuery('#bug-reporter-modal').modal('openModal');
				}
			});
		}
	}
);