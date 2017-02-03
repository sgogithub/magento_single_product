<?php
// app/code/local/Envato/Custompaymentmethod/Block/Form/Custompaymentmethod.php
class Plus_Epaybri_Block_Form_Epaybri extends Mage_Payment_Block_Form
{
  protected function _construct()
  {
     
    parent::_construct();
    $this->setTemplate('epaybri/form/epaybri.phtml');

  }

}
