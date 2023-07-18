<form autocomplete="off" class="appForm clearfix" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n100">
            <label<?= $this->labelFloat('category_name', $category) ?>><?=$text_label_category_name?></label>
            <input required type="text" name="category_name" id="category_name" maxlength="20" value="<?= $this->selectedIf('category_id', $category->category_id) ?><?= $this->showValue('category_name', $category) ?>">

        </div>
        <div class="input_wrapper n100">
            <label class="floated"><?= $text_label_category_image ?></label>
            <input type="file" name="category_image" accept="image/*">
        </div>
        <?php if ($category->category_image !==null): ?>
            <div class="input_wrapper_other n100">
                <img src="/uploads/images/<?= $category->category_image ?>" width="30%">
            </div>
        <?php endif; ?>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>