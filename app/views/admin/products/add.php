<?php

echo alert($msg, $type);

?>


<!-- Switches -->
<div class="card mb-4">
<h5 class="card-header"><?php echo !empty($title)?$title:'Error'; ?></h5>
<form action="<?php echo route('admin.products.addHandle'); ?>" method="post">
<div class="card-body row">

    <div class="col-6">
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

    <div class="form-check form-switch col-1 d-flex flex-column mb-3 align-items-center p-0">
        <label class="form-check-label d-block" for="flexSwitchCheckChecked">
            Status
        </label>
        <input <?php echo old($olds, 'status') == 1?'checked':''; ?> class="form-check-input mx-auto" value="1" name="status" type="checkbox" id="flexSwitchCheckChecked"  />
    </div>

    <div class="col-12">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo old($olds, 'description'); ?></textarea>
        <?php echo spanError($errors, 'description'); ?>
    </div>

    <div class="col-12">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control ckediter" name="content" id="exampleFormControlTextarea1" rows="3"><?php echo old($olds, 'contect'); ?></textarea>
    </div>

    <div class="col-12 pt-4">
        <input type="submit" value="Submit" class="btn btn-primary">
        <a href="<?php echo route("admin.products"); ?>" class="btn btn-success">Lists</a>
    </div>

</div>
</form>
</div>