<?php
namespace PHPMVC\Lib\Database;

abstract class DatabaseHandler
{
    const DATABASE_DRIVER_PDO=1;
    const DATABASE_DRIVER_MYSQLI=2;

    public function __construct()
    {
    }
    abstract protected static function init();
    abstract protected static function getInstance();

    /**
     * @return \PDO
     */
    public static function factory()
    {
        $driver=DATABASE_CONN_DRIVER;
        if($driver==self::DATABASE_DRIVER_PDO)
        {
            return PDODatabaseHandler::getInstance();
        }elseif ($driver==self::DATABASE_DRIVER_MYSQLI)
        {
            return MYSQLiDatabaseHandler::getInstance();
        }

    }

}
?>