<?php foreach ($items as $key => $value) { ?>

    <tr>
        <td><?= $value['material_name'] ?></td>
        <td><?= $value['amount'] ?></td>
        <td><?= $value['priceper'] ?></td>
        <td align='right'><?= $value['allprice'] ?></td>
        <td><?= $value['company'] ?></td>
    </tr>
<?php } ?>
