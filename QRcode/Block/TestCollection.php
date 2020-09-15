<?php
/**
 *
 * @package     magento2
 * @author      Jayanka Ghosh
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://jayanka.me/
 */

namespace Simicart\QRcode\Block;


use Magento\Framework\View\Element\Template;
use Simicart\QRcode\Model\ResourceModel\QRcode\Collection;

class TestCollection extends Template
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * Hello constructor.
     * @param Template\Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->collection = $collection;
    }

    public function getAllQRcode() {
        return $this->collection;
    }

    // public function getAddCarPostUrl() {
    //     return $this->getUrl('helloworld/car/add');
    // }

}