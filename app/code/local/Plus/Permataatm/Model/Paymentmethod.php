<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Permataatm_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'permataatm';
  protected $_formBlockType = 'permataatm/form_permataatm';
  protected $_infoBlockType = 'permataatm/info_permataatm';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','permataatm');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('permataatm/payment/redirect', array('_secure' => false));
  }

 

}

?>
