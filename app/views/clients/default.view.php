<div class="container">
    <a href="/clients/create" class="button"><i class="fa fa-plus"></i> <?= $text_new_item ?></a>
    <table class="data">
        <thead>
            <tr>
                <th><?= $text_table_name ?></th>
                <th><?= $text_table_email ?></th>
                <th><?= $text_table_phone_number ?></th>
                <th><?= $text_table_control ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(false !== $clients): foreach ($clients as $client): ?>
            <tr>
                <td><?= $client->name ?></td>
                <td><?= $client->email ?></td>
                <td><?= $client->phone_number ?></td>
                <td>
                    <a href="/clients/edit/<?= $client->client_id ?>"><i class="fa fa-edit"></i></a>
                    <a href="/clients/delete/<?= $client->client_id ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>