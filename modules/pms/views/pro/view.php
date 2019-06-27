<table>
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach($pro as $key => $aa) : ?>
            <tr>
                <td><?= $aa-> project_id; ?></td>
                <td><?= $aa-> project_name; ?></td>
            </tr>
   <?php endforeach; ?>
    </tbody>
</table>
