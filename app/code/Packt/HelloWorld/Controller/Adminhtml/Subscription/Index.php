<?php

namespace Packt\HelloWorld\Controller\Adminhtml\Subscription;

use Magento\Catalog\Controller\Adminhtml\Product;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;


class Index extends \Magento\Catalog\Controller\Adminhtml\Product implements HttpGetActionInterface
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Product\Builder $productBuilder
    )
    {
        parent::__construct($context, $productBuilder);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        /**
         * @var \Magento\Backend\Model\View\Result\Page $resultPage
         */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Packt_HelloWorld::subscription')
            ->addBreadcrumb(__('HelloWorld'), __('HelloWorld'))
            ->addBreadcrumb(__('Manage Subscriptions'), __('Manage Subscriptions'));
        $resultPage->getConfig()->getTitle()->prepend(__('Subscriptions a'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Packt_HelloWorld::subscription');
    }
}