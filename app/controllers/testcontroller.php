<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Validate;
use PHPMVC\Models\SupplierModel;
use PHPMVC\Models\UserGroupPrivilegeModel;
use PHPMVC\Models\UserModel;

class TestController extends  AbstractController
{
    use Validate;
    public function defaultAction()
    {

        echo '<pre>';
         phpinfo();
        echo '</pre>';
    }
}