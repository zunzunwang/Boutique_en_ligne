<?php
$produit = array(2,3);
$produit_list = array($produit,array(3,4));
//print_r($produit_list);
$produit_list= array($produit_list,$produit);
print_r($produit_list);

?>