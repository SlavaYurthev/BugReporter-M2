<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Customer\Model\Session;
use \Magento\Customer\Model\Customer;
class Modal extends Template {
	protected $registry;
	protected $product;
	public function __construct(
			Context $context,
			Session $session,
			Customer $customer,
			\SY\BugReporter\Helper\Data $helper,
			array $data = []
		){
		$this->session = $session;
		$this->customer = $customer;
		$this->helper = $helper;
		if($this->session && $this->session->getData('customer_id')){
			$this->customer->load($this->session->getData('customer_id'));
		}
		parent::__construct($context, $data);
	}
	public function getFirstname(){
		return $this->customer->getFirstname();
	}
	public function getLastname(){
		return $this->customer->getLastname();
	}
	public function getEmail(){
		return $this->customer->getEmail();
	}
	public function isActive(){
		if($this->helper->getConfig('general/enable') == "1"){
			return true;
		}
	}
	public function getCurrentUrl() {
	    return $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true]);
	}
}