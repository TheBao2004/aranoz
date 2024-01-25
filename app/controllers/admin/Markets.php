<?php 

use core\Validate; 

class Markets extends Controller{ 

    public $__model, $__data=[], $__post, $__get, $__olds, $__errors, $__validate, $__msg, $__type; 

    public function __construct(){
        $this->__model = $this->model("MarketModel", 'admin'); 


        // Responses
        $this->__get = Request::getRequest('get');
        $this->__post = Request::getRequest('post');

        $this->__olds = Session::getFlashData('olds');
        $this->__errors = Session::getFlashData('errors');
        $this->__msg = Session::getFlashData('msg');
        $this->__type = Session::getFlashData('type');

        $this->__validate = new Validate();

    }

    function index($pro_id){

        

        $markets = $this->__model->markets($pro_id);

        $this->__data['markets'] = $markets;
        $this->__data['pro_id'] = $pro_id;

        if(!empty($markets)) $this->__data['title'] = ucfirst($markets[0]['name']); 

        $this->render('header', 'admin/layouts', $this->__data);
        $this->render('sidebar', 'admin/layouts');
        $this->render('breadcrumb', 'admin/layouts');

        $this->render('lists', 'admin/markets', $this->__data);

        $this->render('footer', 'admin/layouts');


    }

    function add($pro_id){ 

        // Session::setFlashData('add_id', $pro_id);
        Session::setSession('add_id', $pro_id);

        $allVariants = $this->__model->allVariants($pro_id);
        
        $varTitles = [];
        $varInputs = [];
        $varTypes = [];

        foreach ($allVariants as $key => $value) {
            $varTitles[$key] = $value['name'];
            $varTypes[$key] = $value['input'];
            $varInputs[$key] = $this->__model->variants($value['id']);
        }

        $numberVariant = count($varTitles);
        Session::setSession('numberVariant', $numberVariant);
        
        $this->__data['pro_id'] = $pro_id;

        $this->__data['varTitles'] = $varTitles;
        $this->__data['varInputs'] = $varInputs;
        $this->__data['varTypes'] = $varTypes;

        $olds = $this->__olds;
        $this->__data['olds'] = $olds;
        $this->__data['errors'] = $this->__errors;
        $this->__data['msg'] = $this->__msg;
        $this->__data['type'] = $this->__type;

        $this->render('header', 'admin/layouts', $this->__data);
        $this->render('sidebar', 'admin/layouts');
        $this->render('breadcrumb', 'admin/layouts');

        $this->render('add', 'admin/markets', $this->__data);

        $this->render('footer', 'admin/layouts');

    } 

    function addHandle(){

        // $pro_id = Session::getFlashData('add_id');
        $pro_id = Session::getSession('add_id');
        $numberVariant = Session::getSession('numberVariant');

        $request = $this->__post;

        $variants = $request['variant'];

        $rules = [
            'price' => ['required', 'int'],
            'discount' => ['int'],
            'variant' => ['required'],
        ];

        $this->__validate->validate($request, $rules);

        $errors = $this->__validate->getErrors();

        if(empty($errors['variant'])){

            if(count($variants) < $numberVariant){
                $errors['variant'] = "Please choose enough variant";
            }else{
                $uniqueMarket = $this->__model->uniqueMarket($pro_id);
                if(!empty($uniqueMarket)){
                    foreach ($uniqueMarket as $uni) {
                        if(empty(array_diff($variants, $uni))){
                            $errors['variant'] = "This market already has";
                        }
                    }
                }
            }
        }

        if(empty($errors)){

            $handleResquest = [
                'price' => $request['price'],
                'discount' => $request['discount'],
                'pro_id' => $pro_id,
                'create_at' => date('Y-m-d H:i:s')
            ];
    
            $variants = $request['variant'];
    
            $this->__model->table('markets')->insert($handleResquest);
            $marketId = $this->__model->lastId();
            foreach ($variants as $value) {
                $attr = [
                    'market_id' => $marketId,
                    'variant_id' => $value,
                    'create_at' => date('Y-m-d H:i:s')
                ];
                $this->__model->table('attrs')->insert($attr);
            }
            
            redirect("admin/markets/edit/$pro_id/$marketId");

        }else{

            Session::setFlashData('errors', $errors);
            Session::setFlashData('olds', $request);
            Session::setFlashData('msg', 'Add failed');
            Session::setFlashData('type', 'danger');

        }

        back();
    
    }


