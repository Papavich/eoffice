<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<!--echo sizeof($Room)-->
<h1>Hello Welcome to test</h1>
<table border="1">
    <tr align=“center”>
        <th width="60">วัน</th>
        <th>08.00</th>
        <th>08.30</th>
        <th>09.00</th>
        <th>09.30</th>
        <th>10.00</th>
        <th>10.30</th>
        <th>11.00</th>
        <th>11.30</th>
        <th>12.00</th>
        <th>12.00</th>
        <th>12.30</th>
        <th>13.00</th>
        <th>13.30</th>
        <th>14.00</th>
        <th>14.30</th>
        <th>15.00</th>
        <th>15.30</th>
        <th>16.00</th>
        <th>16.30</th>
        <th>17.00</th>
        <th>17.30</th>
        <th>18.00</th>
        <th>18.30</th>
        <th>19.00</th>
        <th>19.30</th>
        <th>20.00</th>
    </tr>
    <?php for ($i = 0; $i < 7; $i++) {
        foreach ($Room[$i] as $row) {
            ?>
            <!--        <tr align=“center”>-->
            <!--            <th width="60">วัน</th>-->
            <!--            <th>08.00</th>-->
            <!--            <th>08.30</th>-->
            <!--            <th>09.00</th>-->
            <!--            <th>09.30</th>-->
            <!--            <th>10.00</th>-->
            <!--            <th>10.30</th>-->
            <!--            <th>11.00</th>-->
            <!--            <th>11.30</th>-->
            <!--            <th>12.00</th>-->
            <!--            <th>12.00</th>-->
            <!--            <th>12.30</th>-->
            <!--            <th>13.00</th>-->
            <!--            <th>13.30</th>-->
            <!--            <th>14.00</th>-->
            <!--            <th>14.30</th>-->
            <!--            <th>15.00</th>-->
            <!--            <th>15.30</th>-->
            <!--            <th>16.00</th>-->
            <!---->
            <!--        </tr>-->
        <?php }
    } ?>
</table>

