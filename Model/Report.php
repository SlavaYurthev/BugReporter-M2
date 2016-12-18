<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Model;
use Magento\Framework\Model\AbstractModel;
class Report extends AbstractModel {
	protected function _construct() {
		$this->_init('SY\BugReporter\Model\Resource\Report');
	}
}