<?php

namespace PHPMVC\Models;

class UserGroupPrivilegeModel extends AbstractModel
{

    public $id;
    public $group_id;
    public $privilege_id;

    protected static $tableName = 'app_users_groups_privileges';
    protected static $tableSchema = array(

        'id' => self::DATA_TYPE_INT,
        'group_id' => self::DATA_TYPE_INT,
        'privilege_id' => self::DATA_TYPE_INT,
    );

    protected static $primaryKey = 'id';

    public static function getGroupPrivileges(UserGroupModel $group)
    {
        $groupPrivileges      = self::getBy(['group_id' => $group->group_id]);
        $extractPrivilegesIds = [];
        if ($groupPrivileges !== false) {
            foreach ($groupPrivileges as $privilege) {
                $extractPrivilegesIds[] = $privilege->privilege_id;
            }
        }
        return $extractPrivilegesIds;
    }


    public static function getPrivilegesForGroup($group_id)
    {
        $sql = ' SELECT augp.*, aup.privilege FROM ' . self::$tableName . ' as augp';
        $sql .= ' INNER JOIN app_users_privileges as aup ON aup.privilege_id=augp.privilege_id ';
        $sql.=' WHERE augp.group_id='.$group_id;

        $extractedUrls=[];
        $privileges=self::get($sql);
        if($privileges !== false){
            foreach ($privileges as $privilege){
                $extractedUrls[]=$privilege->privilege;
            }
        }
        return $extractedUrls;
    }

}