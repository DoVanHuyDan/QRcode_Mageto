<?php

namespace Simicart\QRcode\Controller\Adminhtml\QRcode;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class NewAction
 * @package Magestore\Multivendor\Controller\Adminhtml\Vendor
 */
class AddNewQRcode extends \Magento\Backend\App\Action 
{
    /**
     * @return mixed
     */
    public function execute()
    {
        $resultForward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        return $resultForward->forward('edit');
    }
} 