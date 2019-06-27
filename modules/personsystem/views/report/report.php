<?php
use app\models\Person;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/13/2017
 * Time: 1:29 AM
 */
//echo $Person->getPerson_id();
$t = $Person->getPerson_id();
foreach($t as $item){
    echo $item;
      }


