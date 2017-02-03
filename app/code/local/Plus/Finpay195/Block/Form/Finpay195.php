<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Finpay195_Block_Form_Finpay195 extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
      
    parent::_construct();
    $this->setTemplate('finpay195/form/finpay195.phtml');

  }

}
