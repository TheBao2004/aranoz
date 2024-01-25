<?php

?>

<div class="card mb-4">
    <div class="card-body">
        <form action="" method="get" class="row mx-0">
            <div class="form-group col-9 p-1">
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
            <div class="form-group col-3 p-1 text-center">
                <input type="submit" value="Fillter" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>