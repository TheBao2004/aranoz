<?php
  echo alert($msg, $type);
?>
  
<div class="row mx-0">

  <div class="col-6">
    <?php
      $this->render('add_fix', 'admin/categories', $dataSub);
    ?>
  </div>

  <div class="col-6">

    <?php 
      $this->render('fillter', 'admin/categories', $fillters);
    ?>

    <!-- Basic Bootstrap Table -->
    <div class="card" style="">
      <h5 class="card-header">Table <?php echo !empty($title)?$title:'Error'; ?></h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th width="10%">STT</th>
              <th width="">Name</th>
              <th width="5%">Fix</th>
              <th width="10%">Remove</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php
              if(!empty($allCategories)):
              foreach ($allCategories as $key => $value):
                extract($value);
            ?>
            <tr class="table">
              <td><?php echo $key+1; ?></td>
              <td class="text-left">
                <?php echo ucfirst($name); ?>
              </td>
              <td>
                <a href="<?php echo route("admin/Categories.index.fix.$id"); ?>" class="btn btn-warning"><i class="fa fa-edit p-0"></i></a>
              </td>
              <td>
                <a href="<?php echo route("admin.Categories.remove.$id"); ?>" class="btn btn-danger"><i class="bx bx-trash p-0"></i></a>
              </td>
            </tr>
            <?php endforeach; else: ?>
              <tr class="table"><td colspan="10" class="text-danger">No data</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <?php
      pagination($totalPage, $page, $url, $fillter);
    ?>

  </div>

</div>
   
