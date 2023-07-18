<?php
namespace PHPMVC\Models;

class SupplierModel extends AbstractModel
{
    public $supplier_id;
    public $name;
    public $phone_number;
    public $email;
    public $address;



    protected static $tableName = 'app_suppliers';
    protected static $tableSchema = array(
        'supplier_id'         => self::DATA_TYPE_INT,
        'name'                => self::DATA_TYPE_STR,
        'phone_number'        => self::DATA_TYPE_STR,
        'email'               => self::DATA_TYPE_STR,
        'address'             => self::DATA_TYPE_STR
    );

    protected  static $primaryKey='supplier_id';



    public function getTableName()
    {
        return self::$tableName;
    }


}