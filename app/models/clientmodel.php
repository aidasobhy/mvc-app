<?php
namespace PHPMVC\Models;

class ClientModel extends AbstractModel
{
    public $client_id;
    public $name;
    public $phone_number;
    public $email;
    public $address;



    protected static $tableName = 'app_clients';
    protected static $tableSchema = array(
        'client_id'           => self::DATA_TYPE_INT,
        'name'                => self::DATA_TYPE_STR,
        'phone_number'        => self::DATA_TYPE_STR,
        'email'               => self::DATA_TYPE_STR,
        'address'             => self::DATA_TYPE_STR
    );

    protected  static $primaryKey='client_id';



    public function getTableName()
    {
        return self::$tableName;
    }


}