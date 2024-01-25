<div class="card mb-4">
    <h5 class="card-header"><?php echo !empty($title)?$title:'Error'; ?></h5>
    <div class="card-body">
        <form action="<?php echo route('admin.products.imageHandle'); ?>" method="post" class="row mx-0" enctype="multipart/form-data">
            <div class="box_images col-11">
                <div class="item_image">
                    <input class="form-control" name="images[]" type="file" id="formFileMultiple" multiple />
                </div>
            </div>
            <div class="col-1">
                <input type="submit" value="Sumit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>