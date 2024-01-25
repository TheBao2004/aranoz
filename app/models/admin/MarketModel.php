<?php 

class MarketModel extends Model{ 

    public function product($id){
        return $this->table('products')->select('name')->where('id', '=', $id)->first();
    }

    public function allVariants($pro_id){
        $buidler = $this->table('variants')->where('pro_id', '=', $pro_id);
        return $buidler->get();
    }

    public function variants($var_id){
        $buidler = $this->table('variant')->where('var_id', '=', $var_id);
        return $buidler->get();
    }

    public function marketImages($arr){
        $buidler = $this->table('images');
        if(!empty($arr)){
            foreach ($arr as $value) {
               $buidler = $buidler->whereOr('id', '=', $value);
            }
        }else{
            return false;
        }
        return $buidler->get();
    }

    public function market($id){
        $buidler = $this->table('markets AS m')->select("m.*, i.image AS thumbnail")->where('m.id', '=', $id)->join('images AS i', "m.thumbnail=i.id", "LEFT");
        // echo $buidler->debug();
        // die;
        return $buidler->first();
    }

    public function markets($id){
        $buidler = $this->table('markets AS m')->select("m.*, i.image AS thumbnail, p.name")->where('m.pro_id', '=', $id)->join('products AS p', "m.pro_id=p.id")->join('images AS i', "m.thumbnail=i.id", "LEFT");
        // echo $buidler->debug();
        // die;
        return $buidler->get();
    }


    public function images($pro_id){
        return $this->table('images')->where('pro_id', '=', $pro_id)->get();
    }

    public function variantMarket($market_id){
        $buidler = $this->table('attrs AS a')->select('a.*, vs.name, vs.input, v.value')->join('variant AS v', 'a.variant_id = v.id')->join('variants AS vs', 'v.var_id = vs.id')->where('market_id', '=', $market_id);
        return $buidler->get();
    }

    public function uniqueMarket($pro_id){

        $markets = $this->table('markets')->select('id')->where('pro_id', '=', $pro_id)->get();

        $itemMarkets = [];

        foreach ($markets as $key => $mk) {
            $attrs = $this->table('attrs')->select('*')->where('market_id', '=', $mk['id'])->get();
            foreach ($attrs as $ar) {
                $itemMarkets[$key][] = $ar['variant_id'];
            }
        }

        return $itemMarkets;

    }


} 

?> 
