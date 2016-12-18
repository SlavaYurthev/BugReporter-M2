<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Block\Adminhtml\Reports;

class Edit extends \Magento\Backend\Block\Widget\Form\Container {
    protected $_coreRegistry = null;
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
    protected function _construct(){
        $this->_objectId = 'report_id';
        $this->_blockGroup = 'SY_BugReporter';
        $this->_controller = 'adminhtml_reports';

        parent::_construct();

        if ($this->_isAllowedAction('SY_BugReporter::reports')) {
        	$this->buttonList->remove('reset');
            $this->buttonList->update('save', 'label', __('Save Report'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('SY_BugReporter::reports')) {
            $this->buttonList->update('delete', 'label', __('Delete Report'));
        } else {
            $this->buttonList->remove('delete');
        }
    }
    public function getHeaderText(){
        if ($this->_coreRegistry->registry('bug_report')->getId()) {
            return __("Edit Report '%1'", $this->escapeHtml($this->_coreRegistry->registry('bug_report')->getId()));
        } else {
            return __('New Report');
        }
    }
    protected function _isAllowedAction($resourceId){
        return $this->_authorization->isAllowed($resourceId);
    }
    protected function _getSaveAndContinueUrl(){
        return $this->getUrl('sy_bug_reporter/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
    protected function _prepareLayout(){
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('general_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'general_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'general_content');
                }
            };
        ";
        return parent::_prepareLayout();
    }
}