<?php

echo alert($msg, $type);

?>


<!-- Switches -->
<div class="card mb-4">
<h5 class="card-header"><?php echo !empty($product)?$product:'Error'; ?></h5>
<form action="<?php echo route('admin.products.fixHandle'); ?>" method="post">
<div class="card-body row">

    <div class="col-5">
        <label for="defaultFormControlInput" class="form-label">Name</label>
        <input
        type="text"
        class="form-control"
        id="defaultFormControlInput"
        placeholder="..."
        name="name"
        value="<?php echo old($olds, 'name'); ?>"
        />
        <?php echo spanError($errors, 'name'); ?>
    </div>

    <div class="col-5">
        <label for="defaultFormControlInput" class="form-label">Category</label>
        <select class="form-select" name="cate_id">
            <option value="">Choose category</option>
            <?php
            if(!empty($allCate)):
                foreach ($allCate as $key => $value):
                    extract($value);
            ?>
            <option <?php echo old($olds, 'cate_id') == $id?'selected':''; ?> value="<?php echo $id; ?>"><?php echo $name; ?></option>
            <?php endforeach; endif; ?>
        </select>
        <?php echo spanError($errors, 'cate_id'); ?>
    </div>

    <div class="col-1">
        <label for="defaultFormControlInput" class="form-label">Thumbnail</label>
        <span class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Choose</span>
    </div>

    
    <div class="form-check form-switch col-1 d-flex flex-column mb-3 align-items-center p-0">
        <label class="form-check-label d-block" for="flexSwitchCheckChecked">
            Status
        </label>
        <input <?php echo old($olds, 'status') == 1?'checked':''; ?> class="form-check-input mx-auto" value="1" name="status" type="checkbox" id="flexSwitchCheckChecked"  />
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Thumnail</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row mx-0">
            
        <div class="col-8 row mx-0">
            <label for="" class="form-label">Choose Image</label>
            <?php 
                if($allImages):
                foreach ($allImages as $ki => $img):
            ?>
            <div class="col-4 p-1">
                <a href="#" class="thumbnail_pro" data-image="<?php echo image($img['image']) ?>" data-id="<?php echo $img['id'] ?>" data-pro_id="<?php echo $pro_id ?>" class=""><img src="<?php echo image($img['image']) ?>" width="100%" alt=""></a>
            </div>
            <?php endforeach; else: ?>

            <?php endif; ?>    
        </div>

        <div class="col-4">
            <label for="" class="form-label">Thumbnail</label>
            <img id="thumbnail_product" width="90%" src="<?php echo image(old($olds, 'image')) ?>" alt="">
        </div>

        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
        </div>
    </div>
    </div>


    <div class="col-12">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo old($olds, 'description'); ?></textarea>
        <?php echo spanError($errors, 'description'); ?>
    </div>

    <div class="col-12">
        <label for="exampleFormControlTextarea1" class="form-label">Content</label>
        <textarea class="form-control ckediter" name="content" id="exampleFormControlTextarea1" rows="3"><?php echo old($olds, 'contect'); ?></textarea>
    </div>

    <div class="col-12 pt-4">
        <input type="submit" value="Submit" class="btn btn-primary">
        <a href="<?php echo route("admin.products"); ?>" class="btn btn-success">Lists</a>
    </div>

</div>
</form>
</div>