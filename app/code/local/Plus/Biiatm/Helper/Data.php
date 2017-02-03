<?php
class Plus_Biiatm_Helper_Data extends Mage_Core_Helper_Abstract
{
   function getBackUrl($product, $orderId){
    return Mage::getUrl('biiatm/payment/pending', array('_secure' => false,   '_use_rewrite' => true, '_query' => array('id' => $orderId)));
  }
}
 ?>
