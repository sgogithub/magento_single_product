<?php

class Plus_Espayconfigurationurl_IndexController extends Mage_Core_Controller_Front_Action {

    protected function _getCheckout() {
        return Mage::getSingleton('checkout/session');
    }

    protected function _getResponseInquiry($status, $message = 'Success', $order = array()) {
        $return = '';

        if ($status === '0') {
            $amount = floatval($order['grand_total']) - floatval($order['espay_fee_amount']);
            $espayPayment = explode(':', $order['espay_payment_method']);

            $productCode = $espayPayment[0];
            if ($productCode === 'CREDITCARD' || $productCode === 'BNIDBO') {

                $amount = floatval($order['grand_total']) - floatval(Mage::getStoreConfig('payment/espay/creditcardtrxfee'));
            }
            $return = '0;' . $message . ';' . $order['increment_id'] . ';' . number_format($amount, 2, '.', '') . ';' . $order['order_currency_code'] . ';Payment ' . $order['increment_id'] . ';' . date('d/m/Y h:i:s');
        } else {
            $return = '1;' . $message . ';;;;;';
        }

        return $return;
    }

    protected function _getResponseReport($status, $message = 'Success', $order = array()) {
        $return = '';

        if ($status === '0') {
            $return = '0,' . $message . ',' . $order['increment_id'] . ',' . $order['increment_id'] . ',' . date('Y-m-d H:i:s');
        } else {
            $return = '1,' . $message . ',,,';
        }

        return $return;
    }

    public function inquiryAction() {
        $vr = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $vr->setNoRender(true);

        $this->loadLayout();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('adminhtml/sales_order_view_tab_invoices')->toHtml()
        );

        if (empty($this->getRequest()->getPost())) {
            $this->norouteAction();
            return;
        }

        $orderId = $this->getRequest()->getPost('order_id');
        $webServicePassword = $this->getRequest()->getPost('password');
        $signature = $this->getRequest()->getPost('signature');
        $rqDatetime = $this->getRequest()->getPost('rq_datetime');
        $mode = 'INQUIRY';

        $order = Mage::getModel('sales/order')
                ->loadByIncrementId($orderId);

        $payment = $order->getPayment();
        $method = $payment->getAdditionalInformation('method');
        $password = Mage::getStoreConfig('payment/' . $method . '/password');


        $defaultPaymentStatus = Mage::getStoreConfig('payment/' . $method . '/default_order_status');
        $selfSignature = $this->_generateTrxSignature($rqDatetime, $orderId, $mode, $method);
        if ($signature === $selfSignature) {
            if ($webServicePassword == $password) {
                $orderData = $order->getData();
                if (!empty($orderData)) {
                    if ($orderData['status'] === $defaultPaymentStatus) {
                        echo $this->_getResponseInquiry('0', 'Success', $orderData);
                    } else {
                        echo $this->_getResponseInquiry('1', 'Order Has been Processed');
                    }
                } else {
                    echo $this->_getResponseInquiry('1', 'Order Id Not Valid');
                }
            } else {
                echo $this->_getResponseInquiry('1', 'Failed');
            }
        } else {
            echo $this->_getResponseInquiry('1', 'Invalid Signature');
        }

        #echo "We're echoing just to show that this is what's called, normally you'd have some kind of redirect going on here";*/
    }

    public function paymentAction() {
        $vr = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $vr->setNoRender(true);

        $this->loadLayout();
        $this->getResponse()->setBody(
                $this->getLayout()->createBlock('adminhtml/sales_order_view_tab_invoices')->toHtml()
        );
        
         if (empty($this->getRequest()->getPost())) {
            $this->norouteAction();
            return;
        }
        
        $orderId = $this->getRequest()->getPost('order_id');
        $webServicePassword = $this->getRequest()->getPost('password');
        $paymentRef = $this->getRequest()->getPost('payment_ref');
        $signature = $this->getRequest()->getPost('signature');
        $rqDatetime = $this->getRequest()->getPost('rq_datetime');
        $mode = 'PAYMENT';


        $order = Mage::getModel('sales/order')
                ->loadByIncrementId($orderId);
        $payment = $order->getPayment();

        $method = $payment->getAdditionalInformation('method');

        $password = Mage::getStoreConfig('payment/' . $method . '/password');
        $defaultPaymentStatus = Mage::getStoreConfig('payment/' . $method . '/accepted_payment_status');

        $selfSignature = $this->_generateTrxSignature($rqDatetime, $orderId, $mode, $method);
        if ($signature === $selfSignature) {

            if ($webServicePassword == $password) {

                $orderData = $order->getData();
                if (!empty($orderData)) {
                    if ($orderData['status'] !== $defaultPaymentStatus) {
                        try {

                            $invoice = $order->prepareInvoice();

                            $invoice->setTransactionId();
                            $invoice->addComment('Payment successfully processed by ' . $method);
                            $invoice->register();
                            $invoice->pay();

                            Mage::getModel('core/resource_transaction')
                                    ->addObject($invoice)
                                    ->addObject($invoice->getOrder($order->getId()))
                                    ->save();

                            $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true, 'Payment Success With Ref <b>' . $paymentRef . '</b>.');
                            $order->setStatus($defaultPaymentStatus);
                            $order->save();
                            $order->sendOrderUpdateEmail(true, 'Thank you, your payment is successfully processed.');

                            $status = '0';
                            $message = 'success';
                        } catch (Exception $e) {
                            $status = '1';
                            $message = 'Update Order Failed';
                        }
                    } else {
                        $status = '1';
                        $message = 'Order has been processed';
                    }
                } else {
                    $status = '1';
                    $message = 'Order Id Not Valid';
                }
            } else {
                $status = '1';
                $message = 'Failed';
            }
        } else {
            $status = '1';
            $message = 'Failed';
        }

        echo $this->_getResponseReport($status, $message, $orderData);
    }

    private function _generateTrxSignature($rqDatetime, $order_id, $mode, $method) {
        $key = Mage::getStoreConfig('payment/' . $method . '/sigpassword');
        $data = "##" . $key . "##" . $rqDatetime . "##" . $order_id . "##" . $mode . "##";

        $upperCase = strtoupper($data);
        $signature = hash('sha256', $upperCase);
        return $signature;
    }

}
