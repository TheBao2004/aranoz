<?php

?>

<div class="row">
  <form action="<?php echo route('admin/markets/addHandle'); ?>" method="post">
  <div class="">
    <div class="card mb-4">
      <h5 class="card-header"><a href="<?php echo route('admin/products'); ?>">Lists Products</a></h5>
      <div class="card-body">


        <div class="mb-3">
          <label for="defaultFormControlInput" class="form-label">Price</label>
          <input
            type="text"
            class="form-control"
            id="defaultFormControlInput"
            placeholder="..."
            aria-describedby="defaultFormControlHelp"
            name="price"
            value="<?php echo old($olds, 'price') ?>"
          />
          <?php echo spanError($errors, 'price') ?>
        </div>

        <div class="mb-3 ">
          <label for="defaultFormControlInput" class="form-label">Discount</label>
          <input
            type="text"
            class="form-control"
            id="defaultFormControlInput"
            placeholder="..."
            aria-describedby="defaultFormControlHelp"
            name="discount"
            value="<?php echo old($olds, 'discount') ?>"
          />
          <?php echo spanError($errors, 'discount') ?>
        </div>

        <?php foreach ($varTitles as $key => $label): ?>
          <div class="mb-3">
          <label for="exampleFormControlSelect2" class="form-label"><?php echo $label; ?></label>
          <select
            multiple
            class="form-select"
            id="exampleFormControlSelect2"
            aria-label="Multiple select example"
            name="variant[]"
          >

        <?php foreach ($varInputs[$key] as $value): ?>

            <option value="<?php echo $value['id'] ?>" style="<?php if($varTypes[$key] == 'color'): ?>background-color: <?php echo $value['value']; ?>;<?php endif; ?> color:light;"><?php echo $value['value']; ?></option>

        <?php endforeach; ?>

          </select>
        </div>
        <?php endforeach; ?>

        <?php if(!empty($errors['variant'])) echo alert($errors['variant'], 'danger') ?>

        <div class="mb-3">
          <input type="submit" value="Submit" class="btn btn-primary">
        </div>


      </div>
    </div>
  </div>
  </form>
</div>

