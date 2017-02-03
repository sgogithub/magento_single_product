<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Bcaatm_Block_Form_Bcaatm extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
      
    parent::_construct();
    $this->setTemplate('bcaatm/form/bcaatm.phtml');

  }

}
