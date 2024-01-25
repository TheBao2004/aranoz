


		<!-- Cart Start -->
		<div class="container-fluid pt-5">
			<div class="row px-xl-5">
				<div class="col-lg-8 table-responsive mb-5">
					<table class="table table-bordered text-center mb-0">
						<thead class="bg-secondary text-dark">
							<tr>
								<th>Thông Tin Tài Khoản</th>
							</tr>
						</thead>
						<tbody class="align-middle">

							<tr>
								<td class="align-middle">
                                    <?php echo alert($msg, $type) ?>
                                    <form class="row mx-0" action="<?php echo route('index.handleInfor') ?>" method="post" enctype="multipart/form-data">

                                        <div class="col-12 mb-3 text-left">
                                            <label for="">Họ Tên</label>
                                            <input type="text" class="form-control" name="name" value="<?php echo old($olds, 'name') ?>">
                                            <?php echo spanError($errors, 'name') ?>
                                        </div>
                                        <?php echo spanError($errors, 'name'); ?>

                                        <div class="col-12 mb-3 text-left">
                                            <label for="">Avatar</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <?php echo spanError($errors, 'image'); ?>

                                        <div class="col-12 mb-3 text-left">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" name="email" value="<?php echo old($olds, 'email') ?>">
                                            <?php echo spanError($errors, 'email') ?>
                                        </div>
                                        <?php echo spanError($errors, 'email'); ?>

                                        <div class="col-12 mb-3 text-left">
                                            <label for="">Số Điện Thoại</label>
                                            <input type="text" class="form-control" name="phone" value="<?php echo old($olds, 'phone') ?>">
                                            <?php echo spanError($errors, 'phone') ?>
                                        </div>
                                        <?php echo spanError($errors, 'phone'); ?>

                                        <div class="col-12 mb-3 text-left">
                                            <label for="">Địa Chỉ</label>
                                            <input type="text" class="form-control" name="address" value="<?php echo old($olds, 'address') ?>">
                                            <?php echo spanError($errors, 'address') ?>
                                        </div>

                                        <div class="col-12 mb-3 text-right">
                                            <input type="submit" value="Lưa Thông Tin" class="btn btn-primary">
                                        </div>
 
                                    </form>


                                </td>
								
							</tr>
						
						</tbody>
					</table>
				</div>
				<div class="col-lg-4">
					
					<div class="card border-secondary mb-5">
						<div class="card-header bg-secondary border-0">
							<h4 class="font-weight-semi-bold m-0"><?php echo old($olds, 'name') ?></h4>
						</div>
						<!-- <div class="card-body">
							<div class="d-flex justify-content-between mb-3 pt-1">
								<h6 class="font-weight-medium">Subtotal</h6>
								<h6 class="font-weight-medium">$150</h6>
							</div>
							<div class="d-flex justify-content-between">
								<h6 class="font-weight-medium">Shipping</h6>
								<h6 class="font-weight-medium">$10</h6>
							</div>
						</div> -->
						<div class="card-footer border-secondary bg-transparent">
							<a href="<?php echo route('index/infor') ?>" class="btn btn-block btn-primary my-3 py-3">Thông Tin Tài Khoản</a>
							<a href="<?php echo route('index/order') ?>" class="btn btn-block btn-primary my-3 py-3">Đơn Hàng</a>
							<!-- <a class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
							<a class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
							<a class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Cart End -->