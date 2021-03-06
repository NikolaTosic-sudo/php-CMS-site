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
                        <h1 class="text-center" style="margin-bottom: 30px; border-bottom: black 1px solid; padding-bottom: 20px">Contact Me</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" style="font-size: 17px">Enter Your Email:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                            </div>

                            <div class="form-group">
                                <label for="subject" style="font-size: 17px">Enter Subject:</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject">
                            </div>

                            <div class="form-group">
                                <label for="body" style="font-size: 17px"></label>
                                <textarea class="form-control" rows="7" name="body" id="text"></textarea>
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
