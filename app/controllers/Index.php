<?php 

use core\Validate; 
class Index extends Controller{ 
    public $__model, $__data=[], $__post, $__get, $__validate, $__errors, $__olds, $__msg, $__type;  

    public function __construct(){ 
        $this->__model = $this->model("IndexModel"); 

        $this->__post = Request::getRequest('post');
        $this->__get = Request::getRequest('get');
        $this->__validate = new Validate();
        $this->__errors = Session::getFlashData('errors');
        $this->__olds = Session::getFlashData('olds');
        $this->__msg = Session::getFlashData('msg');
        $this->__type = Session::getFlashData('type');

    } 

    function index(){ 
        
        $categories = $this->__model->categories();
        $proHome = $this->__model->proHome();

        $this->__data['title'] = "Trang chủ";
        $this->__data['categories'] = $categories;
        $this->__data['proHome'] = $proHome;

        $slide = true;
        $this->__data['slide'] = $slide;

        $this->render('header', 'client/layouts', $this->__data);
        $this->render('navbar', 'client/layouts', $this->__data);

        $this->render('home', 'client/pages', $this->__data);

        $this->render('footer', 'client/layouts');

    } 

    public function product($id){

        $product = $this->__model->product($id);
        if(empty($product)) redirect('');

        $variants = $this->__model->variants($id);
        $categories = $this->__model->categories();
        $images = $this->__model->images($id);


        $this->__data['title'] = "";
        $this->__data['categories'] = $categories;
        $this->__data['variants'] = $variants;
        $this->__data['product'] = $product;
        $this->__data['images'] = $images;
        $this->__data['pro_id'] = $id;

        $this->render('header', 'client/layouts', $this->__data);
        $this->render('navbar', 'client/layouts', $this->__data);

        $this->render('product', 'client/pages', $this->__data);

        $this->render('footer', 'client/layouts');

    }

    public function findProduct(){

        $request = $this->__post;

        $arrId = $request['arrId'];
        $quantity = $request['quantity'];
        $pro_id = $request['pro_id'];

        if(count($arrId) != $quantity){
            $response = [];
        }else{
            $datas = $this->__model->market($arrId, $pro_id);
            $market = $datas['market'];
            $images = $datas['images'];
            $price = $market['price'];
            $discount = $market['discount'];
            $id = $market['id'];

            $carousel = '';

            foreach ($images as $key => $img) { 
                $active = '';
                if($key == 0) $active = "active";
                $carousel .= '
                <div class="carousel-item '.$active.'">
                <img class="w-100 h-100" src="'.image($img['image']).'" alt="Image">
                </div>
                ';
            }

            $response['carousel'] = $carousel;
            $response['price'] = $price;
            $response['id'] = $id;
            
        }


        $json = json_encode($response);

        echo $json;

        // return $json;

    }

    function infor(){

        $user = Auth::User();

        if(empty($user)) redirect('');

        $categories = $this->__model->categories();

        $this->__data['title'] = 'Thông Tin Tài Khoản';
        $this->__data['categories'] = $categories;

        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;
        $olds = $this->__olds;
        if(empty($olds)) $olds = Auth::User();
        $this->__data['olds'] = $olds;
        $this->__data['errors'] = $this->__errors;
        
        $this->render('header', 'client/layouts', $this->__data);
        $this->render('navbar', 'client/layouts', $this->__data);

        $this->render('info', 'client/pages', $this->__data);

        $this->render('footer', 'client/layouts');

    }

    function handleInfor(){

        $user = Auth::User();

        $request = $this->__post;

        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,'.$user['id']],
            'phone'=> ['required', 'phone', 'unique:users,phone,'.$user['id']],
            'address' => ['required'],
        ];



        $this->__validate->validate($request, $rules);

        $errors = $this->__validate->getErrors();

        if(empty($errors)){


            $datas = [
                'name' => $request['name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
            ];

            if(!empty($_FILES['image']['name'])){

                $image = $_FILES['image'];
                $nameImage = time().'_'.$image['name'];
                $toFile =  image('', 'client', true).$nameImage;

                //chỉ xóa khi update
                if(file_exists(image('', 'client', true).$user['image']) && !empty($user['image'])){
                    unlink(image('', 'client', true).$user['image']);
                }
          
                move_uploaded_file($image['tmp_name'], $toFile);
                $datas['image'] = $nameImage;

            }

            // echo '<pre>';
            // print_r($datas);
            // echo '</pre>';

            // die;
            $status = $this->__model->table('users')->where('id', '=', $user['id'])->update($datas);

            if($status){
                

                Session::setFlashData('msg', 'Cập Nhập Thành Công');
                Session::setFlashData('type', 'success');
            }

        }else{
            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $request);
            Session::setFlashData('msg', 'Đã Có Lỗi Xảy Ra');
            Session::setFlashData('type', 'danger');
        }

        back();

    }



    function order(){

        $user = Auth::User();

        if(empty($user)) redirect('');

        $categories = $this->__model->categories();

        $this->__data['title'] = 'Lịch Sử Đơn Hàng';
        $this->__data['categories'] = $categories;

        $response = $this->__model->orders($user['id']);

        $this->__data['orders'] = $response['orders'];
        $this->__data['prices'] = $response['prices'];
        $this->__data['olds'] = $user;

        $this->render('header', 'client/layouts', $this->__data);
        $this->render('navbar', 'client/layouts', $this->__data);

        $this->render('order', 'client/pages', $this->__data);

        $this->render('footer', 'client/layouts');

    }









} 

?> 
