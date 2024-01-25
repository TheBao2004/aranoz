<?php 

class CategoriesModel extends Model{ 

    public function allCate($limitS, $limitE, $fillters=[]){
        $buidler = $this->table('categories')->limit($limitS, $limitE)->order('create_at'); 
        if(!empty($fillters)){
            $buidler = $buidler->where('name', 'LIKE', "%".$fillters['name']."%");
        }
        return $buidler = $buidler->get();
    }
    
    public function countCate($fillters=[]){
        $buidler = $this->table('categories')->select('id'); 
        if(!empty($fillters)){
            $buidler = $buidler->where('name', 'LIKE', "%".$fillters['name']."%");
        }
        return $buidler->count();
    }

    public function detailCate($id, $field='*'){
        return $this->table('categories')->select($field)->where('id', '=', $id)->first();
    }


} 

?> 

