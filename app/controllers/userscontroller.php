<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\UserProfileModel;

class UsersController extends AbstractController
{

    use InputFilter;
    use Helper;

    private $_createActionRoles =
        [
            'user_name'         => 'req|alphanum|between(3,12)',
            'first_name'        => 'req|alpha|between(3,10)',
            'last_name'         => 'req|alpha|between(3,10)',
            'password'          => 'req|min(6)|eq_field(cPassword)',
            'cPassword'         => 'req|min(6)',
            'email'             => 'req|email',
            'cEmail'            => 'req|email',
            'phone_number'      => 'alphanum|max(15)',
            'group_id'          => 'req|int'

        ];

    private $_editActionRoles =
        [

            'phone_number'     => 'alphanum|max(15)',
            'group_id'         => 'req|int'

        ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.default');
        $this->_data['users'] = UserModel::getUsers($this->session->u);
        $this->_view();
    }

    public function createAction()
    {

        $this->language->load('template.common');
        $this->language->load('users.create');
        $this->language->load('users.labels');
        $this->language->load('validation.errors');
        $this->language->load('users.messages');

        $this->_data['groups'] = UserGroupModel::getAll();

        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $user            = new UserModel();
            $user->user_name = $this->filterString($_POST['user_name']);
            $user->cryptPassword($_POST['password']);
            $user->email             = $this->filterString($_POST['email']);
            $user->phone_number      = $this->filterString($_POST['phone_number']);
            $user->group_id          = $this->filterInt($_POST['group_id']);
            $user->subscription_date = date('Y-m-d');
            $user->last_login        = date('Y-m-d H:i:s');
            $user->status            = 1;

            if (UserModel::userExists($user->user_name)) {
                $this->messenger->add($this->language->get('message_user_exists'), Messenger::APP_MESSAGE_ERROR);
                $this->redirect('/users');
            }

            if ($user->save()) {
                $userProfile=new UserProfileModel();
                $userProfile->user_id=$user->user_id;
                $userProfile->first_name=$this->filterString($_POST['first_name']);
                $userProfile->last_name=$this->filterString($_POST['last_name']);
                $userProfile->save(false);
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/users');
        }

        $this->_view();
    }

    public function editAction()
    {

        $id   = $this->filterInt($this->_params[0]);
        $user = UserModel::getByPK($id);

        if ($user === false  || $this->session->u->user_id ==$id) {
            $this->redirect('/users');
        }
        $this->language->load('template.common');
        $this->language->load('users.edit');
        $this->language->load('users.labels');
        $this->language->load('validation.errors');
        $this->language->load('users.messages');

        $this->_data['groups'] = UserGroupModel::getAll();
        $this->_data['user']   = $user;

        if (isset($_POST['submit']) && $this->isValid($this->_editActionRoles, $_POST)) {
            $user->phone_number = $this->filterString($_POST['phone_number']);
            $user->group_id     = $this->filterInt($_POST['group_id']);
            if ($user->save()) {
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/users');
        }

        $this->_view();
    }

    public function deleteAction()
    {

        $id =$this->filterInt($this->_params[0]);

        $user = UserModel::getByPK($id);
        if($user===false || $this->session->user_id==$id) {
            $this->redirect('/users');
        }

        $this->language->load('users.messages');

        if($user->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/users');
    }

    //TODO:: Make sure this is a Ajax Request
    public function checkUserExistsAjaxAction()
    {
        if (isset($_GET['user_name'])) {
            header('Content-type: text/plain');
            if (UserModel::userExists($this->filterString($_GET['user_name'])) !== false) {
                echo 1;
            }
            else {
                echo 2;
            }
        }
    }


}