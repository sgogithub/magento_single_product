<?php
class Plus_Permataatm_Helper_Data extends Mage_Core_Helper_Abstract
{
   function getBackUrl($product, $orderId){
    return Mage::getUrl('permataatm/payment/pending', array('_secure' => false,   '_use_rewrite' => true, '_query' => array('id' => $orderId)));
  }
}
 ?>
