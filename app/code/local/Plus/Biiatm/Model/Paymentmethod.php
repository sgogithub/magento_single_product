<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Biiatm_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'biiatm';
  protected $_formBlockType = 'biiatm/form_biiatm';
  protected $_infoBlockType = 'biiatm/info_biiatm';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','biiatm');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('biiatm/payment/redirect', array('_secure' => false));
  }

 

}

?>
