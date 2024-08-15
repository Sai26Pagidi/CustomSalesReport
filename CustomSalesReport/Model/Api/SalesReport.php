<?php
namespace Zlrp\CustomSalesReport\Model\Api;

use Zlrp\CustomSalesReport\Api\SalesReportInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class SalesReport implements SalesReportInterface
{
    protected $orderCollectionFactory;

    public function __construct(CollectionFactory $orderCollectionFactory)
    {
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    public function getReport()
    {
        $collection = $this->orderCollectionFactory->create();
        $collection->getSelect()->join(
            ['sales_order_item' => 'sales_order_item'],
            'main_table.entity_id = sales_order_item.order_id',
            ['name' => 'sales_order_item.name', 'qty_ordered' => 'sales_order_item.qty_ordered', 'total_revenue' => '(sales_order_item.row_total - sales_order_item.discount_amount)']
        );
        $result = [];
        foreach ($collection as $order) {
            $result[] = [
                'order_id' => $order->getIncrementId(),
                'product_name' => $order->getName(),
                'quantity_sold' => $order->getQtyOrdered(),
                'total_revenue' => $order->getRevenue(),
                'sale_date' => $order->getCreatedAt(),
            ];
        }
        return $result;
    }
}
