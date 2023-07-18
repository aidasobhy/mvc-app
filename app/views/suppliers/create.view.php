<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n40 border">
            <label<?= $this->labelFloat('name') ?>><?=$text_label_name?></label>
            <input required type="text" name="name" maxlength="40" value="<?= $this->showValue('name') ?>">
        </div>
        <div class="input_wrapper n40 padding">
            <label<?= $this->labelFloat('email') ?>><?= $text_label_email ?></label>
            <input required type="email" name="email" maxlength="40" value="<?= $this->showValue('email') ?>">
        </div>
        <div class="input_wrapper n40 border">
            <label<?= $this->labelFloat('phone_number') ?>><?= $text_label_phone_number ?></label>
            <input required type="text" name="phone_number" maxlength="15" value="<?= $this->showValue('phone_number') ?>">
        </div>
        <div class="input_wrapper n40 padding">
            <label<?= $this->labelFloat('address') ?>><?= $text_label_address ?></label>
            <input required type="text" name="address" value="<?= $this->showValue('address') ?>" maxlength="50">
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>