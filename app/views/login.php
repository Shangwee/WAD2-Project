
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
                require_once "../../server/db/ConnectionManager.php";
                if (isset($_SESSION['login'])){
                    header("Location: ../index.php");
                }
            ?>
             <!-- header -->
            <header class='bg-image pb-2 justify-content-center text-center' style='overflow:hidden;' >
                <div>
                    <img src='../images/header_login.png' height=330>
                    <div class='container px-5'>
                    </div>
                </div>
            </header>
            <!-- Features section-->
            <main>

            <?php
                
                $un='';
                $unerr ='';
                $pwerr='';
                if (isset($_GET['username'])){
                    $un = $_GET['username'];
                }
                if (isset($_GET['unerr'])){
                    $unerr = $_GET['unerr'];
                }

                if (isset($_GET['pwerr'])){
                    $pwerr=$_GET['pwerr'];
                }
            ?>

            <div class='container justify-content-center'>
                <!-- <div class='row'>
                    <h2>Login</h2>
                </div>  -->
                <form action='processlogin.php' method='post' class='form group'>
                    <div class='col-4 mx-auto'>
                        <div class='row justify-content-center mb-3 animate__animated animate__fadeInUp'>
                            <div class='fw-bold'>Username: <input class='form-control' type='text' name='username' value='<?=$un?>'></div>
                        </div>
                        <p style='color:red'><?=$unerr?></p>
                        <div class='row justify-content-center mb-3 animate__animated animate__fadeInUp'>
                            <div class=' fw-bold'>Password: <input class='form-control' type='password' name='password'></div>
                        </div>
                        <p style='color:red'><?=$pwerr?></p>
                        <div class='row mb-4 animate__animated animate__fadeInUp'>

                            <div class='col-auto'><input class='form-control text-white' type='submit' name='submit' value='Login' style='background-color:#0c1559'></div><div class='col-auto'><input class='form-control' type='reset'></div>
                        </div>
                        <div class='row mb-3 animate__animated animate__fadeInUp'>
                            <div class=''></div><div class='col-auto'><a href='register.php'>Create account</a></div><div class='col-auto'><a href='passwordupdate.php'>Forgot Password</a></div>
                        </div>
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