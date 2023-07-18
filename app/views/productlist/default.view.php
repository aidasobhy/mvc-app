<div class="container">
    <a href="/productlist/create" class="button"><i class="fa fa-plus"></i> <?= $text_new_item ?></a>
    <table class="data">
        <thead>
            <tr>
                <th><?= $text_table_product_name ?></th>
                <th><?= $text_table_category?></th>
                <th><?= $text_table_buy_price ?></th>
                <th><?= $text_table_sell_price ?></th>
                <th><?= $text_table_product_quantity ?></th>
                <th><?= $text_table_control ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(false !== $products): foreach ($products as $product): ?>
            <tr>
                <td><?= $product->product_name ?></td>
                <td><?= $product->category_name ?></td>
                <td><?= $product->buy_price ?></td>
                <td><?= $product->sell_price ?></td>
                <td><?= $product->product_quantity ?></td>
                <td>
                    <a href="/productlist/edit/<?= $product->product_id ?>"><i class="fa fa-edit"></i></a>
                    <a href="/productlist/delete/<?= $product->product_id ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>