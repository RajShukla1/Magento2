<?php
namespace Sprinix\PurchaseOrderExt\Controller\Index;

use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Context;

/**
 * Class SaveShippingData
 * @package Sprinix\PurchaseOrderExt\Controller\Index
 */
class SaveShippingData extends \Magento\Framework\App\Action\Action
{
    /**
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;
    /**
     * @var Session
     */
    protected $checkoutSession;

    /**
     * @param Context $context
     * @param Session $checkoutSession
     * @param CartRepositoryInterface $quoteRepository
     */
    public function __construct
    (
         Context $context,
         Session $checkoutSession,
         CartRepositoryInterface $quoteRepository
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->quoteRepository = $quoteRepository;
        return parent::__construct($context);
    }

    /**
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $post = $this->getRequest()->getPost('shippingdata');
        $quoteId = $this->checkoutSession->getQuoteId();
        $quote = $this->quoteRepository->get($quoteId);
        $quote->setPurchaseOrderNo($post);
        $quote->save();
        }
}
