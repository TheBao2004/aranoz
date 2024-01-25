<?php 

class PayModel extends Model{ 


    public function carts($userId){

        $carts = $this->table('carts')->where('user_id', '=', $userId)->get();
        return $carts;

    }

    public function makeOrder($userId, $pay_type, $carts, $infoOrder){

        $data = [
            'code' => time().rand(1, 100),
            'user_id' => $userId,
            'fullname' => $infoOrder['fullname'],
            'email' => $infoOrder['email'],
            'phone' => $infoOrder['phone'],
            'address' => $infoOrder['address'],
            'note' => 'New Order',
            'status' => 0,
            'create_at' => date('Y-m-d H:i:s'),
        ];

        $data['bank'] = 1;

        if($pay_type == 'cash') $data['bank'] = 0;

        $data['pay'] = $pay_type;

        if($this->table('orders')->insert($data)){

            $lastId = $this->lastId();

            foreach ($carts as $cart) {
                
                $new = [
                    'order_id' => $lastId,
                    'market_id' => $cart['market_id'],
                    'quantity' => $cart['quantity'],
                    'create_at' => date('Y-m-d H:i:s'),
                ];

                $this->table('order_markets')->insert($new);

            }

            $this->table('carts')->where('user_id', '=', $userId)->delete();

            return true;

        }

        return false;

    }




} 

?> 
