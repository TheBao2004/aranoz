<?php 
    use core\Validate; 
    class Pay extends Controller{ 

        public $__model, $__data=[], $__msg, $__type; 

        public function __construct(){ 

        if(!Auth::User()) redirect('');

        $this->__model = $this->model("PayModel"); 

        // $this->__msg = Session::getFlashData('msg');
        // $this->__type = Session::getFlashData('type');

        } 
        function choosePay(){ 

            $pay_type = Session::getSession('pay_type');

            switch ($pay_type) {
                case 'cash':

                    redirect('pay/handleCash');

                    break;

                case 'momo_qr':

                    Session::setFlashData('msg', 'Phương Thức Thanh Toán Này Đang Bảo Trì');
                    Session::setFlashData('type', 'danger');
                    redirect('cart/pay');

                    break;

                case 'momo_atm':

                    Session::setFlashData('msg', 'Phương Thức Thanh Toán Này Đang Bảo Trì');
                    Session::setFlashData('type', 'danger');
                    redirect('cart/pay');

                    break;

                case 'vnpay':

                    Session::setFlashData('msg', 'Phương Thức Thanh Toán Này Đang Bảo Trì');
                    Session::setFlashData('type', 'danger');
                    redirect('cart/pay');

                    break;

                case 'paypal':

                    Session::setFlashData('msg', 'Phương Thức Thanh Toán Này Đang Bảo Trì');
                    Session::setFlashData('type', 'danger');
                    redirect('cart/pay');

                    break;

                
                default:

                Session::setFlashData('msg', 'Có Lỗi Về Phương Thức Thanh Toán');
                Session::setFlashData('type', 'danger');
                redirect('cart/pay');

                    break;
            }

        } 


        public function handleCash(){

            $user = Auth::User();
            $pay_type = Session::getSession('pay_type');

            $carts = $this->__model->carts($user['id']);

            $infoOrder = Session::getSession('infoOrder');

            if($this->__model->makeOrder($user['id'], $pay_type, $carts, $infoOrder)){

                Session::setFlashData('msg', 'Cảm Ơn Đã Mua Hàng');
                Session::setFlashData('type', 'success');
           
                redirect('cart');

            }

            redirect('');

        }
  
    } 
?> 
