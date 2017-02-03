<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Creditcard_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'creditcard';
  protected $_formBlockType = 'creditcard/form_creditcard';
  protected $_infoBlockType = 'creditcard/info_creditcard';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','creditcard');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('creditcard/payment/redirect', array('_secure' => false));
  }

 

}

?>
