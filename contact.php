<?php  include "includes/header.php"; ?>
<!-- Navigation -->

<?php  include "includes/navi.php"; ?>

<?php

if (isset($_POST['submit'])) {

    $header = "From: " . escape($_POST['email']);
    $to = "nikolatz.t@gmail.com";
    $subject = wordwrap(escape($_POST['subject']), 70);
    $body = escape($_POST['body']);

    mail($to, $subject, $body, $header);

}


?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact Me</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                            </div>

                            <div class="form-group">
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject">
                            </div>

                            <div class="form-group">
                                <textarea name="body" id="body"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Email">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php";?>
