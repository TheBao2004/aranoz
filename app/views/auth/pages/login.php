
<div class="parent clearfix">
    <div class="bg-illustration">
      <!-- <img src="https://i.ibb.co/Pcg0Pk1/logo.png" alt="logo"> -->

      <div class="burger-btn">
        <span></span>
        <span></span>
        <span></span>
      </div>

    </div>
    
    <div class="login">
      <div class="container">
        <h1>Đăng Nhập <a class="home" href="<?php echo route(''); ?>">Aranoz</a></h1>
    
        <div class="login-form">
          <?php echo alert($msg, $type); ?>
          <form action="<?php echo route('auths/HandleLogin'); ?>" method="post">

              <input type="text" placeholder="Nhập Email Hoặc Tên Đăng nhập" name="account" value="<?php echo old($olds, 'account'); ?>">
              <div class="mb-3"><?php echo spanError($errors, 'account') ?></div>
              <input type="password" placeholder="Nhập Mật Khẩu" name="password" value="<?php echo old($olds, 'password'); ?>">
              <div class="mb-3"><?php echo spanError($errors, 'password') ?></div>


            <!-- <div class="remember-form">
              <input type="checkbox">
              <span>Remember me</span>
            </div>
            <div class="forget-pass">
              <a href="#">Forgot Password ?</a>
            </div> -->


            <button type="submit" class="w-100 d-block my-5" style="margin:30px 0; width: 100%;">Đăng Nhập</button>

          </form>
        </div>
    
      </div>
      </div>
  </div>

