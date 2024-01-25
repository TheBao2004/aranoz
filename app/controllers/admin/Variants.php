<?php 

use core\Validate;

class Variants extends Controller{ 

    public $__model, $__data=[], $__get, $__post, $__validate, $__errors, $__olds, $__msg, $__type; 

    public function __construct(){ 
        $this->__model = $this->model("VariantsModel", 'admin'); 

        // Request
        $this->__get = Request::getRequest('get');
        $this->__post = Request::getRequest('post');

        // Validate
        $this->__validate = new Validate();
        $this->__errors = Session::getFlashData('errors');
        $this->__olds = Session::getFlashData('olds');
        $this->__msg = Session::getFlashData('msg');
        $this->__type = Session::getFlashData('type');

    }   

    function index($pro_id, $view='add', $id=0){ 

        // Check
        if(!empty($pro_id)){
            $product = $this->__model->product($pro_id);
            if(!empty($product)){
                Session::setFlashData('pro_id', $pro_id);
            }else{
                redirect(_WEB_HOST_ADMIN, true);
            }
        }else{
            redirect(_WEB_HOST_ADMIN, true);
        }


        // Data 
        $allVariants = $this->__model->allVariants($pro_id);
        $this->__data['title'] = ucfirst($product['name']);
        $this->__data['allVariants'] = $allVariants;
        Session::setFlashData('count', count($allVariants));
        $this->__data['pro_id'] = $pro_id;
        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;
        // DataSub
        if($view == 'add'){
            $this->__data['dataSub']['title'] = 'Add Variant';
        }elseif ($view == 'fix') {
            $detail = $this->__model->detailVari($id);
            if(!empty($detail)){
                $this->__data['dataSub']['title'] = 'Fix Variant';
                Session::setSession('id_fix', $id);
            }else{
                redirect(_WEB_HOST_ADMIN, true);
            }
        }else{
            redirect(_WEB_HOST_ADMIN, true);
        }

        $this->__data['dataSub']['errors'] = $this->__errors;
        $olds = $this->__olds;
        if(empty($olds) && !empty($detail)){
            $olds = $detail;
        }
        $this->__data['dataSub']['olds'] = $olds;
        if($view == 'add'){
            $handle = 'addHandle';
        }elseif ($view == 'fix'){
            $handle = 'fixHandle';
        }
        $this->__data['dataSub']['handle'] = $handle;
        $this->__data['dataSub']['add_fix'] = $view;
        $this->__data['dataSub']['pro_id'] = $pro_id;

        // View
        $this->render('header', 'admin/layouts', $this->__data);
        $this->render('sidebar', 'admin/layouts');
        $this->render('breadcrumb', 'admin/layouts');

        $this->render('lists', 'admin/variants', $this->__data);

        $this->render('footer', 'admin/layouts');



    } 


