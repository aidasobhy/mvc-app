<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\Models\ClientModel;


class ClientsController extends AbstractController
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
        $this->_data['clients'] = ClientModel::getAll();
        $this->_view();
    }

    public function createAction()
    {

        $this->language->load('template.common');
        $this->language->load('clients.create');
        $this->language->load('clients.labels');
        $this->language->load('validation.errors');
        $this->language->load('clients.messages');


        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $client                 = new ClientModel();
            $client->name            = $this->filterString($_POST['name']);
            $client->email           = $this->filterString($_POST['email']);
            $client->phone_number    = $this->filterString($_POST['phone_number']);
            $client->address         =$this->filterString($_POST['address']);

            if ($client->save()) {
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients');
        }

        $this->_view();
    }

    public function editAction()
    {

        $id   = $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);

        if ($client === false) {
            $this->redirect('/clients');
        }

        $this->_data['client']   = $client;

        $this->language->load('template.common');
        $this->language->load('clients.edit');
        $this->language->load('clients.labels');
        $this->language->load('validation.errors');
        $this->language->load('clients.messages');

        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $client->name            = $this->filterString($_POST['name']);
            $client->email           = $this->filterString($_POST['email']);
            $client->phone_number    = $this->filterString($_POST['phone_number']);
            $client->address         =$this->filterString($_POST['address']);
            if ($client->save()) {
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients');
        }

        $this->_view();
    }

    public function deleteAction()
    {

        $id =$this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);

        if($client===false) {
            $this->redirect('/clients');
        }

        $this->language->load('clients.messages');

        if($client->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/clients');
    }

}