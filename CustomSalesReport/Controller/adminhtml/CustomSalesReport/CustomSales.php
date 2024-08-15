<?php

declare(strict_types=1);

namespace Zlrp\CustomSalesReport\Controller\Adminhtml\CustomSalesReport;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class CustomSales extends Action
{
    private PageFactory $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        //enabling the controller to generate html page response
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Zlrp_CustomSalesReport::customsalesreport');
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Sales Report'));
        return $resultPage;
    }
}
