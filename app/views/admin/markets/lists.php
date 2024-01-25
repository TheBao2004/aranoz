<?php
        // echo '<pre>';
        // print_r($markets);
        // echo '</pre>';

?>

              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header"><a href="<?php echo route('admin.products') ?>"><?php echo !empty($title)?$title:'No Market' ?></a></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th width="5%">STT</th>
                        <th width="">Information</th>
                        <th width="25%">Thumbnail</th>
                        <th width="25%">Time</th>
                        <th width="5%">Fix</th>
                        <th width="5%">Remove</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                    <?php
                    if(!empty($markets)):
                        foreach ($markets as $key => $mr):
                    ?>

                      <tr>
                        <td><?php echo $key+1 ?></td>
                        <td class="text-left">
                            <p>Price: <span><?php echo $mr['price'] ?></span></p>
                            <p>Discount: <span><?php echo $mr['discount'] ?></span></p>
                            <p>Status: <span class="text-<?php echo yeno($mr['status'], 'success', 'danger'); ?>"><?php echo yeno($mr['status'], 'Active', 'No active'); ?></span></p>
                        </td>
                        <td>
                        <?php if(!empty($mr['thumbnail'])): ?>
                            <img width="80%" src="<?php echo image($mr['thumbnail']) ?>" alt="">
                        <?php else: ?>
                            <p class="text-danger">No Thumbnail</p>
                        <?php endif; ?>
                        </td>
                        <td class="text-left">
                            <p>Create: <span><?php echo $mr['create_at'] ?></span></p>
                            <p>Update: <span><?php echo $mr['update_at'] ?></span></p>
                        </td>
                        <td>
                            <a href="<?php echo route("admin.markets.edit.$pro_id.".$mr['id']); ?>" class="btn btn-warning"><i class="fa fa-edit p-0"></i></a>
                        </td>
                        <td>
                            <a onclick="return confirm('Do you sure to remove')" href="<?php echo route("admin.markets.edit.$pro_id.".$mr['id']); ?>" class="btn btn-danger"><i class="bx bx-trash p-0"></i></a>
                        </td>
                      </tr>

                    <?php endforeach; else: ?>
                        <tr><td colspan="10" class="text-center text-danger">No Data</td></tr>
                    <?php endif; ?>

                    </tbody>
                  </table>
                </div>
              </div>