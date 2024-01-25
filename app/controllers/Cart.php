<?php 

use core\Validate; 

class Cart extends Controller{ 

    public $__model, $__data=[], $__post, $__get, $__validate, $__errors, $__olds, $__msg, $__type;

        public function __construct(){ 
            $this->__model = $this->model("CartModel"); 

            $this->__post = Request::getRequest('post');
            $this->__get = Request::getRequest('get');
            $this->__validate = new Validate();
            $this->__errors = Session::getFlashData('errors');
            $this->__olds = Session::getFlashData('olds');
            $this->__msg = Session::getFlashData('msg');
            $this->__type = Session::getFlashData('type');
        } 

      
        public function index(){

            if(!Auth::User()) redirect('auths/login');

            $user = Auth::User();

            $categories = $this->__model->categories();

            $carts = $this->__model->carts($user['id']);


            $this->__data['categories'] = $categories;
            $this->__data['carts'] = $carts;

            $this->__data['msg'] = $this->__msg;
            $this->__data['type'] = $this->__type;

            $this->render('header', 'client/layouts', $this->__data);
            $this->render('navbar', 'client/layouts', $this->__data);

            $this->render('cart', 'client/pages', $this->__data);

            $this->render('footer', 'client/layouts');

        }


        public function pay(){
            
            if(!Auth::User()) redirect('auths/login');

            $user = Auth::User();

            $categories = $this->__model->categories();

            $carts = $this->__model->carts($user['id']);


            $this->__data['msg'] = $this->__msg;
            $this->__data['type'] = $this->__type;
            $this->__data['errors'] = $this->__errors;
            $this->__data['olds'] = $this->__olds;

            if(empty($carts)) redirect('auths/login');


            $this->__data['categories'] = $categories;
            $this->__data['carts'] = $carts;

            $this->render('header', 'client/layouts', $this->__data);
            $this->render('navbar', 'client/layouts', $this->__data);

            $this->render('pay', 'client/pages', $this->__data);

            $this->render('footer', 'client/layouts');

        }

        public function validatePay(){

            $request = $this->__post;

            $rules = [
                'pay_type' => ['required', 'string'],
                'fullname' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'phone'],
                'address' => ['required'],
            ];

            $this->__validate->validate($request, $rules);

            $errors = $this->__validate->getErrors();

            if(empty($errors)){

                $infoOrder = [
                    'fullname' => $request['fullname'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'address' => $request['address'],
                ];

                Session::setSession('pay_type', $request['pay_type']);
                Session::setSession('infoOrder', $infoOrder);

                redirect('pay/choosePay');

            }else{
                Session::setFlashData('errors', $errors);
                Session::setFlashData('olds', $request);
                Session::setFlashData('msg', 'Đã Có Lỗi Xảy Ra');
                Session::setFlashData('type', 'danger');
            }

            back();

        }

        public function add(){

            $request = $this->__post;

            $marketId = $request['marketId'];

            $userId = Auth::User()['id'];

            $this->__model->add($userId, $marketId);

            $numberCarts = $this->__model->numberCarts($userId);
            $priceCarts = $this->__model->priceCarts($userId);
            $totalPrice = $this->__model->totalPrice($userId, $marketId);

            $response = [
                'numberCarts' => $numberCarts,
                'priceCarts' => $priceCarts,
                'totalPrice' => $totalPrice
            ];

            $json = json_encode($response);

            echo $json;

        }


        public function minus(){

            $request = $this->__post;

            $marketId = $request['marketId'];

            $userId = Auth::User()['id'];

            $this->__model->minus($userId, $marketId);

            $numberCarts = $this->__model->numberCarts($userId);
            $priceCarts = $this->__model->priceCarts($userId);
            $totalPrice = $this->__model->totalPrice($userId, $marketId);

            $response = [
                'numberCarts' => $numberCarts,
                'priceCarts' => $priceCarts,
                'totalPrice' => $totalPrice
            ];

            $json = json_encode($response);

            echo $json;

        }

        public function remove($id){

            $userId = Auth::User()['id'];

            $this->__model->remove($userId, $id);

            back();

        }


    } 

?> 
