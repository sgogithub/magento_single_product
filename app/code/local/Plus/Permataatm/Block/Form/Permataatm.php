<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Permataatm_Block_Form_Permataatm extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
      
    parent::_construct();
    $this->setTemplate('permataatm/form/permataatm.phtml');

  }

}
