<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Permatanetpay_Block_Form_Permatanetpay extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
     
    parent::_construct();
    $this->setTemplate('permatanetpay/form/permatanetpay.phtml');

  }

}
