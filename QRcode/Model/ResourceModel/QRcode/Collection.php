<?php
namespace Simicart\QRcode\Model\ResourceModel\QRcode;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Simicart\QRcode\Model\QRcode as Model;
use Simicart\QRcode\Model\ResourceModel\QRcode as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}