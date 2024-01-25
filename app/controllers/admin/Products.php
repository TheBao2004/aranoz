<?php 

use core\Validate;

class Products extends Controller{ 

    public $__model, $__data=[], $__get, $__post, $__validate, $__errors, $__olds, $__msg, $__type; 

    public function __construct(){ 
        // Model
        $this->__model = $this->model("ProductsModel", "admin");
        
        // Request
        $this->__get = Request::getRequest('get');
        $this->__post = Request::getRequest('post');

        // Validate
        $this->__validate = new Validate();
        $this->__errors = Session::getFlashData('errors');
        $this->__olds = Session::getFlashData('olds');

        // Report
        $this->__msg = Session::getFlashData('msg');
        $this->__type = Session::getFlashData('type');
    } 
    
    function index($page=''){ 

        // Fillter
        $fillters = [];
        $this->__data['fillters'] = [];
        $get = $this->__get;
        if(!empty($get)){
            if(!empty($get['name'])){
                $name = trim($get['name']);
                $this->__data['fillters']['name'] = $name;
                $fillters['name'] = $name;
            }
            if(isset($get['status']) && $get['status'] !== ""){
                $status = trim($get['status']);
                $this->__data['fillters']['status'] = $status;
                $fillters['status'] = $status;
            }
            if(!empty($get['cate_id'])){
                $cate_id = trim($get['cate_id']);
                $this->__data['fillters']['cate_id'] = $cate_id;
                $fillters['cate_id'] = $cate_id;
            }
        }
        $this->__data['fillter'] = query('?');


        // Pagination
        $countPro = $this->__model->countPro($fillters);
        $totalPage = ceil($countPro/_PAGE);
        $url = "admin/products/index";
        if(!empty($page) && preg_match('~^page-(\d)+$~', $page, $arrPre)){
            $page = $arrPre[1];
            if($page > $totalPage) $page = $totalPage;
            if($page <= 0) $page = 1; 
        }else{
            $page = 1;
        }
        $limitS = ($page-1)*_PAGE;
        $limitE = _PAGE;


        // Data List
        $this->__data['title'] = 'Products';
        $this->__data['allProducts'] = $this->__model->allPro($limitS, $limitE, $fillters);
        $this->__data['totalPage'] = $totalPage;
        $this->__data['page'] = $page;
        $this->__data['url'] = $url;
        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;


        // Data fillter
        $this->__data['fillters']['allCate'] = $this->__model->allCate();


        // View
        $this->render('header', 'admin/layouts', $this->__data);
        $this->render('sidebar', 'admin/layouts');
        $this->render('breadcrumb', 'admin/layouts');

        $this->render('lists', 'admin/products', $this->__data);

        $this->render('footer', 'admin/layouts');

    } 


    public function add(){

        // Data lists
        $this->__data['title'] = 'Add Product';
        $this->__data['allCate'] = $this->__model->allCate();
        $this->__data['errors'] = $this->__errors;
        $this->__data['olds'] = $this->__olds;
        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;


        // View
        $this->render('header', 'admin/layouts', $this->__data);
        $this->render('sidebar', 'admin/layouts');
        $this->render('breadcrumb', 'admin/layouts');

        $this->render('add', 'admin/products', $this->__data);

        $this->render('footer', 'admin/layouts');

    }

    public function addHandle(){
        
        $datas = $this->__post;
        $rules = [
            'name' => ['required'],
            'cate_id' => ['required', 'int'],
            'description' => ['required'],
            'content' => [],
        ];

        $this->__validate->validate($datas, $rules);
        $errors = $this->__validate->__errors;

        if(empty($errors)){
        // if(false){
            $new = [
                'cate_id' => trim($datas['cate_id']),
                'name' => trim($datas['name']),
                'description' => trim($datas['description']),
                'content' => $datas['content'],
                'create_at' => date('Y-m-d H:i:s'),
            ];
            if(!empty($datas['status'])) $new['status'] = trim($datas['status']);
            if($this->__model->table('products')->insert($new)){
                Session::setFlashData('msg', 'Add product success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Add product failed');
                Session::setFlashData('type', 'danger');
            }
        }else{
            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $datas);
            Session::setFlashData('msg', 'Add product failed');
            Session::setFlashData('type', 'danger');
        }

