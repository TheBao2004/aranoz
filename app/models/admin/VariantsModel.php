<?php 

class VariantsModel extends Model{ 

    public function product($id){
        return $this->table('products')->select('name')->where('id', '=', $id)->first();
    }

    public function detailVari($id, $count=false, $field="*"){
        $buidler = $this->table('variants')->select($field)->where('id', '=', $id);
        if(!empty($count)) return $buidler->count();
        return $buidler->first();
    }

    public function allVariants($pro_id){
        $buidler = $this->table('variants')->where('pro_id', '=', $pro_id);
        return $buidler->get();
    }

    public function variant($id){
        $buidler = $this->table('variant')->where('id', '=', $id);
        return $buidler->first();
    }

    public function variants($var_id){
        $buidler = $this->table('variant')->where('var_id', '=', $var_id);
        return $buidler->get();
    }

    

} 

?> 
