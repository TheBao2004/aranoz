<?php
echo alert($msg, $type);
?>

<div class="row m-0">
    
    <div class="col-6">
    <?php
    // echo $view;
    $this->render('add_fix', 'admin/variants', $dataSub);

    ?>
    </div>

    <div class="col-6">

    <!-- Basic Bootstrap Table -->
    <div class="card">
    <h5 class="card-header"><a href="<?php echo route('admin.products'); ?>"><?php echo !empty($title)?$title:'Error'; ?></a></h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
        <thead>
            <tr>
            <th width="10%">STT</th>
            <th width="">Info</th>
            <th width="10%">Lists</th>
            <th witdth="10%">Action</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <?php
                if(!empty($allVariants)):
                    foreach ($allVariants as $key => $value):
                        extract($value);
            ?>
            <tr>
            <td><?php echo $key+1; ?></td>
            <td class="text-left">
                <p>Name: <span class="text-primary"><?php echo $name; ?></span></p>
                <p>Input: <span class="text-primary"><?php echo $input; ?></span></p>
            </td>
            <td>
                <a href="<?php echo route("admin.variants.variant.$id"); ?>" class="btn btn-primary"><i class="fa fa-list"></i></a>
            </td>
            <td>
                <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo route("admin.variants.index.$pro_id.fix.$id"); ?>"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                    >
                    <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-trash me-1"></i> Delete</a
                    >
                </div>
                </div>
            </td>
            </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="10" class="text-center text-danger">No data</td></tr>
            <?php endif; ?>
        </tbody>
        </table>
    </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    </div>

</div>