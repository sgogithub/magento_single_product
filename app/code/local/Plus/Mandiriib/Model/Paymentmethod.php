<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Mandiriib_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'mandiriib';
  protected $_formBlockType = 'mandiriib/form_mandiriib';
  protected $_infoBlockType = 'mandiriib/info_mandiriib';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','mandiriib');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('mandiriib/payment/redirect', array('_secure' => false));
  }

 

}

?>
