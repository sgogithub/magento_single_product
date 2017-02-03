<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Mandiriecash_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'mandiriecash';
  protected $_formBlockType = 'mandiriecash/form_mandiriecash';
  protected $_infoBlockType = 'mandiriecash/info_mandiriecash';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','mandiriecash');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('mandiriecash/payment/redirect', array('_secure' => false));
  }

 

}

?>
