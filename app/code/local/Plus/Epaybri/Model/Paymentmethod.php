<?php
// app/code/local/Envato/Custompaymentmethod/Model/Paymentmethod.php
class Plus_Epaybri_Model_Paymentmethod extends Mage_Payment_Model_Method_Abstract {
  protected $_code  = 'epaybri';
  protected $_formBlockType = 'epaybri/form_epaybri';
  protected $_infoBlockType = 'epaybri/info_epaybri';

 public function assignData($data)
  {

    $info = $this->getInfoInstance();
    $info->setAdditionalInformation('method','epaybri');
 
    return $this;
  }
  public function getOrderPlaceRedirectUrl()
  {
    return Mage::getUrl('epaybri/payment/redirect', array('_secure' => false));
  }

 

}

?>
