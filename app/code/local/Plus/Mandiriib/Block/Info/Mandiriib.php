<?php
class Plus_Mandiriib_Block_Info_Mandiriib extends Mage_Payment_Block_Info
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
