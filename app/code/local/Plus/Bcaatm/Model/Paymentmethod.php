<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Bcaatm_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'bcaatm';
  protected $_formBlockType = 'bcaatm/form_bcaatm';
  protected $_infoBlockType = 'bcaatm/info_bcaatm';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','bcaatm');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('bcaatm/payment/redirect', array('_secure' => false));
  }

 

}

?>
