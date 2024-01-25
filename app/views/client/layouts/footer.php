    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <!-- <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="shop.html"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-dark mb-2" href="detail.html"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-dark mb-2" href="cart.html"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-dark mb-2" href="checkout.html"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-dark" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed
                    by
                    <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- JavaScript Libraries -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>


    <script src="<?php echo _WEB_HOST_TEMPLATE_CLIENT; ?>/assets/js/lib/easing/easing.min.js"></script>
    <script src="<?php echo _WEB_HOST_TEMPLATE_CLIENT; ?>/assets/js/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <!-- <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script> -->

    <!-- Template Javascript -->
    <script src="<?php echo _WEB_HOST_TEMPLATE_CLIENT; ?>/assets/js/main.js"></script>


    <script>

    $(document).ready(function(){

        $(".choose_variants").click(function(){

            let variants = document.querySelectorAll(".choose_variants")
            let arrId = []
            let quantity = $(this).data('quantity');
            let pro_id = $(this).data('pro_id');

            variants.forEach((item)=>{
                if(item.checked){
                    arrId.push(item.value) 
                }
            })

            $.ajax({

            url: "<?php echo route('index/findProduct') ?>",
            method: "POST",
            dataType: "JSON",
            data: {"arrId": arrId, "quantity":quantity, "pro_id":pro_id},
            success: function(res){
            //   console.log('success')
                // console.log(res);

                if(typeof(res.length) != 'number'){
                    $('#detail_images').html(res.carousel)
                    $('#price_product').html(res.price)
                    $('.add_cart').prop("disabled", false)
                    $('.add_cart').attr("market_id", res.id)

                }else{
                    let carousel = `
                    <div class="carousel-item active">
                    <img class="w-100 h-100" src="https://hopdungcardvisit.com/wp-content/uploads/2019/09/tam-het-hang.png" alt="Image">
                    </div>
                    `;
                    $('#detail_images').html(carousel)
                    $('#price_product').html("XXXXXX")
                    $('.add_cart').prop("disabled", true)
                    $('.add_cart').prop("market_id", false)

                }

            },
            error: function(err){
                let carousel = `
                <div class="carousel-item active">
                <img class="w-100 h-100" src="https://hopdungcardvisit.com/wp-content/uploads/2019/09/tam-het-hang.png" alt="Image">
                </div>
                `;
                $('#detail_images').html(carousel)
                $('#price_product').html("XXXXXX")
                $('.add_cart').prop("disabled", true)
                $('.add_cart').prop("market_id", false)


            }

            })

        })


        $('.add_cart').click(function(){

            let marketId = $(this).attr('market_id');

            $.ajax({

            url: "<?php echo route('cart/add') ?>",
            method: "POST",
            dataType: "JSON",
            data: {"marketId": marketId},
            success: function(res){
                console.log('success')
                $('.number_cart').html(res.numberCarts);
                $('.total_cart').html(res.priceCarts);
                let strClassTotalPrice = ".total_price_"+marketId;
                $(strClassTotalPrice).html(res.totalPrice)
            },
            error: function(err){
                console.log('error')
 
            }

            })


        });

        $('.minus_cart').click(function(){

        let marketId = $(this).attr('market_id');

        $.ajax({

        url: "<?php echo route('cart/minus') ?>",
        method: "POST",
        dataType: "JSON",
        data: {"marketId": marketId},
        success: function(res){
            console.log('success')
            $('.number_cart').html(res.numberCarts);
            $('.total_cart').html(res.priceCarts);
            let strClassTotalPrice = ".total_price_"+marketId;
            $(strClassTotalPrice).html(res.totalPrice)
        },
        error: function(err){
            console.log('error')

        }

        })


        });


    })


    </script>


</body>

</html>