        back();
    }

    public function fix($id){

        // Check fix
        if(!empty($id)){
            $detail = $this->__model->detailPro($id);
            if(!empty($detail)){
                Session::setFlashData('id_fix', $id);
            }else{
                Session::setFlashData('msg', 'Error not find');
                Session::setFlashData('type', 'danger');
                back();
            }
        }else{
            Session::setFlashData('msg', 'Error url');
            Session::setFlashData('type', 'danger');
            back();
        }

        $allImages = $this->__model->allImages($id);

        // Data lists
        $olds = $this->__olds;
        if(empty($olds)){
            $olds = $detail;
        }
        $this->__data['title'] = ucfirst($detail['name']);
        $this->__data['product'] = html_entity_decode('<span class="text-primary">'.ucfirst($detail['name']).'</span>');
        $this->__data['allCate'] = $this->__model->allCate();
        $this->__data['errors'] = $this->__errors;
        $this->__data['olds'] = $olds;
        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;
        $this->__data['allImages'] = $allImages;
        $this->__data['pro_id'] = $id;


        // View
        $this->render('header', 'admin/layouts', $this->__data);
        $this->render('sidebar', 'admin/layouts');
        $this->render('breadcrumb', 'admin/layouts');

        $this->render('fix', 'admin/products', $this->__data);

        $this->render('footer', 'admin/layouts');

    }

    public function fixHandle(){

        $id = Session::getFlashData('id_fix');
        
        // Check fix
        if(!empty($id)){

        }else{
            Session::setFlashData('msg', 'Error url');
            Session::setFlashData('type', 'danger');
            back();
        }


        // Data add
        $datas = $this->__post;
        $rules = [
            'name' => ['required'],
            'cate_id' => ['required', 'int'],
            'description' => ['required'],
            'content' => [],
        ];

        $this->__validate->validate($datas, $rules);
        $errors = $this->__validate->__errors;

        if(empty($errors)){
        // if(false){
            $new = [
                'cate_id' => trim($datas['cate_id']),
                'name' => trim($datas['name']),
                'description' => trim($datas['description']),
                'content' => $datas['content'],
                'update_at' => date('Y-m-d H:i:s'),
            ];
            if(!empty($datas['status'])) $new['status'] = trim($datas['status']);
            if(empty($datas['status'])) $new['status'] = trim($datas['status']);
            if($this->__model->table('products')->where('id', '=', $id)->update($new)){
                Session::setFlashData('msg', 'Fix product success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Fix product failed');
                Session::setFlashData('type', 'danger');
            }
        }else{
            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $datas);
            Session::setFlashData('msg', 'Fix product failed');
            Session::setFlashData('type', 'danger');
        }

        back();
    }

    public function image($id=0){

        if(!empty($id) && preg_match('~^\d+$~', $id)){
            $detail = $this->__model->detailPro($id);
            if(!empty($detail)){
                Session::setFlashData('add_image', $id);
            }else{
                redirect('admin/products/image');
            }
        }


        // Data lists
        if(!empty($detail)){
            $this->__data['title'] = ucfirst($detail['name']);
            $this->__data['self'] = true;
        }else{
            $this->__data['title'] = 'Images';
        }
        $this->__data['allImages'] = $this->__model->allImages($id);
        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;
        // Data add
        $this->__data['dataSub']['title'] = 'Add Image';


        // View
        $this->render('header', 'admin/layouts', $this->__data);
        $this->render('sidebar', 'admin/layouts');
        $this->render('breadcrumb', 'admin/layouts');

        $this->render('images', 'admin/products', $this->__data);

        $this->render('footer', 'admin/layouts');

    }


    public function imageHandle(){

        $id = Session::getFlashData('add_image');
        if(empty($id)) redirect('admin/products/image');
        $files = $_FILES['images'];
        $arrName = $files['name'];
        $arrType = $files['type'];
        $arrTmp = $files['tmp_name'];
        $check = true;

        //Validate
        if(!empty($arrType)){
            foreach ($arrType as $vali) {
                if(!preg_match('~^image/~', $vali)){
                    $check = false;
                    break;
                }
            }
        }
       
        if(!empty($arrName)){
            if(!empty($check)){
                foreach ($arrName as $key => $value) {
                    $nameImg = $key.time().'_'.$value;
                    $toFolder = image($nameImg, 'client', true);
                    move_uploaded_file($arrTmp[$key], $toFolder);
                    $new = [
                        'pro_id' => $id,
                        'image' => $nameImg,
                        'create_at' => date('Y-m-d H:i:s')
                    ];
                    $this->__model->table('images')->insert($new); 
                }
                Session::setFlashData('msg', 'Add image success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Add image failed');
                Session::setFlashData('type', 'danger');
            }
        }else{
            Session::setFlashData('msg', 'Add image failed');
            Session::setFlashData('type', 'danger');
        }
        back();
    }

    public function removeImages($id){
        $image = $this->__model->itemImage($id);
        if(!empty($image)){
            if($this->__model->table('images')->where('id', '=', $id)->delete()){
                $img = $image['image'];
                $path = image($img, 'client', true);
                if(file_exists($path)){
                    unlink($path);
                }
                Session::setFlashData('msg', 'Remove image success');
                Session::setFlashData('type', 'success');
            }else{
                Session::setFlashData('msg', 'Remove image failed');
                Session::setFlashData('type', 'danger');
            }
            back();
        }else{
            redirect('admin/products/image');
        }
    }


    public function handleThumbnail(){

        $requests = $this->__post;

        $datas = [
            'thumbnail' => $requests['id'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->__model->table('products')->where('id', '=', $requests['pro_id'])->update($datas);

    }


} 

?> 
