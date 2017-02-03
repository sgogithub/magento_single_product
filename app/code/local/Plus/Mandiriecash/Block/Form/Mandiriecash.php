<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Mandiriecash_Block_Form_Mandiriecash extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
     
    parent::_construct();
    $this->setTemplate('mandiriecash/form/mandiriecash.phtml');

  }

}
