<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend><?=$text_legend?></legend>
        <div class="input_wrapper n20 border padding" >
            <label <?=$this->labelFloat('first_name')?>><?=$text_label_first_name?></label>
            <input  type="text" name="first_name" maxlength="10" value="<?=$this->showValue('first_name')?>">
        </div>
        <div class="input_wrapper n20 border padding" >
            <label <?=$this->labelFloat('last_name')?>><?=$text_label_last_name?></label>
            <input  type="text" name="last_name" maxlength="10" value="<?=$this->showValue('last_name')?>">
        </div>
        <div class="input_wrapper n20 padding border" >
            <label <?=$this->labelFloat('user_name')?>><?=$text_label_user_name?></label>
            <input  type="text" name="user_name" maxlength="12" value="<?=$this->showValue('user_name')?>">
        </div>
        <div class="input_wrapper n20 border padding" >
            <label <?=$this->labelFloat('password')?>><?=$text_label_password?></label>
            <input required type="password" name="password" value="<?=$this->showValue('password')?>">
        </div>
        <div class="input_wrapper n20  padding" >
            <label <?=$this->labelFloat('cPassword')?>><?=$text_label_cPassword?></label>
            <input required type="password" name="cPassword" value="<?=$this->showValue('cPassword')?>">
        </div>
        <div class="input_wrapper n30 border padding" >
            <label <?=$this->labelFloat('email')?>><?=$text_label_email?></label>
            <input required type="email" name="email"  maxlength="40" value="<?=$this->showValue('email')?>">
        </div>
        <div class="input_wrapper n30  border padding" >
            <label <?=$this->labelFloat('cEmail')?>><?=$text_label_cEmail?></label>
            <input required type="email" name="cEmail"  maxlength="40" value="<?=$this->showValue('cEmail')?>">
        </div>
        <div class="input_wrapper n20  border padding" >
            <label <?=$this->labelFloat('phone_number')?>><?=$text_label_phone_number?></label>
            <input  type="text" name="phone_number"  maxlength="15" value="<?=$this->showValue('phone_number')?>">
        </div>
        <div class="input_wrapper_other padding n20 select ">
            <select required name="group_id" >
                  <option value=""><?= $text_label_group_id ?></option>
                  <?php if($groups !== false):foreach ($groups as $group):?>
                  <option value="<?=$group->group_id?>"><?=$group->group_name?></option>
                <?php endforeach; endif;?>
            </select>
        </div>
        <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
    </fieldset>
</form>

