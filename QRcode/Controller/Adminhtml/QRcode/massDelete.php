<?php
namespace Simicart\QRcode\Controller\Adminhtml\QRcode;
use Magento\Backend\App\Action\Context;
use Simicart\QRcode\Model\ResourceModel\QRcode\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Simicart\QRcode\Model\ResourceModel\QRcode\Collection;

/**
 * Class MassDelete
 * @package Magestore\Multivendor\Controller\Adminhtml\Vendor
 */
class MassDelete extends AbstractMassAction
{
    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context, $filter, $collectionFactory);
    }
    /**
     * @param Collection $collection
     * @return \Magento\Framework\Controller\ResultInterface
     */
    protected function massAction(Collection $collection)
    {
        //TODO
        $count = 0;
        foreach ($collection as $vendorModel) {
            $vendorModel->delete();
            $count ++ ;
        }
        $this->messageManager->addSuccess('You have deleted %1 livestream', $count);
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->getComponentRefererUrl());
        return $resultRedirect;
    }
}