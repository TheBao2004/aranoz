


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
                                   
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Người Nhận</th>
                                    <th scope="col">Thanh Toán</th>
                                    <th scope="col">Hình Thức</th>
                                    <th scope="col">Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($orders)):
                                    foreach ($orders as $key => $value):
                                ?>
                                    <tr class="text-left">
                                    <td>
                                        <p class="m-0">Họ Tên: <span class="text-primary"><?php echo $value['fullname'] ?></span></p>
                                        <p class="m-0">Email: <span class="text-primary"><?php echo $value['email'] ?></span></p>
                                        <p class="m-0">Số Điện Thoại: <span class="text-primary"><?php echo $value['phone'] ?></span></p>
                                        <p class="m-0">Địa Chỉ: <span class="text-primary"><?php echo $value['address'] ?></span></p>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                        if(!empty($value['bank'])){
                                            echo '<span class="text-primary">Đã Thanh Toán</span>';
                                        }else{
                                            echo '<span class="text-danger">Chưa Thanh Toán</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                    <p>
                                        <?php if($value['pay'] == 0): ?>
                                            <span href="" class="">Tiền mặt</span>
                                        <?php elseif($value['pay'] == 1): ?>
                                            <span href="" class="">MOMO</span>
                                        <?php elseif($value['pay'] == 1): ?>
                                            <span href="" class="">VN PAY</span>
                                        <?php elseif($value['pay'] == 1): ?>
                                            <span href="" class="">PayPal</span>
                                        <?php endif; ?>
                                    </p>
                                    </td>
                                    <td>
                                        <?php echo $prices[$key]; ?>
                                    </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="10" class="text-center text-danger">Không Có Đơn Hàng Nào</td></tr>
                                <?php endif ?>
                                </tbody>
                                </table>

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