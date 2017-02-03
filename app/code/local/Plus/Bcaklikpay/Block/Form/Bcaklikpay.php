<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Bcaklikpay_Block_Form_Bcaklikpay extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
     
    parent::_construct();
    $this->setTemplate('bcaklikpay/form/bcaklikpay.phtml');

  }

}
