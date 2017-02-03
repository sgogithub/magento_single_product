<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Mandiriib_Block_Form_Mandiriib extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
     
    parent::_construct();
    $this->setTemplate('mandiriib/form/mandiriib.phtml');

  }

}
