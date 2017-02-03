<?php

// app/code/local/Envato/espaypaymentmethod/controllers/PaymentController.php
class Plus_Bcaklikpay_PaymentController extends Mage_Core_Controller_Front_Action {

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

        $productCode = 'BCAKLIKPAY';
        $bankCode = '014';


        $urlJs = Mage::getStoreConfig('payment/bcaklikpay/environment') == 'production' ? 'https://kit.espay.id' : 'https://sandbox-kit.espay.id';
        $key = Mage::getStoreConfig('payment/bcaklikpay/paymentid');
        Mage::getSingleton('checkout/session')->unsQuoteId();
        foreach (Mage::getSingleton('checkout/session')->getQuote()->getItemsCollection() as $item) {
            Mage::getSingleton('checkout/cart')->removeItem($item->getId())->save();
        }
        //delete item from cart
        foreach (Mage::getSingleton('checkout/session')->getQuote()->getItemsCollection() as $item) {
            Mage::getSingleton('checkout/cart')->removeItem($item->getId())->save();
        }

        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template', 'bcaklikpay', array('template' => 'bcaklikpay/redirect.phtml'));
        $block->assign(array('urlJs' => $urlJs, 'key' => $key, 'orderId' => $orderIncrementId, 'bankCode' => $bankCode, 'productCode' => $productCode));
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }

    public function pendingAction() {

        $increment_id = $this->getRequest()->get("id");
        $order = Mage::getModel('sales/order')->loadByIncrementId($increment_id);

        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template', 'bcaklikpay', array('template' => 'bcaklikpay/pending.phtml'));
        $block->assign(array('incrementId' => $increment_id, 'orderId' => $order->entity_id));
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }

    public function responseAction() {
        $redirect = FALSE;

        if ($this->getRequest()->get("id")) {
            if ($this->getRequest()->get("id") !== '') {

                $order = Mage::getModel('sales/order')
                        ->loadByIncrementId($this->getRequest()->get("id"));

                $orderData = $order->getData();
                $defaultPaymentStatus = Mage::getStoreConfig('payment/bcaklikpay/accepted_payment_status');

                if (!empty($orderData)) {
                    if ($orderData['status'] === $defaultPaymentStatus) {
                        $redirect = TRUE;
                    }
                }
            }
        }


        if ($redirect) {

            Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/success', array('_secure' => false));
        } else {
            Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/failure', array('_secure' => false));
        }
    }

}
