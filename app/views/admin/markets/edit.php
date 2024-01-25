<?php

?>
 
<div class="row mx-0">

<div class="col-8">  
    <div class="card mb-4">
    <h5 class="card-header"><a href="<?php echo route("admin.markets.index.$pro_id"); ?>"><?php echo !empty($title)?$title:'Error' ?></a></h5>
    <div class="card-body">

        <form action="<?php echo route('admin.markets.handlePrice.'.$id) ?>" method="post" class="row mx-0">

        <?php echo alert($msg, $type) ?>
        
        <div class="mb-3 col-11">
        <label for="defaultFormControlInput" class="form-label">Price</label>
        <input
            type="text"
            class="form-control"
            name="price"
            placeholder="..."
            value="<?php echo old($olds, 'price') ?>"
        />
        <?php echo spanError($errors, 'price') ?>
     
        </div>


        <div class="form-check form-switch col-1 d-flex flex-column mb-3 align-items-center p-0">
            <label class="form-check-label d-block" for="flexSwitchCheckChecked">
                Status
            </label>
            <input <?php echo old($olds, 'status') == 1?'checked':''; ?> class="form-check-input mx-auto" value="1" name="status" type="checkbox" />
        </div>

        <div class="mb-3">
        <label for="defaultFormControlInput" class="form-label">Discount</label>
        <input
            type="text"
            class="form-control"
            name="discount"
            placeholder="..."
            value="<?php echo old($olds, 'discount') ?>"
        />
        <?php echo spanError($errors, 'discount') ?>
     
        </div>

        <div class="mb-3">
        <label for="defaultFormControlInput" class="form-label">Variant</label>
        <?php foreach ($variantMarket as $key => $var): ?>

            <ul>
                <li>
                    <?php
                        $title = ucfirst($var['name']);
                        $input = $var['input'];
                        $value = $var['value'];
                        echo '<p>'.$title.': <span style="color:'.$value.';">'.$value.'</span></p>'; 
                    ?>
                </li>
            </ul>

        <?php endforeach; ?>
        </div>
        

        <div class="mb-3">  
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>

        </form>

        <hr>

        <div class="mb-3">

        <label for="defaultFormControlInput" class="form-label">Thumbnail</label>
        
        <span data-bs-toggle="modal" data-bs-target="#Thumbnail" class="btn btn-success d-block ww-100" data-pro_id="<?php echo $pro_id; ?>" id="choose_thumnail">Choose Thumbnail</span>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="Thumbnail" tabindex="-1" aria-labelledby="ThumbnailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ThumbnailLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            <!-- <form action="<?php echo route('admin.markets.handleThumbnail.'.$id) ?>" method="post"> -->

            <table class="table table-dark table-striped">
            <?php 
                if(!empty($images)):
                    foreach ($images as $key => $value):
            ?>
            <tr>
                <!-- <td><input type="radio" name="thumbnail" id="" class="form-check-input"></td> -->
                <td><a href="#" class="choose_thumbnail" data-image="<?php echo image($value['image']) ?>" data-thumbnail="<?php echo $value['id'] ?>" data-id="<?php echo $id ?>"><img  src="<?php echo image($value['image']) ?>" width="30%" alt=""></a></td>
            </tr>
            <?php endforeach; else: ?>
                <tr><td class="text-center text-danger">No images</td></tr>
            <?php endif ?>
            </table>


            </div>
            <!-- <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div> -->

            <!-- </form> -->

            </div>
        </div>
        </div>

        <div class="mb-3">

        <label for="defaultFormControlInput" class="form-label">Images</label>

        <span data-bs-toggle="modal" data-bs-target="#Images" class="btn btn-info d-block ww-100" id="choose_images">Choose Images</span>

        </div>

   

    </div>
    </div>
</div>

<div class="col-4">

<div class="">  
    <div class="card mb-4">
    <h5 class="card-header"><?php echo !empty($title)?$title:'Error' ?> - Thumbnail</h5>
    <div class="card-body">


    <img id="show_thumbnail" src="<?php echo image($market['thumbnail']) ?>" width="100%" alt="">

        

    </div>
    </div>
</div>

</div>


        <!-- Modal -->
        <div class="modal fade" id="Images" tabindex="-1" aria-labelledby="ImagesLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ImagesLabel">Modal image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                


        <form action="<?php echo route('admin.markets.handleImages.'.$id) ?>" method="post">

        <table class="table table-dark table-striped">
            <?php 
                if(!empty($images)):
                    foreach ($images as $key => $value):
            ?>
            <tr>
                <td><input type="checkbox" value="<?php echo $value['id'] ?>" name="thumbnail[]" class="item_images form-check-input"></td>
                <td><img  src="<?php echo image($value['image']) ?>" width="30%" alt=""></td>
            </tr>
            <?php endforeach; else: ?>
                <tr><td class="text-center text-danger">No images</td></tr>
            <?php endif ?>
            </table>


            </div>



            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </div>
            </form>

            </div>

        </div>


        <div class="col-12">  
        <div class="card mb-4">
        <h5 class="card-header"><?php echo "Images" ?></h5>
        <div class="card-body">

        <div class="owl-carousel owl-theme">
        <?php
            if(!empty($marketImages)):
                foreach ($marketImages as $key => $value):
        ?>
        <div class="item"><img src="<?php echo image($value['image']) ?>" width="90%" alt=""></div>
        <?php endforeach; endif ?>
        </div>
            
        <?php if(empty($marketImages)) echo '<h1 class="text-center text-danger">No images</h1>'; ?>
   
    </div>
    </div>
</div>


</div>









