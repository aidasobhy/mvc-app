<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\UserGroupPrivilegeModel;


class PrivilegesController extends AbstractController
{
    use InputFilter;
    use Helper;

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('privileges.default');
        $this->_data['privileges'] = PrivilegeModel::getAll();
        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('privileges.labels');
        $this->language->load('privileges.create');

        if (isset($_POST['submit'])) {
            $privilege                  = new PrivilegeModel();
            $privilege->privilege_title = $this->filterString($_POST['privilege_title']);
            $privilege->privilege       = $this->filterString($_POST['privilege']);
            if ($privilege->save()) {

                $this->messenger->add('تم حفظ الصلاحية بنجاح',Messenger::APP_MESSAGE_SUCCESS);
                $this->redirect('/privileges');
            }
        }
        $this->_view();
    }

    public function editAction()
    {
        $id        = $this->filterInt($this->_params[0]);
        $privilege = PrivilegeModel::getByPK($id);

        if ($privilege === false) {
            $this->redirect('/privileges');
        }

        $this->_data['privilege'] = $privilege;

        $this->language->load('template.common');
        $this->language->load('privileges.labels');
        $this->language->load('privileges.edit');

        if (isset($_POST['submit'])) {
            $privilege->privilege_title = $this->filterString($_POST['privilege_title']);
            $privilege->privilege       = $this->filterString($_POST['privilege']);
            if ($privilege->save()) {
                $this->redirect('/privileges');
            }
        }
        $this->_view();
    }

    public function deleteAction()
    {
        $id        = $this->filterInt($this->_params[0]);
        $privilege = PrivilegeModel::getByPK($id);

        if ($privilege === false) {
            $this->redirect('/privileges');
        }

        $groupPrivileges = UserGroupPrivilegeModel::getBy(['privilege_id' => $privilege->privilege_id]);

        if($groupPrivileges !==false){
            foreach ($groupPrivileges as $groupPrivilege){
                $groupPrivilege->delete();
            }
        }

        if ($privilege->delete()) {
            $this->redirect('/privileges');
        }

    }

}