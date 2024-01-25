<?php
?>

<div class="card mb-4">
    <div class="card-body">
        <form action="" method="get" class="row mx-0">
            <div class="form-group col-5">
                <input
                type="text"
                class="form-control"
                id="defaultFormControlInput"
                placeholder="..."
                aria-describedby="defaultFormControlHelp"
                name="name"
                value="<?php echo !empty($name)?$name:''; ?>"
                />
            </div>
            <div class="col-3 form-group">
                <select class="form-select" name="status">
                    <option value="">Choose status</option>
                    <option value="1" <?php echo isset($status) && $status==1?'selected':''; ?>>Active</option>
                    <option value="0" <?php echo isset($status) && $status==0?'selected':''; ?>>No active</option>
                </select>
            </div>
            <div class="col-3 form-group">
                <select class="form-select" name="cate_id">
                    <option value="">Choose category</option>
                    <?php
                    if(!empty($allCate)):
                        foreach ($allCate as $key => $value):
                            extract($value);
                    ?>
                    <option <?php echo !empty($cate_id) && $cate_id==$id?'selected':''; ?> value="<?php echo $id; ?>"><?php echo $name; ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>
            <div class="form-group col-1 text-center">
                <input type="submit" value="Fillter" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>