

<div class="text-center">

    <?php foreach ($modelA as $value): ?>

        <barcode code="<?=$value['asset_dept_code_start']?>" type="qr" size="0.8" height="2.0"/><br />
        <?=$value['asset_dept_code_start']?><br>

    <?php endforeach; ?>


</div>
