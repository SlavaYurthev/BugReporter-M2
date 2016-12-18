<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Block\Adminhtml\Reports\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
 
class General extends Generic implements TabInterface{
    protected $_wysiwygConfig;
    protected $_newsStatus;
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }
    protected function _prepareForm(){
        $model = $this->_coreRegistry->registry('bug_report');
        $form = $this->_formFactory->create();
 
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );
 
        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'firstname',
            'text',
            [
                'name'        => 'firstname',
                'label'    => __('Firstname'),
                'required'     => true
            ]
        );
        $fieldset->addField(
            'lastname',
            'text',
            [
                'name'        => 'lastname',
                'label'    => __('Lastname'),
                'required'     => true
            ]
        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name'        => 'email',
                'label'    => __('Email'),
                'required'     => true
            ]
        );
        if($model->getData('url')){
            $link = '<a href="'.$model->getData('url').'" target="_blank">'.basename($model->getData('url')).'</a>';
            $after_element_html = '<p style="margin:8px 0 0;">'.$link.'</p>';
            $fieldset->addField(
                'url',
                'text',
                [
                    'name'        => 'url',
                    'label'    => __('Url'),
                    'readonly'     => true,
                    'after_element_html' => $after_element_html
                ]
            );
        }
        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'comment',
            'textarea',
            [
                'name'      => 'comment',
                'label'     => __('Comment'),
                'required'  => true,
                'style'     => 'height: 15em; width: 100%;',
                'config'    => $wysiwygConfig
            ]
        );

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }
    public function getTabLabel(){
        return __('Report Info');
    }
    public function getTabTitle(){
        return __('Report Info');
    }
    public function canShowTab(){
        return true;
    }
    public function isHidden(){
        return false;
    }
}