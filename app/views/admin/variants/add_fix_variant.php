<?php

?>


<!-- Form controls -->
<div class="card mb-4">
    <h5 class="card-header"><?php echo !empty($title)?$title:'Error'; ?></h5>
    <div class="card-body">
    <form action="<?php echo route("admin.variants.$handle"); ?>" method="post">
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Value</label>
        <input
            type="<?php echo $input; ?>"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="..."
            name="value"
            value="<?php echo old($olds, 'value'); ?>"
        />
        <?php echo spanError($errors, 'value'); ?>
        </div>
        <hr>
        <div>
            <input type="submit" value="Submit" class="btn btn-primary">
            <?php if($add_fix == 'fix'): ?>
                <a href="<?php echo route("admin.variants.variant.$var_id"); ?>" class="btn btn-success">Add</a>
            <?php endif; ?>
        </div>
    </form>
    </div>
</div>