<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Model\ResourceModel\Report;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection {
	protected function _construct() {
		$this->_init(
			'SY\BugReporter\Model\Report',
			'SY\BugReporter\Model\ResourceModel\Report'
		);
	}
}