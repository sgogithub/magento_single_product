<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Creditcard_Block_Form_Creditcard extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
     
    parent::_construct();
    $this->setTemplate('creditcard/form/creditcard.phtml');

  }

}
