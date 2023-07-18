<?php

namespace PHPMVC\Models;

class UserProfileModel extends AbstractModel
{

    public $user_id;
    public $first_name;
    public $last_name;
    public $address;
    public $birth_date;
    public $image;

    protected static $tableName = 'app_users_profiles';
    protected static $tableSchema = array(
        'user_id'                   => self::DATA_TYPE_INT,
        'first_name'                => self::DATA_TYPE_STR,
        'last_name'                 => self::DATA_TYPE_STR,
        'address'                   => self::DATA_TYPE_STR,
        'birth_date'                => self::DATA_TYPE_DATE,
        'image'                     => self::DATA_TYPE_STR,
    );

    protected static $primaryKey = 'user_id';



}