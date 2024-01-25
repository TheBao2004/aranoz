<?php


?>


<!-- Form controls -->
<div class="card mb-4">
    <h5 class="card-header"><?php echo !empty($title)?$title:'Error'; ?></h5>
    <div class="card-body">
    <form action="<?php echo route("admin.variants.$handle"); ?>" method="post">
        <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input
            type="text"
            class="form-control"
            id="exampleFormControlInput1"
            placeholder="..."
            name="name"
            value="<?php echo old($olds, 'name'); ?>"
        />
        <?php echo spanError($errors, 'name'); ?>
        </div>

        <div class="col-md">
        <label for="exampleFormControlInput1" class="form-label d-block">Input</label>
            <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="input"
                id="inlineRadio1"
                value="color"
                <?php echo old($olds, 'input', 'color')?'checked':''; ?>
            />
            <label class="form-check-label" for="inlineRadio1">Color</label>
            </div>
            <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="input"
                id="inlineRadio2"
                value="text"
                <?php echo old($olds, 'input', 'text')?'checked':''; ?>
            />
            <label class="form-check-label" for="inlineRadio2">Text</label>
            </div>
            <?php echo spanError($errors, 'input'); ?>
        </div>
        <hr>
        <div>
            <input type="submit" value="Submit" class="btn btn-primary">
            <?php if($add_fix == 'fix'): ?>
                <a href="<?php echo route("admin.variants.index.$pro_id"); ?>" class="btn btn-success">Add</a>
            <?php endif; ?>
        </div>
    </form>
    </div>
</div>