<?php
/**
 * Yireo AdminPreviousNext for Magento
 *
 * @package     Yireo_AdminPreviousNext
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License
 */

/**
 * AdminPreviousNext Abstract block
 */
class Yireo_AdminPreviousNext_Block_Order extends Yireo_AdminPreviousNext_Block_Abstract
{
    /**
     * @return Mage_Sales_Model_Order
     */
    public function getPrevious()
    {
        $orderIds = $this->getOrderIds();
        $entity = $this->getEntity();
        $path = $entity['path'];
        $currentId = Mage::registry($entity['current'])->getId();
        $currentKey = array_search($currentId, $orderIds);
        $previousKey = $currentKey - 1;
        if($previousKey >= 0 && isset($orderIds[$previousKey])) {
            $previousId = $orderIds[$previousKey];
            $previous = Mage::getModel($entity['model'])->load($previousId);
            $previous->setUrl(Mage::helper('adminhtml')->getUrl("adminhtml/${path}/view", array($entity['id'] => $previousId)));
            $previous->setLabel(Mage::helper('adminpreviousnext')->__('Previous'));

            return $previous;
        }
    }

    /**
     * @return Mage_Sales_Model_Order
     */
    public function getNext()
    {
        $orderIds = $this->getOrderIds();
        $entity = $this->getEntity();
        $path = $entity['path'];
        $currentId = Mage::registry($entity['current'])->getId();
        $currentKey = array_search($currentId, $orderIds);
        $nextKey = $currentKey + 1;
        if(isset($orderIds[$nextKey])) {
            $nextId = $orderIds[$nextKey];
            $next = Mage::getModel($entity['model'])->load($nextId);
            $next->setUrl(Mage::helper('adminhtml')->getUrl("adminhtml/${path}/view", array($entity['id'] => $nextId)));
            $next->setLabel(Mage::helper('adminpreviousnext')->__('Next'));

            return $next;
        }
    }

    /**
     * @return array
     */
    public function getOrderIds()
    {
        $entity = $this->getEntity();
        $collection = Mage::getModel($entity['model'])->getCollection();
        $orderIds = $collection->getAllIds();
        return $orderIds;
    }

    /**
     * @return array
     */
    public function getEntity()
    {
        $entity = [
            'controller' => $this->getRequest()->getControllerName()
        ];
        switch ($entity['controller']) {
            case 'sales_order':
                $entity['path'] = 'sales_order';
                $entity['model'] = 'sales/order';
                $entity['current'] = 'current_order';
                $entity['id'] = 'order_id';
                break;
            case 'sales_order_creditmemo':
                $entity['path'] = 'sales_creditmemo';
                $entity['model'] = 'sales/order_creditmemo';
                $entity['current'] = 'current_creditmemo';
                $entity['id'] = 'creditmemo_id';
                break;
            case 'sales_order_invoice':
                $entity['path'] = 'sales_invoice';
                $entity['model'] = 'sales/order_invoice';
                $entity['current'] = 'current_invoice';
                $entity['id'] = 'invoice_id';
                break;
            case 'sales_order_shipment':
                $entity['path'] = 'sales_shipment';
                $entity['model'] = 'sales/order_shipment';
                $entity['current'] = 'current_shipment';
                $entity['id'] = 'shipment_id';
                break;
        }
        return $entity;
    }
}
