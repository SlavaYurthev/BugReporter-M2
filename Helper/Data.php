<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;
class Data extends AbstractHelper {
	public function getConfig($key){
		return $this->scopeConfig->getValue('sy_bug_reporter_configuration/'.$key, ScopeInterface::SCOPE_STORE);
	}
}