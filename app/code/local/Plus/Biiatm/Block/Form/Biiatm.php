<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Biiatm_Block_Form_Biiatm extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
    parent::_construct();
    $this->setTemplate('biiatm/form/biiatm.phtml');

  }

}
