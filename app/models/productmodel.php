<?php
namespace PHPMVC\Models;

class ProductModel extends AbstractModel
{
    public $product_id;
    public $product_name;
    public $product_image;
    public $product_quantity;
    public $sell_price;
    public $buy_price;
    public $unit;
    public $product_code;
    public $category_id;


    protected static $tableName = 'app_products_list';
    protected static $tableSchema = array(
        'product_id'           => self::DATA_TYPE_INT,
        'product_name'         => self::DATA_TYPE_STR,
        'product_image'        => self::DATA_TYPE_STR,
        'product_quantity'     => self::DATA_TYPE_INT,
        'sell_price'           => self::DATA_TYPE_DECIMAL,
        'buy_price'            => self::DATA_TYPE_DECIMAL,
        'unit'                 => self::DATA_TYPE_INT,
        'product_code'         => self::DATA_TYPE_STR,
        'category_id'          => self::DATA_TYPE_INT,

    );

    protected  static $primaryKey='product_id';

    public static function getAll()
    {
       $sql=' SELECT apl.*,apc.category_name FROM '.self::$tableName.' as apl';
       $sql.=' INNER JOIN '.ProductCategoryModel::getModelTableName().' as apc';
       $sql.=' ON apc.category_id=apl.category_id';
      return self::get($sql);

    }

}