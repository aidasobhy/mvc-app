<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\FileUpload;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Validate;
use PHPMVC\Models\ProductCategoryModel;
use PHPMVC\Models\ProductModel;


class ProductListController extends AbstractController
{
    use Helper;
    use InputFilter;
    use Validate;

    private $_createActionRoles =
        [

            'product_name'         =>'req|alphanum|between(3,50)',
            'product_quantity'     =>'req|num',
            'buy_price'            =>'req|num' ,
            'sell_price'           =>'req|num' ,
            'unit'                 =>'req|num',
            'category_id'          =>'req|int',
        ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productlist.default');
        $this->_data['products'] = ProductModel::getAll();
        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productlist.create');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validation.errors');

         $this->_data['categories']=ProductCategoryModel::getAll();

          $uploadError = false;

         if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $product               = new ProductModel();
            $product->product_name=$this->filterString($_POST['product_name']);
            $product->product_quantity=$this->filterInt($_POST['product_quantity']);
            $product->buy_price=$this->filterFloat($_POST['buy_price']);
            $product->sell_price=$this->filterFloat($_POST['sell_price']);
            $product->unit=$this->filterInt($_POST['unit']);
            $product->category_id=$this->filterInt($_POST['category_id']);
            if (!empty($_FILES['product_image']['name'])) {
                $uploader = new FileUpload($_FILES['product_image']);
                try {
                    $uploader->upload();
                    $product->product_image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if ($uploadError === false && $product->save()) {
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
                $this->redirect('/productlist');
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
        $product = ProductModel::getByPK($id);

        if ($product === false) {
            $this->redirect('/productlist');
        }

        $this->language->load('template.common');
        $this->language->load('productlist.edit');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validation.errors');

        $this->_data['product'] = $product;
        $this->_data['categories']=ProductCategoryModel::getAll();
        $uploadError             = false;

        if (isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
                $product->product_name=$this->filterString($_POST['product_name']);
                $product->product_quantity=$this->filterInt($_POST['product_quantity']);
                $product->buy_price=$this->filterFloat($_POST['buy_price']);
                $product->sell_price=$this->filterFloat($_POST['sell_price']);
                $product->unit=$this->filterInt($_POST['unit']);
                $product->category_id=$this->filterInt($_POST['category_id']);

                if (!empty($_FILES['product_image']['name'])) {
                //remove old image
                if ($product->product_image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $product->product_image)
                && is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE . DS . $product->product_image);
                }
                //creat new image
                $uploader = new FileUpload($_FILES['product_image']);
                try {
                    $uploader->upload();
                    $product->product_image= $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if ($uploadError === false && $product->save()) {
                $this->messenger->add($this->language->get('message_create_success'), Messenger::APP_MESSAGE_SUCCESS);
                $this->redirect('/productlist');
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
        $product = ProductModel::getByPK($id);
        $this->language->load('productlist.messages');
        if ($product === false) {
            $this->redirect('/productlist');
        }

        if ($product->delete()) {
            if ($product->product_image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $product->product_image)
                && is_writable(IMAGES_UPLOAD_STORAGE)) {
                unlink(IMAGES_UPLOAD_STORAGE . DS .$product->product_image);
            }
            $this->messenger->add($this->language->get('message_delete_success'));
        }
        else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/productlist');

    }

}