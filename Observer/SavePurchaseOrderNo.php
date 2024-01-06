<?php
namespace Sprinix\PurchaseOrderExt\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\QuoteFactory;

/**
 * Class SavePurchaseOrderNo
 * @package Sprinix/PurchaseOrderExt/Observer
 */
class SavePurchaseOrderNo implements ObserverInterface
{

    /**
     * @var QuoteFactory
     */
    protected $quoteFactory;

    /**
     * @param QuoteFactory $quoteFactory
     */
    public function __construct(QuoteFactory $quoteFactory)
    {
        $this->quoteFactory = $quoteFactory;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getOrder();
        $quoteId = $order->getQuoteId();
        $quote = $this->quoteFactory->create()->load($quoteId);
        $purchaseOrderNo = $quote->getPurchaseOrderNo();
        $order->setPurchaseOrderNo($purchaseOrderNo);
        $order->getPayment()->setPoNumber($purchaseOrderNo);
    }
}
