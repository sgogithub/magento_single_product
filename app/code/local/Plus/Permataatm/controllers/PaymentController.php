<?php

// app/code/local/Envato/espaypaymentmethod/controllers/PaymentController.php
class Plus_Permataatm_PaymentController extends Mage_Core_Controller_Front_Action {

    /**
     * @return Mage_Checkout_Model_Session
     */
    protected function _getCheckout() {
        return Mage::getSingleton('checkout/session');
    }

   

    public function redirectAction() {
        $orderIncrementId = $this->_getCheckout()->getLastRealOrderId();
        $order = Mage::getModel('sales/order')
                ->loadByIncrementId($orderIncrementId);
        $sessionId = Mage::getSingleton('core/session');
        $orderData = $order->getData();

        $productCode = 'PERMATAATM';
        $bankCode = '013';


        $urlJs = Mage::getStoreConfig('payment/permataatm/environment') == 'production' ? 'https://kit.espay.id' : 'https://sandbox-kit.espay.id';
        $key = Mage::getStoreConfig('payment/permataatm/paymentid');
        Mage::getSingleton('checkout/session')->unsQuoteId();
        foreach (Mage::getSingleton('checkout/session')->getQuote()->getItemsCollection() as $item) {
            Mage::getSingleton('checkout/cart')->removeItem($item->getId())->save();
        }
        //delete item from cart
        foreach (Mage::getSingleton('checkout/session')->getQuote()->getItemsCollection() as $item) {
            Mage::getSingleton('checkout/cart')->removeItem($item->getId())->save();
        }

        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template', 'permataatm', array('template' => 'permataatm/redirect.phtml'));
        $block->assign(array('urlJs' => $urlJs, 'key' => $key, 'orderId' => $orderIncrementId, 'bankCode' => $bankCode, 'productCode' => $productCode));
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }
    
    
    public function pendingAction() {
       
        $increment_id = $this->getRequest()->get("id");
        $order = Mage::getModel('sales/order')->loadByIncrementId($increment_id); 
       
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template', 'permataatm', array('template' => 'permataatm/pending.phtml'));
        $block->assign(array('incrementId' => $increment_id, 'orderId' => $order->entity_id));
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
        
       
    }
    

}
