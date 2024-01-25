<?php 

    class CartModel extends Model{ 

        public function categories(){
            $buidler = $this->table('categories');
            return $buidler->get();
        }

        public function add($userId, $marketId){

            $cart = $this->table('carts')->where('user_id', '=', $userId)->where('market_id', '=', $marketId)->first();

            if(!empty($cart)){

                $quantity = $cart['quantity'] + 1;

                $datas = [
                    'quantity' => $quantity
                ];

                $this->table('carts')->where('user_id', '=', $userId)->where('market_id', '=', $marketId)->update($datas);

            }else{

                $datas = [
                    'user_id' => $userId,
                    'market_id' => $marketId,
                    'quantity' => 1 
                ];

                $this->table('carts')->insert($datas);

            }

        }

        public function minus($userId, $marketId){

            $cart = $this->table('carts')->where('user_id', '=', $userId)->where('market_id', '=', $marketId)->first();

            if(!empty($cart)){

                $quantity = $cart['quantity'] - 1;

                if($quantity <= 1) $quantity = 1;

                $datas = [
                    'quantity' => $quantity
                ];

                $this->table('carts')->where('user_id', '=', $userId)->where('market_id', '=', $marketId)->update($datas);

            }

        }

        public function carts($userId){

            $carts = $this->table('carts')->where('user_id', '=', $userId)->get();

            if(!empty($carts)){

                $response = [];

                foreach ($carts as $key => $cart) {

                    $market = $this->table('markets AS m')->select('m.*, name')->join('products AS p', "m.pro_id=p.id")->where('m.id', '=', $cart['market_id'])->first();

                    $thumbnail = $this->table('images')->where('id', '=', $market['thumbnail'])->first();
                
                    $attrs = $this->table('attrs')->where('market_id', '=', $market['id'])->get();

                    $variants = [];

                    foreach ($attrs as $key => $at) {
                        $variant = $this->table('variant AS v')->select('v.*, vs.name, vs.input')->join('variants AS vs', 'v.var_id=vs.id')->where('v.id', '=', $at['variant_id'])->first();
                        $variants[$key] = [
                            'label' => $variant['name'],
                            'input' => $variant['input'],
                            'value' => $variant['value']
                        ];
                    }
                    
                    $response[] = [
                        'id' => $market['id'],
                        'name' => $market['name'],
                        'thumbnail' => $thumbnail['image'],
                        'variants' => $variants,
                        'price' => $market['price'],
                        'quantity' => $cart['quantity']
                    ];
                
                }

                return $response;

            }

            return false;

        }

        function numberCarts($userId){

            if(empty($userId)) return 0;
            $carts = $this->table('carts')->where('user_id', '=', $userId)->get();
            if(!empty($carts)){
                $quantity = 0;
                foreach ($carts as $key => $cart) {
                    $quantity += $cart['quantity'];
                }
                return $quantity;
            }else{
                return 0;
            }

        }

        function priceCarts($userId){

            if(empty($userId)) return 0;
            $carts = $this->table('carts')->where('user_id', '=', $userId)->get();
            if(!empty($carts)){
                $total = 0;
                foreach ($carts as $key => $cart) {
                    $market = $this->table('markets')->where('id', '=', $cart['market_id'])->first();
                    $total += $market['price'] * $cart['quantity'];
                }
                return $total;
            }else{
                return 0;
            }

        }

        function totalPrice($userId, $marketId){

            if(empty($marketId)) return 0;

            $cart = $this->table('carts')->where('user_id', '=', $userId)->where('market_id', '=', $marketId)->first();

            if(empty($cart)) return 0;

            $market = $this->table('markets')->where('id', '=', $marketId)->first();

            $sum = $cart['quantity'] * $market['price'];

            return $sum;

        }

        function remove($userId, $marketId){

            $cart = $this->table('carts')->where('user_id', '=', $userId)->where('market_id', '=', $marketId)->first();
            if(empty($cart)) return false;
            $this->table('carts')->where('user_id', '=', $userId)->where('market_id', '=', $marketId)->delete();
            return true;
            
        }


    } 

?> 
