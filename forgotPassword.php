<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Forgot Password</title>
    <link rel="icon" type="image/x-icon" href="imgs/key.ico">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS file -->
    <link rel="stylesheet" href="CSS/">
    <link rel="stylesheet" href="CSS/stylesForget.css">
    <link rel="stylesheet" href="CSS/loading.css">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="JavaScripts/UsersSecurityQuery.js"></script>

</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">
    <?php
    $user = $_GET['user'];
    ?>
    <!-- loading -->
    <!-- <div class="loadBackground">
        <div class="Loadcontainer">
            <div class="imgLoading"><img class="imgLoad" src="imgs/imgLoading/rLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="imgs/imgLoading/eLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="imgs/imgLoading/nLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="imgs/imgLoading/tLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" id="imgA" src="imgs/imgLoading/aLoading.png" style="width: 30px; height:30px;"></div>
        </div>
    </div> -->


    <!-- main container -->
    <div class="container" id="container_forget">

        <div class="overlay_container d-flex justify-content-center align-items-center">

        <?php
        if($user == "Renter"){
            ?>
            <div class="box forgot1_box">
                <p class="">Remembered your password? <b><a href="RentersPage/starterPage.php" class="login_link">Log In </a> </b></p>
            </div>

            <div class="box forgot2_box">
                <p class="">Remembered your password? 
                    <a href="RentersPage/starterPage.php" class="login_link">Log In </a> 
                </p>
            </div>
            <?php
        }
            else if($user == "Landlord"){
                ?>
            <div class="box forgot1_box">
                <p class="">Remembered your password? <b><a href="landlordPage/starterPage.php" class="login_link">Log In </a> </b></p>
            </div>

            <div class="box forgot2_box">
                <p class="">Remembered your password? 
                    <a href="landlordPage/starterPage.php" class="login_link">Log In </a> 
                </p>
            </div>
                <?php
            }
            ?>

        </div>

        <div class="input_container justify-content-center ">

            <div class="forgot forgot1 d-flex flex-column justify-content-center align-items-center " >
                <header class="mt-5 header">Forgot your Password?</header>
                <p class="text-center mt-3"> RentA can't recover your password. Enter your <br> email and the Secret Backup Phrase <br> given to you when you created your account. <br>
                    

                <div class="forgot_form mt-2 d-flex flex-column justify-content-center form_inputs">

                        <div class="input-block form_inputs form_blocks div_email d-flex justify-content-center mt-3">
                            <input type="email" name="rEmail" id="rEmail" class="input_ht" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                            <span class="placeholder span_placeholder"> Email address </span>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100 div_words">
                                    <input type="text" name="word1" id="word1" class="input_ht input_words" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 1 </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100">
                                    <input type="text" name="word2" id="word2" class="input_ht input_words " required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 2 </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100">
                                    <input type="text" name="word3" id="word3" class="input_ht input_words" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 3 </span>
                                </div>
                            </div>
                        
                        
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100">
                                    <input type="text" name="word4" id="word4" class="input_ht input_words" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 4 </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100">
                                    <input type="text" name="word5" id="word5" class="input_ht input_words " required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 5 </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100">
                                    <input type="text" name="word6" id="word6" class="input_ht input_words" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 6 </span>
                                </div>
                            </div>
                        
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100">
                                    <input type="text" name="word7" id="word7" class="input_ht input_words" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 7 </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100">
                                    <input type="text" name="word8" id="word8" class="input_ht input_words " required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 8 </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block px-1 mt-3 form_blocks form_inputs w-100">
                                    <input type="text" name="word9" id="word9" class="input_ht input_words" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 9 </span>
                                </div>
                            </div>
                        
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100">
                                    <input type="text" name="word10" id="word10" class="input_ht input_words" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 10 </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block mt-3 px-1 form_blocks form_inputs w-100">
                                    <input type="text" name="word11" id="word11" class="input_ht input_words " required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 11 </span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-block px-1 mt-3 form_blocks form_inputs w-100">
                                    <input type="text" name="word12" id="word12" class="input_ht input_words" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> 12 </span>
                                </div>
                            </div>

                            
                            <button id="btn_send" class=" buttons mt-3">Send Instructions</button><span class="loader"></span>
                        </div>
                    </div>
                </div>
      

            <div class="forgot forgot2 d-flex flex-column justify-content-center align-items-center">

                <div class=" forgot-success alert flex-column justify-content-center align-items-center" id="div_success">
                    <header class="text-center">Check Your Mail</header>
                    <img src="imgs/forgot_alert.png" alt="" style="width: 120px; height: 120px;" class="mt-3">
                    <p class=" mt-3"> Account identification succesful. <br> <br>
                        Please check your email inbox (including the spam/junk folder) for our message. <br> <br>
                        We have already sent instructions for resetting your password.
                        </p>
                        
                    <button id="btn_ok" class="login_inputs buttons">Okay</button>
                </div> 

                <div class=" forgot-failed alert flex-column justify-content-center align-items-center" id="div_failed">
                    <header class="mt-2 text-center">Sorry!</header>
                    <img src="imgs/forgot_alert2.png" alt="" style="width: 120px; height: 120px;" class="mt-3">
                    <p class=" mt-5"> Account identification unsuccesful. <br> <br>
                        You have entered invalid credentials. <br> <br>
                        The answers doesn't match.</p>
                    <button id="btn_back" class="login_inputs buttons">Try Again</button><span class="loader"></span>
                </div>
            </div>
        </div>
</body>
</html>