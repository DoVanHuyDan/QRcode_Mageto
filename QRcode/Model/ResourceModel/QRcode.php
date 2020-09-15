<?php
namespace Simicart\QRcode\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class QRcode extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('simicart_qrcode','qrcode_id');
    }
}

?>