<?php 
    include './config/config.php';
    include './helpers/functions.php';
    include './includes/header.php';
?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>About</h4>
        <div class="site-pagination">
            <a href="<?php url('index.php') ?>">Home</a> /
            <a href="<?php url('about.php') ?>">About</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- Contact section -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <h5>BRAND PHILOSOPHY</h5>
                <p>WHAT DEFINES US</p>
                <p style="margin-left: 20%; margin-right: 20%;">At Luscious Cosmetics, we take the business of beauty very seriously. The company was founded with the purpose of creating high quality cosmetics with an affordable price tag, but without ever compromising on ingredients or ethics.</p>
            </div>
        </div>

        <div class="row" style="margin-top: 100px;">
            <div class="col-lg-5 col-sm-12">
                <img src="<?php url('assets/img/about/about_us_01.webp') ?>" alt="">
            </div>
            <div class="col-lg-7 col-sm-12 text-center" >
                <h5 style="margin-top: 60px;">FORMULA FIRST</h5>
                <p>BEAUTY WITH BRAINS</p>
                <p style="margin-left: 10%; margin-right: 10%;">We custom formulate each product, mindful of sourcing the best ingredients from certified suppliers around the world, to create clean, safe, skin-loving makeup that complements your skincare. Our key formulators are super-talented women who love makeup as much as you do, applying cutting edge R&D science and safety testing protocols while maintaining our fabulous, signature color payoff and performance</p>
            </div>
        </div>

        <div class="row" style="margin-top: 100px;">
            <div class="col-lg-7 col-sm-12 text-center" >
                <h5 style="margin-top: 60px;">SKIN-LOVING INGREDIENTS</h5>
                <p>CRUELTY FREE & VEGAN</p>
                <p style="margin-left: 10%; margin-right: 10%;">100% vegan from day one, we are committed to using cleaner, greener ingredients to find a balance between safe and natural. We love to infuse our formulas with botanicals, flower extracts and organic fruit-powered blends for a truly luscious INCI deck. Our founder’s personal, long-term relationships with ingredient suppliers help us get first dibs on high-quality vegan alternatives like ethically sourced marine collagen and plant-derived versions of traditionally non-vegan ingredients like collagen, squalene and hyaluronic acid.</p>
            </div>
            <div class="col-lg-5 col-sm-12">
                <img src="<?php url('assets/img/about/about_us_02.webp') ?>" alt="">
            </div>
        </div>


        <div class="row" style="margin-top: 100px; margin-bottom: 100px;">
            <div class="col-lg-5 col-sm-12">
                <img src="<?php url('assets/img/about/about_us_03.webp') ?>" alt="">
            </div>
            <div class="col-lg-7 col-sm-12 text-center" >
                <h5 style="margin-top: 60px;">PASSION FOR FUNCTION</h5>
                <p>MULTI-TASKING & GORGEOUS</p>
                <p style="margin-left: 10%; margin-right: 10%;">As a women-led indie brand, we’re passionate about creating easy to use, functional products you’ll want to use every single day. Lipsticks that hydrate and treat lips, powders that balance oil and banish shine, setting sprays with nourishing skin care elements to lock in your makeup artistry, all without ever losing sight of our ultimate goals: confidence, glamour, fun!</p>
            </div>
        </div>
    </div>
</section>
<!-- Contact section end -->


<?php 
    include './includes/footer.php';
?>