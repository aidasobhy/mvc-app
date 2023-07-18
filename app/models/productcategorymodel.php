<?php
namespace PHPMVC\Models;

class ProductCategoryModel extends AbstractModel
{
    public $category_id;
    public $category_name;
    public $category_image;




    protected static $tableName = 'app_products_categories';
    protected static $tableSchema = array(
        'category_id'           => self::DATA_TYPE_INT,
        'category_name'         => self::DATA_TYPE_STR,
        'category_image'        => self::DATA_TYPE_STR,

    );

    protected  static $primaryKey='category_id';

}