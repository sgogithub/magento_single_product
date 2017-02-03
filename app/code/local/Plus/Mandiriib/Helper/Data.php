<?php
class Plus_Mandiriib_Helper_Data extends Mage_Core_Helper_Abstract
{
   function getBackUrl($product, $orderId){
    return Mage::getUrl('mandiriib/payment/response', array('_secure' => false,   '_use_rewrite' => true, '_query' => array('id' => $orderId)));
  }
}
 ?>
