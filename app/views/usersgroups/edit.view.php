<form autocomplete="off" class="appForm clearfix" method="post" enctype="application/x-www-form-urlencoded">
   <fieldset>
       <legend><?=$text_legend?></legend>
       <div class="input_wrapper n100 " >
           <label class="floated"><?=$text_label_group_name?></label>
          <input required type="text" name="group_name" id="group_name" maxlength="30"
                 value="<?=$group->group_name?>">
       </div>
       <div class="input_wrapper_other">
           <label><?= $text_label_privileges ?></label>
           <?php if($privileges !== false): foreach ($privileges as $privilege):?>
               <label class="checkbox block">
               <input type="checkbox" name="privileges[]"  <?=in_array($privilege->privilege_id,$groupPrivileges)?"checked":" "?>  id="privileges"
                      value="<?=$privilege->privilege_id?>">
               <div class="checkbox_button"></div>
               <span><?=$privilege->privilege_title ?></span>
               </label>
           <?php endforeach; endif;?>
       </div>
       <input class="no_float" type="submit" name="submit" value="<?= $text_label_save ?>">
   </fieldset>
</form>
