         

		<!-- Cart Start -->
		<div class="container-fluid pt-5">
			<div class="row px-xl-5">
                

				<div class="col-lg-8 table-responsive mb-5">
    
                    <?php echo alert($msg, $type) ?>

					<table class="table table-bordered text-center mb-0">
						<thead class="bg-secondary text-dark">
							<tr>
								<th>Sản Phẩm</th>
								<th>Giá</th>
								<th>Số Lượng</th>
								<th width="15%">Tổng Giá</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody class="align-middle">
                            <?php 
                                $total = 0;
                                if(!empty($carts)):
                                foreach ($carts as $key => $cart):
                            ?>
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
									<div class="input-group quantity mx-auto" style="width: 100px;">
										<div class="input-group-btn">
											<button class="btn btn-sm btn-primary btn-minus minus_cart" market_id="<?php echo $cart['id'] ?>" >
											<i class="fa fa-minus"></i>
											</button>
										</div>
										<input type="text" class="form-control form-control-sm bg-secondary text-center" value="<?php echo $cart['quantity'] ?>">
										<div class="input-group-btn">
											<button class="btn btn-sm btn-primary btn-plus add_cart" market_id="<?php echo $cart['id'] ?>" >
												<i class="fa fa-plus"></i>
											</button>
										</div>
									</div>
								</td>
								<td class="align-middle total_price_<?php echo $cart['id']; ?>">
                                    <?php
                                    
                                    $sum = $cart['quantity'] * $cart['price'];
                                    $total += $sum;
                                    echo $sum;

                                    ?>
                                </td>
								<td class="align-middle"><a href="<?php echo route("cart/remove/".$cart['id']) ?>" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></a></td>
							</tr>
                            <?php endforeach; else: ?>
                                <tr><td class="text-center text-danger" colspan="10">Chưa Có Sản Phẩm Nào</td></tr>
                            <?php endif; ?>


						</tbody>
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
							<h4 class="font-weight-semi-bold m-0">Tóm Tắt Giỏ Hàng</h4>
						</div>
						<div class="card-body">
							<!-- <div class="d-flex justify-content-between mb-3 pt-1">
								<h6 class="font-weight-medium">Đơn Giá</h6>
								<h6 class="font-weight-medium"><?php echo $total ?></h6>
							</div> -->
							<!-- <div class="d-flex justify-content-between">
								<h6 class="font-weight-medium">Shipping</h6>
								<h6 class="font-weight-medium">$10</h6>
							</div> -->
						</div>
						<div class="card-footer border-secondary bg-transparent">
							<div class="d-flex justify-content-between mt-2">
								<h5 class="font-weight-bold">Tổng Cộng:</h5>
								<h5 class="font-weight-bold total_cart"><?php echo $total ?></h5>
							</div>
                            <?php if(!empty($carts)): ?>
							<a href="<?php echo route('cart/pay') ?>" class="btn btn-block btn-primary my-3 py-3">Mua Ngay</a>
                            <?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Cart End -->