    public function addHandle(){

        $pro_id = Session::getFlashData('pro_id');

        $count = Session::getFlashData('count');

        if($count >= 2){
            Session::setFlashData('msg', 'Variant not too much 2');
            Session::setFlashData('type', 'danger');
            back();
        } 

        if(empty($pro_id)) redirect(_WEB_HOST_ADMIN, true);

        $datas = $this->__post;
        $rules = [
            'name' => ['required', 'string'],
            'input' => ['required', 'in: text, color']
        ];

        $this->__validate->validate($datas, $rules);

        $errors = $this->__validate->getErrors();

        if(empty($errors)){
            $new = [
                'pro_id' => $pro_id,
                'name' => $datas['name'],
                'input' => $datas['input'],
                'create_at' => date('Y-m-d H:i:s')
            ];
            if($this->__model->table('variants')->insert($new)){
                Session::setFlashData('msg', 'Add variant success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Add variant failed');
                Session::setFlashData('type', 'danger');
            }
        }else{
            Session::setFlashData('msg', 'Add variant failed');
            Session::setFlashData('type', 'danger');
            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $datas);
        }
        back();
    }

    public function fixHandle(){

        $id = Session::getSession('id_fix');

        if(empty($id)) redirect(_WEB_HOST_ADMIN, true);

        $datas = $this->__post;
        $rules = [
            'name' => ['required', 'string'],
            'input' => ['required', 'in: text, color']
        ];

        $this->__validate->validate($datas, $rules);

        $errors = $this->__validate->getErrors();

        if(empty($errors)){
            $new = [
                'name' => $datas['name'],
                'input' => $datas['input'],
                'update_at' => date('Y-m-d H:i:s')
            ];
            if($this->__model->table('variants')->where('id', '=', $id)->update($new)){
                Session::setFlashData('msg', 'Fix variant success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Fix variant failed');
                Session::setFlashData('type', 'danger');
            }
        }else{
            Session::setFlashData('msg', 'Fix variant failed');
            Session::setFlashData('type', 'danger');
            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $datas);
        }
        back();
    }


    public function variant($var_id=0, $view='add', $id=0){

        $variant = $this->__model->detailVari($var_id);
        $pro_id = $this->__model->detailVari($var_id, false, "pro_id")['pro_id'];

        if(!empty($var_id) && !empty($variant)){
            Session::setFlashData('var_id', $var_id);
        }else{
            redirect(_WEB_HOST_ADMIN, true);
        }


        // Data 
        $this->__data['title'] = $variant['name'];
        $this->__data['var_id'] = $var_id;
        $this->__data['pro_id'] = $pro_id;
        $this->__data['variants'] = $this->__model->variants($var_id);
        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;
        // Data sub

        if($view == 'fix'){
            $detail = $this->__model->variant($id);
            if(!empty($detail)){
            $this->__data['dataSub']['handle'] = "fixVariant";
            $this->__data['dataSub']['title'] = "Fix Item";
            Session::setSession('id_fix', $id);
            }else{
                redirect(_WEB_HOST_ADMIN, true);
            }
        }elseif ($view == 'add') {
            $this->__data['dataSub']['handle'] = "addVariant";
            $this->__data['dataSub']['title'] = "Add Item";
        }else{
            redirect(_WEB_HOST_ADMIN, true);
        }

        $this->__data['dataSub']['errors'] = $this->__errors;
        $olds = $this->__olds;
        if(empty($olds) && !empty($detail)) $olds = $detail;
        $this->__data['dataSub']['olds'] = $olds;
        $this->__data['dataSub']['add_fix'] = $view;
        $this->__data['dataSub']['input'] = $variant['input'];
        $this->__data['dataSub']['var_id'] = $var_id;


        $this->render('header', "admin/layouts", $this->__data);
        $this->render('sidebar', "admin/layouts");
        $this->render('breadcrumb', "admin/layouts");

        $this->render('lists_variant', 'admin/variants', $this->__data);

        $this->render('footer', "admin/layouts");


    }


    public function addVariant(){

        $var_id = Session::getFlashData('var_id');

        if(empty($var_id)) redirect(_WEB_HOST_ADMIN, true);

        $datas = $this->__post;
        $rules = [
            'value' => ['required'],
        ];

        $this->__validate->validate($datas, $rules);

        $errors = $this->__validate->getErrors();   

        if(empty($errors)){
            $new = [
                'var_id' => $var_id,
                'value' => $datas['value'],
                'create_at' => date('Y-m-d H:i:s')
            ];
            if($this->__model->table('variant')->insert($new)){
                Session::setFlashData('msg', 'Add item success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Add item failed');
                Session::setFlashData('type', 'danger');
            }
        }else{
            Session::setFlashData('msg', 'Add item failed');
            Session::setFlashData('type', 'danger');
            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $datas);
        }

        back();

    }



    public function fixVariant(){

        $id = Session::getSession('id_fix');

        if(empty($id)) redirect(_WEB_HOST_ADMIN, true);

        $datas = $this->__post;
        $rules = [
            'value' => ['required'],
        ];

        $this->__validate->validate($datas, $rules);

        $errors = $this->__validate->getErrors();   

        if(empty($errors)){
            $new = [
                'value' => $datas['value'],
                'update_at' => date('Y-m-d H:i:s')
            ];
            if($this->__model->table('variant')->where('id', '=', $id)->update($new)){
                Session::setFlashData('msg', 'Fix item success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Fix item failed');
                Session::setFlashData('type', 'danger');
            }
        }else{
            Session::setFlashData('msg', 'Fix item failed');
            Session::setFlashData('type', 'danger');
            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $datas);
        }

        back();

    }








} 

?> 
