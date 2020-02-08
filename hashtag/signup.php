<?php 
    include './config/config.php';
    include './helpers/functions.php';
    include './includes/header.php';

    
    if(isset($_POST['submit'])) {
        insertUser();
    }
    
?>

<style>
    .dropdown {
        padding: 10px;
        margin: 2px;
        border-radius: 20px;
        width: 100%;
        height: 44px;
        background-color: #f0f0f0;
        border: none;
    }
</style>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Signup</h4>
        <div class="site-pagination">
            <a href="<?php url('index.php') ?>">Home</a> /
            <a href="<?php url('signup.php') ?>">Signup</a>
        </div>
    </div>
</div>
<!-- Page info end -->


<!-- Contact section -->
<section class="contact-section">
    <div class="container">
        <div class="row" style="margin-bottom: 50px;">
            <div class="col-lg-8">

                <?php 
                    if($msg):
                        $class = $isError ? 'alert alert-danger' : 'alert alert-success';
                    ?>
                        <div class="<?php echo $class ?>">
                            <?php echo $msg; ?>
                        </div>
                <?php endif ?>

                <h3 style="margin-top: 10px; margin-bottom: 10px;">Signup</h3>
                <form method="post" action="<?php url('signup.php') ?>" class="contact-form">
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Your name"
                        required
                        maxlength="20"
                        minlength="5"
                    >
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Your e-mail"
                        required>
                    <input 
                        type="text" 
                        name="workPhone" 
                        placeholder="Your work phone">
                    <input 
                        type="text" 
                        name="phone" 
                        placeholder="Your cell number"
                        required>
                    <textarea 
                        name="address" 
                        placeholder="Address"
                        required></textarea>
                    <input 
                        name="password" 
                        type="password" 
                        placeholder="Password"
                        required>
                    <!-- <input 
                        name="confirmPassword" 
                        type="password" 
                        placeholder="Confirm password"
                        required> -->

                    <div style="margin-top: 10px; margin-bottom: 10px;">
                        <h5>Date of birth</h5>
                        
                        <div class="row" style="margin-top: 10px;">

                            <div class="col-4">
                                <select name="date" class="dropdown" required>
                                    <?php for($i = 1; $i<=31; ++$i): ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>

                            <div class="col-4">
                                <select name="month" class="dropdown" required>
                                    <?php 
                                        $months = ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                        foreach ($months as $month):
                                    ?>
                                        <option value="<?php echo $month ?>"><?php echo $month ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="col-4">
                                <select name="year" class="dropdown" required>
                                    <?php for($i = 1990; $i <= date('Y'); ++$i): ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div style="margin-top: 20px; margin-bottom: 20px">
                        <h5>Intrested Category</h5>
                        <div class="row" style=" margin-top: 10px;">
                            <div class="col-4 col-xs-12">
                                <div class="cf-radio-btns">
                                    <div class="cfr-item">
                                        <input 
                                            type="radio" 
                                            name="intrested" 
                                            value="cosmetics" 
                                            id="ship-1">
                                        <label for="ship-1">Cosmetics</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-xs-12">
                                <div class="cf-radio-btns">
                                    <div class="cfr-item">
                                        <input 
                                            type="radio" 
                                            name="intrested" 
                                            value="jewellery" 
                                            id="ship-2">
                                        <label for="ship-2">Imitation Jewellery</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-xs-12">
                                <div class="cf-radio-btns">
                                    <div class="cfr-item">
                                        <input 
                                            type="radio" 
                                            name="intrested" 
                                            value="both" 
                                            id="ship-3">
                                        <label for="ship-3">Both</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button name="submit" class="site-btn">Submit</button>
                </form>

                <p style="margin-top: 20px;">
                    Already have an account? 
                    <a href="<?php url('login.php') ?>">
                        <span style="color: #f51167; font-weight: bold">
                            Login
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