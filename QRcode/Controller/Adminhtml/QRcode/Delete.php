<?php

namespace Simicart\QRcode\Controller\Adminhtml\QRcode;

class Delete extends \Magento\Backend\App\Action
{
	
	public function execute()
	{
		$resultRedirect = $this->resultRedirectFactory->create();
		$QRcodeID = $this->getRequest()->getParam('id');
	
		if ($QRcodeID >= 0) {
			$QRcodeModel = $this->_objectManager->create('Simicart\QRcode\Model\QRcode')
			->load($QRcodeID);
			$QRcodeModel->delete();
			$this->messageManager->addSuccess(__('QRcode was successfully deleted'));
		}
		return $resultRedirect->setPath('*/*/');

	}
}