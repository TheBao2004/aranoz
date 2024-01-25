<?php 

use core\Validate;

class Categories extends Controller{ 

    public $__model, $__data, $__post, $__get, $__validate, $__errors, $__olds, $__msg, $__type;  

    public function __construct(){ 
        $this->__model = $this->model("CategoriesModel", 'admin'); 
        $this->__post = Request::getRequest('post');
        $this->__get = Request::getRequest('get');
        $this->__validate = new Validate();
        $this->__errors = Session::getFlashData('errors');
        $this->__olds = Session::getFlashData('olds');
        $this->__msg = Session::getFlashData('msg');
        $this->__type = Session::getFlashData('type');
    } 

    function index($view = 'add', $id = 0){


        // Fillter
        $fillters = [];
        $this->__data['fillters'] = [];
        $get = $this->__get;
        if(!empty($get)){
            if(!empty($get['name'])){
                $name = $get['name'];
                $this->__data['fillters']['name'] = trim($name);
                $fillters['name'] = trim($name);
            }
        }
        $this->__data['fillter'] = query('?');

        $detailCate = null;
        $countCate = $this->__model->countCate($fillters);


        // Pagination
        $page = 1;
        $totalPage = ceil($countCate/_PAGE);


        // Data add and fix
        if(!empty($view) && $view == 'fix' && !empty($id) && preg_match('~^[0-9]+$~', $id)){
            $detailCate = $this->__model->detailCate($id);
            if(!empty($detailCate)){
                Session::setFlashData('id_fix', $id);
                $this->__data['dataSub']['titleAdd'] = 'Fix Category';
                $this->__data['dataSub']['olds'] = $detailCate;
                $this->__data['dataSub']['fix'] = true;
            }else{
                Session::setFlashData('msg', 'Error url');
                Session::setFlashData('type', 'danger');
                redirect("/admin/Categories");
            }
        }elseif (!empty($view) && $view == 'add'){
            $this->__data['dataSub']['titleAdd'] = 'Add Category';
        }elseif (!empty($view) && preg_match('~^page-(\d)+$~', $view, $arrPre)) {
            $page = $arrPre[1];
            if($page > $totalPage) $page = $totalPage;
            if($page <= 0) $page = 1; 
        }else{
            redirect("/admin/Categories");
        }

        $this->__data['dataSub']['errors'] = $this->__errors;

        if(empty($this->__olds)){
            $this->__data['dataSub']['olds'] = $detailCate;
        }else{
            $this->__data['dataSub']['olds'] = $this->__olds;
        }


        // Pagination
        $limitS = ($page-1)*_PAGE;
        $limitE = _PAGE;

        $allCate = $this->__model->allCate($limitS, $limitE, $fillters);


        // Data lists
        $this->__data['title'] = 'Categories';
        $this->__data['allCategories'] = $allCate;
        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;
        $this->__data['page'] = $page;
        $this->__data['totalPage'] = $totalPage;
        $this->__data['url'] = "admin.categories.index";


        // View
        $this->render('header', 'admin/layouts', $this->__data);
        $this->render('sidebar', 'admin/layouts');
        $this->render('breadcrumb', 'admin/layouts');

        $this->render('lists', 'admin/categories', $this->__data);

        $this->render('footer', 'admin/layouts');

    } 

    function addPost(){

        $datas = $this->__post;
        $rules = [
            'name' => ["required", "string"],
        ];
        $this->__validate->validate($datas, $rules);
        $errors = $this->__validate->__errors;

        if(empty($errors)){

            $new = [
                'name' => trim($datas['name']),
                'create_at' => date("Y-m-d H:i:s"),
            ];

            if($this->__model->table('categories')->insert($new)){
                Session::setFlashData('msg', 'Add success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Add failed');
                Session::setFlashData('type', 'danger');
            }

        }else{
            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $this->__post);
            Session::setFlashData('msg', 'Add failed');
            Session::setFlashData('type', 'danger');
        }

        redirect("/admin/Categories");
    }

    function fixPost(){

        $id = Session::getFlashData('id_fix');
        $datas = $this->__post;
        $rules = [
            'name' => ["required", "string"],
        ];
        $this->__validate->validate($datas, $rules);
        $errors = $this->__validate->__errors;

        if(empty($errors)){

            $new = [
                'name' => $datas['name'],
                'update_at' => date("Y-m-d H:i:s"),
            ];

            if($this->__model->table('categories')->where('id', '=', $id)->update($new)){
                Session::setFlashData('msg', 'Fix success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Fix failed');
                Session::setFlashData('type', 'danger');
            }

        }else{
            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $this->__post);
            Session::setFlashData('msg', 'Fix failed');
            Session::setFlashData('type', 'danger');
        }

        redirect("/admin/Categories/index/fix/$id");
    }

    function remove($id){
        if(!empty($id)){
            $check = $this->__model->detailCate($id, "id");
            // if(!empty($check)){
            //     if($this->__model->table('categories')->where('id', '=', $id)->delete()){
            //         Session::setFlashData('msg', 'Remove success');
            //         Session::setFlashData('type', 'success');
            //     }else{
            //         Session::setFlashData('msg', 'Remove failed');
            //         Session::setFlashData('type', 'danger');
            //     }
            // }else{
            //     Session::setFlashData('msg', 'Error not find');
            //     Session::setFlashData('type', 'danger');
            // }
        }else{
            Session::setFlashData('msg', 'Error url');
            Session::setFlashData('type', 'danger');
        }
        back();
    }

} 

?> 
