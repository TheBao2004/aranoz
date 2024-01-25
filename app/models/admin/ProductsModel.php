<?php 

class ProductsModel extends Model{ 

    public function allPro($limitS, $limitE, $fillters=[]){ 
        $buidler = $this->table("products AS p")->select("p.*, c.name AS 'cate_name'")->join('categories AS c', 'p.cate_id=c.id')->order('p.create_at')->limit($limitS, $limitE);
        if(!empty($fillters)){
            if(!empty($fillters['name'])){
                $buidler = $buidler->where('p.name', 'LIKE', "%".$fillters['name']."%");
            } 
            if(isset($fillters['status'])) $buidler = $buidler->where('status', '=', $fillters['status']);
            if(!empty($fillters['cate_id'])) $buidler = $buidler->where('cate_id', '=', $fillters['cate_id']);
        } 
        return $buidler->get();
    } 

    public function countPro($fillters=[]){
        $buidler = $this->table("products AS p")->select("p.id")->join('categories AS c', 'p.cate_id=c.id');
        if(!empty($fillters)){
            if(!empty($fillters['name'])){
                $buidler = $buidler->where('p.name', 'LIKE', "%".$fillters['name']."%");
            } 
            if(isset($fillters['status'])) $buidler = $buidler->where('status', '=', $fillters['status']);
            if(!empty($fillters['cate_id'])) $buidler = $buidler->where('cate_id', '=', $fillters['cate_id']);
        } 
        return $buidler->count();
    }

    public function allCate(){
        return $this->table('categories')->get();
    }

    public function detailPro($id){
        return $this->table('products AS p')->select("p.*, i.image")->join('images AS i', 'p.thumbnail=i.id', 'LEFT')->where('p.id', '=', $id)->first();
    }

    public function allImages($id=0){
        $buidler = $this->table('images AS i')->select("i.*, p.name AS 'pro_name'")->join('products AS p', 'i.pro_id=p.id');
        if(!empty($id)) $buidler = $buidler->where('i.pro_id', '=', $id);
        return $buidler->get();
    }

    public function itemImage($id){
        return $this->table('images')->where('id', '=', $id)->first();
    }

    public function countImage($id=0){
        $buidler = $this->table('images')->select('id');
        if(!empty($id)) $buidler = $buidler->where('id', '=', $id);
        return $buidler->count();
    }

} 

?> 
