
<div class="text-center">

    <?php foreach ($modelA as $value): ?>

        <barcode code="<?=$modelA['asset_dept_code_start']?>" type="qr" size="0.8" height="2.0"/><br />
        <?=$modelA['asset_dept_code_start']?><br>

    <?php endforeach; ?>


</div>

