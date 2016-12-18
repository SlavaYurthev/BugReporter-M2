<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements InstallSchemaInterface{
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$installer = $setup;
		$installer->startSetup();
		$tableName = $installer->getTable('sy_bug_reporter_entity');
		if ($installer->getConnection()->isTableExists($tableName) != true) {
			$table = $installer->getConnection()
				->newTable($tableName)
				->addColumn('id', Table::TYPE_INTEGER, null, [
						'identity' => true,
						'unsigned' => true,
						'nullable' => false,
						'primary' => true
					], 'ID')
				->addColumn('firstname', Table::TYPE_TEXT, '255', [
						'nullable' => true
					], 'Firstname')
				->addColumn('lastname', Table::TYPE_TEXT, '255', [
						'nullable' => true
					], 'Lastname')
				->addColumn('email', Table::TYPE_TEXT, '255', [
						'nullable' => true
					], 'Email')
				->addColumn('url', Table::TYPE_TEXT, '255', [
						'nullable' => true
					], 'Url')
				->addColumn('comment', Table::TYPE_TEXT, null, [
						'nullable' => true
					], 'Comment')
				->addColumn('screenshots', Table::TYPE_TEXT, null, [
						'length' => 255,
						'nullable' => true
					], 'Screenshots')
				->addColumn('submit', Table::TYPE_INTEGER, null, [
						'length' => 1,
						'nullable' => true
					], 'Submit')
				->addColumn('created', Table::TYPE_TIMESTAMP, null, [
						'nullable' => false,
						'default' => Table::TIMESTAMP_INIT
					], 'Created')
				->setComment('Bug Reporter Table');
			$installer->getConnection()->createTable($table);
		}
		$installer->endSetup();
	}
}