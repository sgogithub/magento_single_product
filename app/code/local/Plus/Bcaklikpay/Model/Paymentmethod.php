<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Bcaklikpay_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'bcaklikpay';
  protected $_formBlockType = 'bcaklikpay/form_bcaklikpay';
  protected $_infoBlockType = 'bcaklikpay/info_bcaklikpay';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','bcaklikpay');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('bcaklikpay/payment/redirect', array('_secure' => false));
  }

 

}

?>
