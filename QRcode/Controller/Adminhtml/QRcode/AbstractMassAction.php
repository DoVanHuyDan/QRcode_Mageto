<?php
namespace Simicart\QRcode\Controller\Adminhtml\QRcode;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Simicart\QRcode\Model\ResourceModel\QRcode\CollectionFactory;
use Simicart\QRcode\Model\ResourceModel\QRcode\Collection;
abstract class AbstractMassAction extends \Magento\Backend\App\Action
{
    protected $redirectUrl = '*/*/index';
    protected $filter;
    protected $collectionFactory;
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }
    /**
     * @return $this
     */
    public function execute()
    {   
        try {
            
            $collection = $this->filter->getCollection($this->collectionFactory->create());
          
            return $this->massAction($collection);
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            return $resultRedirect->setPath($this->redirectUrl);
        }
    }
    /**
     * @return bool
     */
   
    protected function getComponentRefererUrl()
    {
        return '*/*/index';
    }
    abstract protected function massAction(Collection $collection);
}