<?php

namespace Simicart\QRcode\Controller\Adminhtml\QRcode;
/**
 * Class Edit
 * @package Magestore\Multivendor\Controller\Adminhtml\Vendor
 */
class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory

    ) {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }


    /**
     * @return $this|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {


        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        $model = $this->_objectManager->create('Simicart\QRcode\Model\QRcode');
        $registryObject = $this->_objectManager->get('Magento\Framework\Registry');
        if ($id) {
            $model = $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This QRcode no longer exists.'));
                return $resultRedirect->setPath('simicartadmin/*/', ['_current' => true]);
            }
        }

                

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }
        $registryObject->register('current_qrcode', $model);

        $resultPage = $this->_resultPageFactory->create();
        if (!$model->getId()) {
            $pageTitle = __('New QRcode');
        } else {
        	

            $pageTitle = __('Edit QRcode ');

        }
       
        $resultPage->getConfig()->getTitle()->prepend($pageTitle);
        
        return $resultPage;
        
    }

}