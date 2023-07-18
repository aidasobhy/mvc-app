<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\FileUpload;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Validate;
use PHPMVC\Models\ProductCategoryModel;


class ProductCategoriesController extends AbstractController
{
    use Helper;
    use InputFilter;
    use Validate;

    private $_createActionRoles =
        [
            'category_name' => 'req|alphanum|between(3,30)',
        ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.default');
        $this->_data['categories'] = ProductCategoryModel::getAll();
        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.create');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validation.errors');

        $uploadError = false;

        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $category                = new ProductCategoryModel();
            $category->category_name = $this->filterString($_POST['category_name']);
            if (!empty($_FILES['category_image']['name'])) {
                $uploader = new FileUpload($_FILES['category_image']);
                try {
                    $uploader->upload();
                    $category->category_image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if ($uploadError === false && $category->save()) {
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
                $this->redirect('/productcategories');
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }


        }

        $this->_view();
    }

    public function editAction()
    {
        $id       = $this->filterInt($this->_params[0]);
        $category = ProductCategoryModel::getByPK($id);

        if ($category === false) {
            $this->redirect('/productcategories');
        }

        $this->language->load('template.common');
        $this->language->load('productcategories.edit');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validation.errors');

        $this->_data['category'] = $category;
        $uploadError             = false;

        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $category->category_name = $this->filterString($_POST['category_name']);
            if (!empty($_FILES['category_image']['name'])) {
                //remove old image
                if ($category->category_image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $category->category_image)
                 &&is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE . DS . $category->category_image);
                }
                //creat new image
                $uploader = new FileUpload($_FILES['category_image']);
                try {
                    $uploader->upload();
                    $category->category_image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if ($uploadError === false && $category->save()) {
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
                $this->redirect('/productcategories');
            }
            else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }
        $this->_view();
    }

    public function deleteAction()
    {
        $id       = $this->filterInt($this->_params[0]);
        $category = ProductCategoryModel::getByPK($id);
        $this->language->load('productcategories.messages');
        if ($category === false) {
            $this->redirect('/productcategories');
        }

        if ($category->delete()) {
            if ($category->category_image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $category->category_image)) {
                unlink(IMAGES_UPLOAD_STORAGE . DS . $category->category_image);
            }
            $this->messenger->add($this->language->get('message_delete_success'));
        }
        else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/productcategories');

    }

}