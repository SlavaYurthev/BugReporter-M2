<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
class Button extends Template {
	protected $session;
	public function __construct(
			Context $context,
			\SY\BugReporter\Helper\Data $helper,
			array $data = []
		){
		$this->helper = $helper;
		parent::__construct($context, $data);
	}
	public function isActive(){
		if($this->helper->getConfig('general/enable') == "1"){
			return true;
		}
	}
}