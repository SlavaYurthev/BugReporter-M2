<?php
/**
 * BugReporter
 * 
 * @author Slava Yurthev
 */
namespace SY\BugReporter\Controller\Post;
use Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
class Save extends \Magento\Framework\App\Action\Action {
	protected $_resultPageFactory;
	public function __construct(Context $context, PageFactory $resultPageFactory){
		$this->_resultPageFactory = $resultPageFactory;
		parent::__construct($context);
	}
	public function execute(){
		$resultRedirect = $this->resultRedirectFactory->create();
		$model = $this->_objectManager->create('SY\\BugReporter\\Model\\Report');
		$params = $this->getRequest()->getPostValue();
		if(!isset($params['url']) || $params['url'] == ""){
			$params['url'] = $this->_redirect->getRefererUrl();
		}
		$model->setData($params);
		try {
			$model->save();
			$this->messageManager->addSuccess(__('Thank you for your report. We will check it.'));
		} catch (\Exception $e) {
			$this->messageManager->addException($e, __('Something went wrong.'));
		}
		return $resultRedirect->setPath($this->_redirect->getRefererUrl());
	}
}