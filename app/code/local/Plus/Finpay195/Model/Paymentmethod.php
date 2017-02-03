<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Finpay195_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'finpay195';
  protected $_formBlockType = 'finpay195/form_finpay195';
  protected $_infoBlockType = 'finpay195/info_finpay195';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','finpay195');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('finpay195/payment/redirect', array('_secure' => false));
  }

 

}

?>
