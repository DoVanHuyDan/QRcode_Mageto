<?php

namespace Simicart\QRcode\Model;

use Magento\Framework\Model\AbstractModel;
use Simicart\QRcode\Model\ResourceModel\QRcode as ResourceModel;

class QRcode extends AbstractModel
{
	protected function _construct()
	{
		$this->_init(ResourceModel::class);
	}

	// public function beforeSave()
	// {
	// 	if (!$this->getId()) {
	// 		$this->setCreatedAt($this->_dateFactory->create()->gmtDate());
	// 	} else {
	// 		$this->setUpdatedAt($this->_dateFactory->create()->gmtDate());
	// 	}

	// 	return parent::beforeSave();
	// }
}