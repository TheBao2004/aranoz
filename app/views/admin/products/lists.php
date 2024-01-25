<?php
    alert($msg, $type);
?>

<?php $this->render('fillter', "admin/products", $fillters); ?>

<!-- Basic Bootstrap Table -->
<div class="card">
<h5 class="card-header">Table <?php echo !empty($title)?$title:'Error name'; ?></h5>
<div class="table-responsive text-nowrap">
    <table class="table">
    <thead>
        <tr>
            <th width="5%">STT</th>
            <th width="25%">Information</th>
            <th width="20%">Time</th>
            <th width="5%">Markets</th>
            <th width="5%">Create</th>
            <th width="5%">Variant</th>
            <th width="5%">Image</th>
            <th width="5%">Fix</th>
            <th width="5%">Remove</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        <?php 
            if(!empty($allProducts)):
                foreach ($allProducts as $key => $value):
                    extract($value);
        ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td class="text-left">
                    <p>Name: <span class="text-primary"><?php echo ucfirst($name); ?></span></p>
                    <p>Category: <span class="text-primary"><?php echo $cate_name; ?></span></p>
                    <p>Status: <span class="text-<?php echo yeno($status, 'success', 'danger'); ?>"><?php echo yeno($status, 'Active', 'No active'); ?></span></p>
                </td>
                <td class="text-left">
                    <p>Create day: <span class="text-primary"><?php echo timeFormat($create_at, 'm/d - H:i'); ?></span></p>
                    <p>Update day: <span class="text-primary"><?php echo !empty($update_at)?timeFormat($update_at, 'm/d - H:i'):'Not time'; ?></span></p>
                </td>
                <td>
                    <a href="<?php echo route("admin.markets.index.$id"); ?>" class="btn btn-primary"><i class="fa fa-boxes"></i></a>
                </td>
                <td>
                    <a href="<?php echo route("admin.markets.add.$id"); ?>" class="btn btn-success"><i class="fa fa-plus"></i></a>
                </td>
                <td>
                    <a href="<?php echo route("admin.variants.index.$id"); ?>" class="btn btn-dark"><i class="fa fa-cubes"></i></a>
                </td>
                <td>
                    <a href="<?php echo route("admin.products.image.$id"); ?>" class="btn btn-info"><i class="fa fa-images p-0"></i></a>
                </td>
                <td>
                    <a href="<?php echo route("admin.products.fix.$id"); ?>" class="btn btn-warning"><i class="fa fa-edit p-0"></i></a>
                </td>
                <td>
                    <a href="<?php echo route("admin.products.remove"); ?>" class="btn btn-danger"><i class="bx bx-trash p-0"></i></a>
                </td>
            </tr>
        <?php endforeach; else: ?>
            <tr><td class="text-danger" colspan="10">No data</td></tr>
        <?php endif; ?>
    </tbody>
    </table>
</div>
</div>
<!--/ Basic Bootstrap Table -->

<!-- Pagination -->
<?php pagination($totalPage, $page, $url, $fillter); ?>


