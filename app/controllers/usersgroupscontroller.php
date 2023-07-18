<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserGroupPrivilegeModel;


class UsersGroupsController extends AbstractController
{
    use Helper;
    use InputFilter;

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('usersgroups.default');
        $this->_data['groups'] = UserGroupModel::getAll();
        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('usersgroups.create');
        $this->language->load('usersgroups.labels');

        $this->_data['privileges'] = PrivilegeModel::getAll();

        if (isset($_POST['submit'])) {
            $group             = new UserGroupModel();
            $group->group_name = $this->filterString($_POST['group_name']);
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';

            if ($group->save()) {
                if (isset($_POST['privileges']) && is_array($_POST['privileges'])) {
                    foreach ($_POST['privileges'] as $privilege_id) {
                        $group_privilege               = new UserGroupPrivilegeModel();
                        $group_privilege->group_id     = $group->group_id;
                        $group_privilege->privilege_id = $privilege_id;
                        $group_privilege->save();
                    }
                }
                $this->redirect('/usersgroups');
            }

        }
        $this->_view();
    }


    public function editAction()
    {

        $id    = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($id);

        if ($group === false) {
            $this->redirect('/usersgroups');
        }

        $this->language->load('template.common');
        $this->language->load('usersgroups.edit');
        $this->language->load('usersgroups.labels');

        $this->_data['group']      = $group;
        $this->_data['privileges'] = PrivilegeModel::getAll();
        $extractPrivilegesIds=  $this->_data['groupPrivileges'] = UserGroupPrivilegeModel::getGroupPrivileges($group);


        if (isset($_POST['submit'])) {
            $group->group_name = $this->filterString($_POST['group_name']);

            if ($group->save()) {
                if (isset($_POST['privileges']) && is_array($_POST['privileges'])) {
                    $privilegesIdsToBeDeleted = array_diff($extractPrivilegesIds, $_POST['privileges']);
                    $privilegesIdsToBeAdded   = array_diff($_POST['privileges'], $extractPrivilegesIds);

                    //Delete Unwanted privileges

                    foreach ($privilegesIdsToBeDeleted as $deletedPrivileges) {
                        $unwantedPrivilege = UserGroupPrivilegeModel::getBy(['privilege_id' => $deletedPrivileges, 'group_id' => $group->group_id]);
                        $unwantedPrivilege->current()->delete();
                    }

                    //Add the new privileges
                    foreach ($privilegesIdsToBeAdded as $privilege_id) {
                        $group_privilege               = new UserGroupPrivilegeModel();
                        $group_privilege->group_id     = $group->group_id;
                        $group_privilege->privilege_id = $privilege_id;
                        $group_privilege->save();
                    }
                }
                $this->redirect('/usersgroups');
            }

        }
        $this->_view();
    }

    public function deleteAction()
    {

        $id    = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($id);

        if ($group === false) {
            $this->redirect('/usersgroups');
        }

        $groupPrivileges = UserGroupPrivilegeModel::getBy(['group_id' => $group->group_id]);

        if($groupPrivileges !==false){
            foreach ($groupPrivileges as $groupPrivilege){
                $groupPrivilege->delete();
            }
        }
        if ($group->delete()) {
            $this->redirect('/usersgroups');
        }

    }

}