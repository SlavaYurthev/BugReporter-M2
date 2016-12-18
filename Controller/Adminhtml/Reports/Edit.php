<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Controller\Adminhtml\Reports;
use Magento\Backend\App\Action;
class Edit extends \Magento\Backend\App\Action{
    protected $_coreRegistry = null;
    protected $resultPageFactory;
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }
    protected function _isAllowed(){
        return $this->_authorization->isAllowed('SY_BugReporter::reports');
    }
    protected function _initAction(){
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('SY_BugReporter::header')
            ->addBreadcrumb(__('Customer'), __('Customer'))
            ->addBreadcrumb(__('Bug Reporter'), __('Bug Reporter'))
            ->addBreadcrumb(__('Reports'), __('Reports'))
            ->addBreadcrumb(__('Edit'), __('Edit'));
        return $resultPage;
    }
    public function execute(){
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('SY\BugReporter\Model\Report');
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('bug_report', $model);
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('Bug Reporter'));
        $resultPage->getConfig()->getTitle()
            ->prepend(__('Edit'));

        return $resultPage;
    }
}