<?php 
    include './config/config.php';
    include './helpers/functions.php';
    include './includes/header.php';

    if(isset($_POST['submit'])) {
        loginUser();        
    }


?>

<?php if(userLoggedIn()): ?>
    <script>
        window.location.href = '<?php echo url('index.php') ?>';
    </script>
<?php endif ?>

<?php if($refresh): ?>
    <script>
        window.location.href = '<?php echo url('login.php') ?>';
    </script>
<?php endif ?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Login</h4>
        <div class="site-pagination">
            <a href="<?php url('index.php') ?>">Home</a> /
            <a href="<?php url('login.php') ?>">Login</a>
        </div>
    </div>
</div>
<!-- Page info end -->


<!-- Contact section -->
<section class="contact-section">
    <div class="container">
        <div class="row" style="margin-bottom: 50px;">
            <div class="col-lg-6">

                <?php 
                    if($msg):
                        $class = $isError ? 'alert alert-danger' : 'alert alert-success';
                ?>
                    <div class="<?php echo $class ?>">
                        <?php echo $msg; ?>
                    </div>
                <?php endif ?>

                <h3 style="margin-top: 10px; margin-bottom: 10px;">Login</h3>
                <form method="post" action="<?php url('login.php') ?>" class="contact-form">
                    <input
                        name="email" 
                        type="email" 
                        placeholder="Your e-mail"
                        required>
                    <input
                        name="password" 
                        type="password" 
                        placeholder="Password"
                        required>
                    <button name="submit" class="site-btn">Login</button>
                </form>

                <p style="margin-top: 20px;">
                    Don't have an account? 
                    <a href="<?php url('signup.php') ?>">
                        <span style="color: #f51167; font-weight: bold">
                            Signup
                        </span>
                    </a>
                </p>
            </div>

        </div>

    </div>
</section>
<!-- Contact section end -->
        

<?php 
    include './includes/footer.php';
?>