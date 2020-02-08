<?php
include './config/config.php';
include './helpers/functions.php';
include './includes/header.php';
?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <h4>Contact</h4>
        <div class="site-pagination">
            <a href="<?php url('index.php') ?>">Home</a> /
            <a href="<?php url('contact.php') ?>">Contact</a>
        </div>
    </div>
</div>
<!-- Page info end -->

<!-- Contact section -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 contact-info">
                <h3>Get in touch</h3>
                <p>Shop 5, Data Garden, Saddar, Karachi</p>
                <p>+92 123 4567</p>
                <p>info@hashtag.com</p>
                <div class="contact-social">
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>

            </div>
        </div>
    </div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.470467211132!2d67.03724251500317!3d24.88192908404386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e5bcb7d58f5%3A0x7d1578cc97a5ec8c!2sData+Garden%2C+Jehangir+Rd%2C+Jiwani+Apartments%2C+Karachi%2C+Karachi+City%2C+Sindh!5e0!3m2!1sen!2s!4v1563730242572!5m2!1sen!2s" style="border:0" allowfullscreen></iframe>
    </div>
</section>
<!-- Contact section end -->





<?php
include './includes/footer.php';
?>