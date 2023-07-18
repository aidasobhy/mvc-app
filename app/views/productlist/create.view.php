<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n50 border">
            <label<?= $this->labelFloat('product_name') ?>><?= $text_label_product_name ?></label>
            <input required type="text" name="product_name" id="Name" maxlength="50" value="<?= $this->showValue('product_name') ?>">
        </div>
        <div class="input_wrapper_other padding n50 select">
            <select required name="category_id">
                <option value=""><?= $text_label_category_id ?></option>
                <?php if (false !== $categories): foreach ($categories as $category): ?>
                    <option value="<?= $category->category_id ?>"<?= $this->selectedIf('category_id', $category->category_id)?>>
                        <?= $category->category_name ?></option>
                <?php endforeach;endif; ?>
            </select>
        </div>
        <div class="input_wrapper n20 border">
            <label<?= $this->labelFloat('product_quantity') ?>><?= $text_label_product_quantity ?></label>
            <input required type="number" name="product_quantity" id="product_quantity" min="1" step="1" value="<?= $this->showValue('product_quantity') ?>">
        </div>
        <div class="input_wrapper n20 border padding">
            <label<?= $this->labelFloat('buy_price') ?>><?= $text_label_buy_price ?></label>
            <input required type="number" name="buy_price" id="buy_price" min="1" step="0.01" value="<?= $this->showValue('buy_price') ?>">
        </div>
        <div class="input_wrapper n20 border padding">
            <label<?= $this->labelFloat('sell_price') ?>><?= $text_label_sell_price ?></label>
            <input required type="number" name="sell_price" id="sell_price" min="1" step="0.01" value="<?= $this->showValue('sell_price') ?>">
        </div>
        <div class="input_wrapper_other padding n40 select">
            <select required name="unit">
                <option value=""><?= $text_label_unit ?></option>
                <option value="1" <?= $this->selectedIf('unit', 1) ?>><?= $text_unit_1 ?></option>
                <option value="2" <?= $this->selectedIf('unit', 2) ?>><?= $text_unit_2 ?></option>
                <option value="3" <?= $this->selectedIf('unit', 3) ?>><?= $text_unit_3 ?></option>
                <option value="4" <?= $this->selectedIf('unit', 4) ?>><?= $text_unit_4 ?></option>
            </select>
        </div>
        <div class="input_wrapper n100">
            <label class="floated"><?= $text_label_product_image ?></label>
            <input type="file" name="product_image" accept="image/*">
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>