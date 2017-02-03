<?php
class Plus_Finpay195_Block_Info_Finpay195 extends Mage_Payment_Block_Info
{
  protected function _prepareSpecificInformation($transport = null)
  {
    if (null !== $this->_paymentSpecificInformation)
    {
      return $this->_paymentSpecificInformation;
    }

    $data = array();
   
    $transport = parent::_prepareSpecificInformation($transport);
    return $transport->setData(array_merge($data, $transport->getData()));
  }
}

 ?>
