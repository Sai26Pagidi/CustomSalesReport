<?php
namespace Zlrp\CustomSalesReport\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;

class UpdateOrderItemRevenue implements ObserverInterface
{
    protected $orderCollectionFactory;
    protected $logger;
    protected $resourceConnection;

    public function __construct(OrderCollectionFactory $orderCollectionFactory,\Magento\Framework\App\ResourceConnection $resourceConnection)
    {
        $this->orderCollectionFactory = $orderCollectionFactory;
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/system.log');
        $this->logger = new \Zend_Log();
        $this->logger->addWriter($writer);
        $this->resourceConnection = $resourceConnection->getConnection();
    }

    public function execute(Observer $observer)
    {
        $this->logger->info(json_encode(['message' => "Inside Observer Class"]));
        $order = $observer->getEvent()->getOrder();
        if (!$order) {
            $this->logger->info(json_encode(['message' => "No order found in observer"]));
            return;
        }
        $this->logger->info(json_encode(['message' => "Order found in observer",'orderId'=> $order->getId()]));
       $orderItems = $order->getAllItems();
        foreach ($orderItems as $item) {
            // Calculate total revenue 
            $totalRevenue = $item->getRowTotal() - $item->getDiscountAmount();
            $this->logger->info(json_encode(['message' => "Inside Observer Class totalRevenue",'data'=>$totalRevenue]));
            // Update the total revenue in the sales_order_item table
            $sql = "update sales_order_item set total_revenue='".$totalRevenue."' where order_id='".$order->getId()."'";
            $this->logger->info(json_encode(['message' => "Inside Observer Class sql",'data'=>$sql]));
            $this->resourceConnection->query($sql);
        }
    }
}
