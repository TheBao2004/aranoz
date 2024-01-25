
<?php
echo alert($msg, $type);

if(!empty($self)) $this->render('edit_image', 'admin/products', $dataSub);
?>

<h6 class="pb-1 mb-4 text-muted">
    <?php
        if(!empty($title)){
            echo $title;
        }
    ?>
</h6>

<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
    <?php
        if(!empty($allImages)):
            foreach ($allImages as $key => $value):
                extract($value);
    ?>
<div class="col">
    <div class="card h-100">
    <img class="card-img-top" src="<?php echo image($image); ?>" alt=" image " />
    <div class="card-body d-flex justify-content-between">
        <h5 class="card-title"><?php echo ucfirst($pro_name); ?></h5>
        <a href="<?php echo route("admin.products.removeImages.$id"); ?>" class="" onclick="return confirm('Do you sure for remove');"><i class="fa fa-times"></i></a>
    </div>
    </div>
</div>
    <?php
        endforeach; else: 
    ?>
</div>
<h2 class="text-center text-danger">NO IMAGE</h2>
<?php endif; ?>
