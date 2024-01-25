<?php 

use core\Validate; 
use core\DB;

class Auths extends Controller{ 

    public $__model, $__data=[], $__post, $__get, $__olds, $__errors, $__msg, $__type, $__validate; 
    
    public function __construct(){ 
        $this->__model = $this->model("AuthModel"); 

        $this->__post = Request::getRequest('post');
        $this->__get = Request::getRequest('get');

        $this->__olds = Session::getFlashData('olds');
        $this->__errors = Session::getFlashData('errors');
        $this->__msg = Session::getFlashData('msg');
        $this->__type = Session::getFlashData('type');

        $this->__validate = new Validate();

    } 

    function login(){ 

        if(!empty(Auth::User())) redirect('');  

        $this->__data['title'] = 'Đăng Nhập';
        $this->__data['errors'] = $this->__errors;
        $this->__data['olds'] = $this->__olds;
        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;

        $this->render('header', 'auth/layouts', $this->__data);

        $this->render('login', 'auth/pages', $this->__data);

        $this->render('footer', 'auth/layouts');

    } 


    function HandleLogin(){

        $request = $this->__post;

        function checkPass($request){
            $email = $request['account'];
            $users = DB::db()->table('users')->where('email', '=', $email)->first();
            if(!empty($users)){
                if(password_verify($request['password'], $users['password'])) return false;
            }
            return "error:Mật Khẩu Không Đúng";
        };

        function checkActive($request){
            $email = $request['account'];
            $users = DB::db()->table('users')->where('email', '=', $email)->first();
            if(!empty($users)){
                if($users['status'] != 1) return "error: Tài Khoản Chưa Được Kích Hoạt";
            }
        };

        
        $rules = [
            'account' => ['required', 'email', 'exists:users, email', checkActive($request)],
            'password' => ['required', checkPass($request)]
        ];

        $this->__validate->validate($request, $rules);

        $errors = $this->__validate->getErrors();

        if(empty($errors)){

            Session::setSession('account', DB::db()->table('users')->where('email', '=', $request['account'])->first());
            redirect('');

        }else{
            Session::setFlashData('olds', $request);
            Session::setFlashData('errors', $errors);
            Session::setFlashData('msg', "Đã Có Lỗi Xảy Ra");
            Session::setFlashData('type', "danger");
        }

        back();

    }

    function logout(){

        Session::removeSession('account');
        redirect('auths/logout');

    }


} 
?> 
