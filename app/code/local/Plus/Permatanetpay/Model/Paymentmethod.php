<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Permatanetpay_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'permatanetpay';
  protected $_formBlockType = 'permatanetpay/form_permatanetpay';
  protected $_infoBlockType = 'permatanetpay/info_permatanetpay';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','permatanetpay');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('permatanetpay/payment/redirect', array('_secure' => false));
  }

 

}

?>
