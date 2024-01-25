<?php 

class IndexModel extends Model{ 

    public function categories(){
        $buidler = $this->table('categories');
        return $buidler->get();
    }

    public function proHome(){
        $buidler = $this->table('products AS p')->select("p.*, i.image")->join('images AS i', "p.thumbnail=i.id", "LEFT")->where('p.status', '=', 1)->limit(18);    
        return $buidler->get();
    }

    public function product($id){

        $product = $this->getRow("SELECT p.*, MAX(m.price) AS `max_price`, MIN(m.price) AS `min_price`, MAX(m.discount) AS `max_discount`, MIN(m.discount) AS `min_discount` FROM `products` AS `p` LEFT JOIN `markets` AS `m` ON p.id=m.pro_id WHERE m.status='1' GROUP BY p.id HAVING p.id='$id'");
        return $product;

        // $buidler = $this->table('products')->where('id', '=', $id);
        // return $buidler->first();
    }

    public function variants($id){
        $result = [];
        $variants = $this->table('variants')->select("id, name, input")->where('pro_id', '=', $id)->get();
        foreach ($variants as $key => $var) {
            $result[$key]['id'] = $var['id'];
            $result[$key]['label'] = $var['name'];
            $result[$key]['input'] = $var['input'];
            $result[$key]['value'] = $this->table('variant')->select("id, value")->where('var_id', '=', $var['id'])->get();
        }
        return $result;
    }

    public function images($id){
        $buidler = $this->table('images')->where('pro_id', '=', $id);
        return $buidler->get();
    }

    public function market($arrId, $pro_id){


        $markets = $this->table('markets')->select("id, images")->where('pro_id', '=', $pro_id)->where('status', '=', 1)->get();

        $attrs = [];
        $marketId = 0;

        foreach ($markets as $key => $mk) {
            $attrs[$key] = $this->table('attrs')->select("market_id, variant_id")->where('market_id', '=', $mk['id'])->get();
        }

        foreach ($attrs as $at) {
            $variantIds = [];
            foreach ($at as $val) {
                $variantIds[] = $val['variant_id'];
            }
            if(empty(array_diff($variantIds, $arrId))){
                $marketId = $val['market_id'];
                break;
            } 
        }


        if(!empty($marketId)){

            $images = [];
            $market = $this->table('markets')->where('id', '=', $marketId)->first();
            $imageIds = $market['images'];
            $imageIds = json_decode($imageIds, true);

            foreach ($imageIds as $id) {
                $images[] = $this->table('images')->where('id', '=', $id)->first();
            }

            $response['market'] = $market; 
            $response['images'] = $images; 

            return $response;

        }else{
            return [];
        }


    }

    function orders($id){

        $orders = $this->table('orders')->where('user_id', '=', $id)->get();
        $prices = [];
        foreach ($orders as $key => $order) {

            $markets = $this->table('order_markets AS om')->select("om.*, m.price")->join('markets AS m', 'om.market_id=m.id')->where('om.order_id', '=', $order['id'])->get();
            $total = 0;
            foreach ($markets as $market) {
                $total += $market['quantity'] * $market['price'];
            }

            $prices[$key] = $total;
            
        }

        $response = [
            'orders' => $orders,
            'prices' => $prices
        ];

        return $response;

    }



} 

?> 
