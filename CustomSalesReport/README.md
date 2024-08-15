Module Setup:
•	Created vendor Zlrp and module CustomSalesReport .
•	Declare the Module in (magento2\app\code\Zlrp\CustomSalesReport\etc\module.xml)

•	Register the module in (magento2\app\code\Zlrp\CustomSalesReport\registration.php)

•	Enable/Activate the module Zlrp_CustomSalesReport  using (php bin/magento module:enable Zlrp_CustomSalesReport)
•	After enabling the module run (php bin/magento setup:upgrade) and (php bin/magento setup:static-content:deploy -f)
Database: 
•	Created new file (magento2\app\code\Zlrp\CustomSalesReport\etc\db_schema.xml) by adding new column  

Created Admin Grid:
•	Created Custom Sales Report sub menu under Reports->Sales (magento2\app\code\Zlrp\CustomSalesReport\etc\adminhtml\menu.xml) file
•	Created a layout file to create uicomponent file for grid (magento2\app\code\Zlrp\CustomSalesReport\view\adminhtml\layout\zlrp_customsalesreport_customsales.xml)
•	It will display grid with Order ID, Product Name, Quantity Sold, Total Revenue, Sale Date



