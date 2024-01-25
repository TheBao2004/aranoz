

		<!-- Cart Start -->
		<div class="container-fluid pt-5">
            
			<div class="row px-xl-5">
                
				<div class="col-lg-8 table-responsive mb-5">
					<table class="table table-bordered text-center mb-0">
						<thead class="bg-secondary text-dark">
							<tr>
								<th>Sản Phẩm</th>
								<th width="15%">Giá</th>
								<th width="15%">Số Lượng</th>
								<th width="15%">Tổng Giá</th>
							</tr>
						</thead>
						<tbody class="align-middle">

                            <?php $total = 0; foreach ($carts as $key => $cart): ?>
							<tr>
								<td class="align-middle row mx-0">
                                    <div class="col-5 p-0">
                                        <img src="<?php echo image($cart['thumbnail']) ?>" alt="" class="w-75">
                                    </div>
                                    <div class="col-7 text-left py-2">
                                        <h5><?php echo ucfirst($cart['name']) ?></h5>
                                        <hr>
                                        <?php  
                                            foreach ($cart['variants'] as $var):
                                        ?>
                                        <p><?php echo $var['label'] ?>: <span class="ml-3" style="<?php if($var['input'] == 'color'): ?>padding: 0 11px;<?php endif; ?> background-color:<?php if($var['input'] == 'color') echo $var['value']; ?>;"><?php if($var['input'] == 'text') echo $var['value'] ?></span></p>
                                        <?php
                                            endforeach;
                                        ?>
                                    </div>
                                </td>
								<td class="align-middle"><?php echo $cart['price'] ?></td>
								<td class="align-middle">
								    <?php echo $cart['quantity'] ?>
								</td>
								<td class="align-middle">
                                    <?php
                                    
                                    $sum = $cart['quantity'] * $cart['price'];
                                    $total += $sum;
                                    echo $sum;

                                    ?>
                                </td>
							</tr>
                            <?php endforeach; ?>
					</table>
				</div>
				<div class="col-lg-4">
					<!-- <form class="mb-5" action="">
						<div class="input-group">
							<input type="text" class="form-control p-4" placeholder="Coupon Code">
							<div class="input-group-append">
								<button class="btn btn-primary">Apply Coupon</button>
							</div>
						</div>
					</form> -->
					<div class="card border-secondary mb-5">
						<div class="card-header bg-secondary border-0">
							<h4 class="font-weight-semi-bold m-0"> Thông Tin Thanh Toán</h4>
						</div>
                        <form action="<?php echo route('cart/validatePay') ?>" method="post">
						 <div class="card-body row mx-0">

                            <div class="col-12">
                                <?php echo alert($msg, $type) ?>
                            </div>

							<!--<div class="d-flex justify-content-between mb-3 pt-1">
								<h6 class="font-weight-medium">Subtotal</h6>
								<h6 class="font-weight-medium">$150</h6>
							</div>
							<div class="d-flex justify-content-between">
								<h6 class="font-weight-medium">Shipping</h6>
								<h6 class="font-weight-medium">$10</h6>
							</div>-->

                            <div class="form-group col-6">
                                <input type="radio" name="pay_type" value="cash" <?php echo old($olds, 'pay_type') == 'cash'?'checked':''; ?>>  TIỀN MẶT <img width="25%" src="<?php echo image('cash.jpg'); ?>" alt="">
                            </div>
                            <div class="form-group col-6">
                                <input type="radio" name="pay_type" value="momo_qr" <?php echo old($olds, 'pay_type') == 'momo_qr'?'checked':''; ?>>  MOMO QR <img width="25%" src="<?php echo image('momo.webp'); ?>" alt="">
                            </div>
                            <div class="form-group col-6">
                                <input type="radio" name="pay_type" value="momo_atm" <?php echo old($olds, 'pay_type') == 'momo_atm'?'checked':''; ?>>  MOMO ATM <img width="25%" src="<?php echo image('momo.webp'); ?>" alt="">
                            </div>
                            <div class="form-group col-6">
                                <input type="radio" name="pay_type" value="vnpay" <?php echo old($olds, 'pay_type') == 'cash'?'vnpay':''; ?>>  VNPAY <img width="25%" src="<?php echo image('vnpay.jpg'); ?>" alt="">
                            </div>
                            <div class="form-group col-6">
                                <input type="radio" name="pay_type" value="paypal" <?php echo old($olds, 'pay_type') == 'cash'?'paypal':''; ?>>  PAYPAL <img width="25%" src="<?php echo image('paypal.jpg'); ?>" alt="">
                            </div>
                            <div class="px-3 m-0 mb-3">
                                <?php echo spanError($errors, 'pay_type'); ?>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="">Họ Tên</label>
                                <input type="text" class="form-control" name="fullname" value="<?php echo old($olds, 'fullname') ?>">
                                <?php echo spanError($errors, 'fullname') ?>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" value="<?php echo old($olds, 'email') ?>">
                                <?php echo spanError($errors, 'email') ?>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="">Số Điện Thoại</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo old($olds, 'phone') ?>">
                                <?php echo spanError($errors, 'phone') ?>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="">Địa Chỉ</label>
                                <input type="text" class="form-control" name="address" value="<?php echo old($olds, 'address') ?>">
                                <?php echo spanError($errors, 'address') ?>
                            </div>

						</div> 
						<div class="card-footer border-secondary bg-transparent">
							<div class="d-flex justify-content-between mt-2">
								<h5 class="font-weight-bold">Total</h5>
								<h5 class="font-weight-bold"><?php echo $total; ?></h5>
							</div>
							<button class="btn btn-block btn-primary my-3 py-3">Thanh Toán</button>
						</div>
                        </form>
					</div>
				</div>
			</div>
		</div>
		<!-- Cart End -->