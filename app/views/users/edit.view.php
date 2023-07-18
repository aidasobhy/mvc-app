<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?= $text_legend ?></legend>
        <div class="input_wrapper n50  border padding">
            <label <?= $this->labelFloat('phone_number', $user) ?>><?= $text_label_phone_number ?></label>
            <input type="text" name="phone_number" maxlength="15"
                   value="<?= $this->showValue('phone_number', $user) ?>">
        </div>
        <div class="input_wrapper_other padding n50 select ">
            <select required name="group_id">
                <option value=""><?= $text_label_group_id ?></option>
                <?php if ($groups !== false):foreach ($groups as $group): ?>
                    <option value="<?= $group->group_id ?>"
                    <?=$this->selectedIf('group_id',$group->group_id,$user)?>>
                    <?= $group->group_name ?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>

