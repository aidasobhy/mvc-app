<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\SupplierModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\UserProfileModel;

class SuppliersController extends AbstractController
{

    use InputFilter;
    use Helper;

    private $_createActionRoles =
        [
            'name'              => 'req|alpha|between(3,40)',
            'email'             => 'req|email',
            'phone_number'      => 'req|alphanum|max(15)',
            'address'           => 'req|alphanum|max(50)',
        ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('suppliers.default');
        $this->_data['suppliers'] = SupplierModel::getAll();
        $this->_view();
    }

    public function createAction()
    {

        $this->language->load('template.common');
        $this->language->load('suppliers.create');
        $this->language->load('suppliers.labels');
        $this->language->load('validation.errors');
        $this->language->load('suppliers.messages');


        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $supplier                  = new SupplierModel();
            $supplier->name            = $this->filterString($_POST['name']);
            $supplier->email           = $this->filterString($_POST['email']);
            $supplier->phone_number    = $this->filterString($_POST['phone_number']);
            $supplier->address         =$this->filterString($_POST['address']);

            if ($supplier->save()) {
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/suppliers');
        }

        $this->_view();
    }

    public function editAction()
    {

        $id   = $this->filterInt($this->_params[0]);
        $supplier = SupplierModel::getByPK($id);

        if ($supplier === false) {
            $this->redirect('/suppliers');
        }

        $this->_data['supplier']   = $supplier;

        $this->language->load('template.common');
        $this->language->load('suppliers.edit');
        $this->language->load('suppliers.labels');
        $this->language->load('validation.errors');
        $this->language->load('suppliers.messages');

        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $supplier->name            = $this->filterString($_POST['name']);
            $supplier->email           = $this->filterString($_POST['email']);
            $supplier->phone_number    = $this->filterString($_POST['phone_number']);
            $supplier->address         =$this->filterString($_POST['address']);
            if ($supplier->save()) {
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/suppliers');
        }

        $this->_view();
    }

    public function deleteAction()
    {

        $id =$this->filterInt($this->_params[0]);
        $supplier = SupplierModel::getByPK($id);

        if($supplier===false) {
            $this->redirect('/suppliers');
        }

        $this->language->load('suppliers.messages');

        if($supplier->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/suppliers');
    }

}