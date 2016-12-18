<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Block\Adminhtml\Reports\Edit;
 
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
 
class Tabs extends WidgetTabs{
    protected function _construct(){
        parent::_construct();
        $this->setId('report_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Report Information'));
    }
    protected function _beforeToHtml(){
        $this->addTab(
            'general_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'SY\BugReporter\Block\Adminhtml\Reports\Edit\Tab\General'
                )->toHtml(),
                'active' => true
            ]
        );

        return parent::_beforeToHtml();
    }
}