    public function edit($pro_id, $id){

    // Check
    if(!empty($pro_id) || !empty($id)){
        $product = $this->__model->product($pro_id);
        $market = $this->__model->market($id);
        if(!empty($product) || !empty($market)){
            // lỗi url
        }else{
            redirect(_WEB_HOST_ADMIN, true);
        }
    }else{
        redirect(_WEB_HOST_ADMIN, true);
    }

    // $allVariants = $this->__model->allVariants($pro_id);
    $marketImages = json_decode($market['images'], true);
    $marketImages = $this->__model->marketImages($marketImages);

    $images = $this->__model->images($pro_id);

    $variantMarket = $this->__model->variantMarket($id);

    // $allVariants = $this->__model->allVariants($pro_id);
        
    // $varTitles = [];
    // $varInputs = [];
    // $varTypes = [];

    // foreach ($allVariants as $key => $value) {
    //     $varTitles[$key] = $value['name'];
    //     $varTypes[$key] = $value['input'];
    //     $varInputs[$key] = $this->__model->variants($value['id']);
    // }
    
    // $this->__data['varTitles'] = $varTitles;
    // $this->__data['varInputs'] = $varInputs;
    // $this->__data['varTypes'] = $varTypes;

    // die;

    // Data
    $this->__data['title'] = ucfirst($product['name']);
    $this->__data['pro_id'] = $pro_id;
    $this->__data['id'] = $id;
    $this->__data['variantMarket'] = $variantMarket;
    
    $this->__data['images'] = $images;
    $this->__data['marketImages'] = $marketImages;

    $this->__data['market'] = $market;
    $this->__data['errors'] = $this->__errors;

    $olds = $this->__olds;
    if(empty($olds)) $olds = $market;
    $this->__data['olds'] = $olds;
    $this->__data['errors'] = $this->__errors;
    $this->__data['msg'] = $this->__msg;
    $this->__data['type'] = $this->__type;




    $this->render('header', 'admin/layouts', $this->__data);
    $this->render('sidebar', 'admin/layouts');
    $this->render('breadcrumb', 'admin/layouts');

    $this->render('edit', 'admin/markets', $this->__data);

    $this->render('footer', 'admin/layouts');


    }

    public function thumbnail(){

        // $data = $this->__post;
        // // $data = $this->__get;

        // $data = json_encode($data);

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        
        // echo $data;

        return `{"pro_id":"7"}`;

    }

    public function handleThumbnail(){

        $responses = $this->__post;

        $data = [
            'thumbnail' => $responses['thumbnail'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->__model->table('markets')->where('id', '=', $responses['id'])->update($data);

    }


    public function handleImages($id){

        $responses = $this->__post;
        $images = $responses['thumbnail'];

        $jsonImage = "";
        $arrImages = [];

        foreach ($images as $key => $value) {
            $arrImages[] = $value;
        }

        $jsonImage = json_encode($arrImages);


        $data = [
            'images' => $jsonImage,
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->__model->table('markets')->where('id', '=', $id)->update($data);

        back();

    }


    public function handlePrice($id){

    $responses = $this->__post;

    $rules = [
        'price' =>  ['required', 'int'],
        'discount' => ['required', 'int'],
        // 'status' => ['required'],
    ];
        
    $this->__validate->validate($responses, $rules);
    
    $errors = $this->__validate->getErrors();

    if(empty($errors)){

        $data = [
            'price' => $responses['price'],
            'discount' => $responses['discount'],
            'status' => $responses['status'],
            'update_at' => date('Y-m-d H:i:s')
        ];

        if($this->__model->table('markets')->where('id', '=', $id)->update($data)){
            Session::setFlashData('msg', 'Fix success');
            Session::setFlashData('type', 'success');
        }else{
            Session::setFlashData('msg', 'Fix failed');
            Session::setFlashData('type', 'danger');
        }

    }else{

        Session::setFlashData('errors', $errors);
        Session::setFlashData('olds', $responses);
        Session::setFlashData('msg', 'Fix failed');
        Session::setFlashData('type', 'danger');

    }

    back();

    }
} 

?> 
