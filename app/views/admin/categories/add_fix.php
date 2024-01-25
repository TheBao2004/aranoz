<?php


?>

<div class="card mb-4">
    <h5 class="card-header"><?php echo !empty($titleAdd)?$titleAdd:''; ?></h5>
    <div class="card-body">
    <form action="<?php echo !empty($fix)?route("admin/Categories/fixPost"):route("admin.Categories.addPost"); ?>" method="post">
        <label for="defaultFormControlInput" class="form-label">Name</label>
        <input
        type="text"
        class="form-control"
        id="defaultFormControlInput"
        placeholder="..."
        aria-describedby="defaultFormControlHelp"
        name="name"
        value="<?php echo old($olds, 'name'); ?>"
        />
        <?php echo spanError($errors, 'name'); ?>
        <hr>
        <input type="submit" value="Submit" class="btn btn-primary">
        <?php if(!empty($fix)): ?>
            <a href="<?php echo route('admin.Categories'); ?>" class="btn btn-success">Add</a>
        <?php endif; ?>
    </form>
    </div>
</div>