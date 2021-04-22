<?php
$public_ins = new Wp_Smp_Public();
$myprofile = $public_ins->wpsmp_get_my_profile();

var_dump($myprofile);