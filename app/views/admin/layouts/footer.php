


            </div>
            <!--  / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> -->

    <!-- Core JS -->

    <!-- Ckediter -->
    <script type="text/javascript" src="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/ckeditor-main/ckeditor.js"></script>

    <!-- build:js assets/vendor/js/core.js -->
    <!-- <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/vendor/libs/jquery/jquery.js"></script> -->
    <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- My js -->
    <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/js/app.js"></script>

    <!-- Cdn jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Slide Owl -->
    <script src="<?php echo _WEB_HOST_TEMPLATE_ADMIN; ?>/assets/js/owl.carousel.min.js"></script>


<script>

$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})

</script>


    <!-- Handle Ajax -->

    <script>

    $(document).ready(function(){

      $('#choose_thumnail').click(function(){

        let proId = $(this).data('pro_id')

        // $.ajax({

        //   url: "<?php echo route('admin/markets/thumbnail') ?>",
        //   method: "POST",
        //   dataType: "JSON",
        //   data: {pro_id: proId},
        //   success: function(res){
        //     console.log('success')
        //     console.log(res)
        //   },
        //   error: function(err){
        //     console.log('error')
        //     console.log(err)
        //   }

        // })

      })


      $('.choose_thumbnail').click(function(){

      let id = $(this).data('id')
      let thumbnail = $(this).data('thumbnail')
      let image = $(this).data('image')

      $.ajax({

        url: "<?php echo route('admin/markets/handleThumbnail') ?>",
        method: "POST",
        dataType: "JSON",
        data: {id: id,thumbnail:thumbnail},
        // success: function(res){
        //   console.log('success')
        //   console.log(res)
        // },
        // error: function(err){
        //   console.log('error')
        //   console.log(err)
        // }

      })

      // $('#show_thumbnail').css({
      //   "src": `${image}`,
      // })
      document.getElementById('show_thumbnail').src = image;


      })

      $('.thumbnail_pro').click(function(){

      let id = $(this).data('id')
      let pro_id = $(this).data('pro_id')
      let image = $(this).data('image')

      $.ajax({

        url: "<?php echo route('admin/products/handleThumbnail') ?>",
        method: "POST",
        dataType: "JSON",
        data: {id: id,pro_id: pro_id},
        // success: function(res){
        //   console.log('success')
        //   console.log(res)
        // },
        // error: function(err){
        //   console.log('error')
        //   console.log(err)
        // }

      })

      document.getElementById('thumbnail_product').src = image;

      })



    })



    </script>



  </body>
</html>