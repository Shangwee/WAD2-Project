
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FoodWise</title>
        <!-- Js scripts -->
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
          
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/index.css" />
        <link rel="stylesheet" href="../css/shared.css" /> 
    </head>
    <body>
        <!-- Responsive navbar-->
        <div id="main">
            <?php
                session_start();
                require_once './common/navbar.php';
                if (isset($_SESSION['login'])){
                    header("Location: ../index.php");
                }
            ?>
             <!-- header -->
            <header class='bg-image pb-2 justify-content-center text-center' style='overflow:hidden;' >
                <div>
                    <img src='../images/header_register.png' height=330>
                    <div class='container px-5'>
                    </div>
                </div>
            </header>
            <!-- Features section-->
            <main>

            <?php
                require_once "../../server/db/ConnectionManager.php";
                $un='';
                $email='';
                $unerr='';
                $pwerr='';
                $cfmpwerr='';
                $title='';
                $subtitle='';
                $emailerr='';
                $display='none';

                if (isset($_GET['username'])){
                    $un = $_GET['username'];
                }

                if (isset($_GET['email'])){
                    $email = $_GET['email'];
                }

                if (isset($_GET['unerr'])){
                    $unerr=$_GET['unerr'];
                }

                if (isset($_GET['pwerr'])){
                    $pwerr=$_GET['pwerr'];
                }

                if (isset($_GET['cfmpwerr'])){
                    $cfmpwerr=$_GET['cfmpwerr'];
                }

                if (isset($_GET['emailerr'])){
                    $emailerr=$_GET['emailerr'];
                }

                if (isset($_GET['success'])){
                    $display='block';
                    $title='Registration Successful';
                    $subtitle="<i>Return to <a href='login.php?username=$un'>login</a></i>";
                }
            ?>

            <div class='container justify-content-center'>
                <!-- <div class='row'>
                    <h2>Login</h2>
                </div>  -->
                <h2 class='row justify-content-center text-center' id='title' style='display:<?=$display?>;'><?=$title?>
                        <p class='row justify-content-center text-center mt-1 mb-4 fw-light' style='font-size:0.8em;display:inline-block' ><?=$subtitle?></p>
                </h2>
                <form method='post' action='processregister.php' class='form-group'>
                    <div class='col-6 col-lg-5 col-xl-4 col-md-6 col-sm-8 mx-auto'>
                        <div class='row justify-content-center mb-3'>
                            <div class='fw-bold animate__animated animate__fadeInUp'>Username: <input type='text' name='username' class='form-control' value='<?=$un?>'></div>
                        </div>
                        <p style='color:red;'><?=$unerr?></p>
                        <div class='row justify-content-center mb-3'>
                            <div class='fw-bold animate__animated animate__fadeInUp'>Email: <input class='form-control' type='email' name='email' value='<?=$email?>'></div>
                        </div>
                        <p style='color:red;'><?=$emailerr?></p>
                        <div class='row justify-content-center mb-3'>
                            <div class='fw-bold animate__animated animate__fadeInUp'>Password: <input class='form-control' type='password' name='password'></div>
                        </div>
                        <p style='color:red;'><?=$pwerr?></p>
                        <div class='row justify-content-center mb-3'>
                            <div class='fw-bold animate__animated animate__fadeInUp'>Confirm Password: <input type='password' name='cfmpassword' class='form-control'></div>
                        </div>
                        <p style='color:red;'><?=$cfmpwerr?></p>
                        <div class='row mb-4'>
                            <div class='col animate__animated animate__fadeInUp'><input class='form-control text-white' style='background-color:#0c1559' type='submit' name='submit' value='Sign up'></div>
                        </div>
                        <div class='row'>
                            <p>Have an account? <a href='login.php'>Login here</a></p>
                    </div>
                </form>
            </div>

            <?php
            
                printr();
            ?>

            </main>
            
        </div>
        <!-- Footer-->
        <?php
            require_once './common/footer.php';
        ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="../js/login.js"></script>
    </body>
</html>