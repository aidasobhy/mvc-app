<?php

namespace PHPMVC\Controllers;

class NotFoundController extends AbstractController
{
    public function notfoundAction()
    {
        $this->language->load('template.common');
        $this->_view();
    }

}