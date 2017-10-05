<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Report extends AbstractDb {
	protected function _construct() {
		$this->_init('sy_bug_reporter_entity', 'id');
	}
}