
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
                if(!isset($_SESSION['login'])){
                    header ('location:login.php');
                    exit;
                }
                require_once './common/navbar.php';
                require_once '../../server/DAO/AccountDAO.php';
                $accdao = new AccountDAO();
             
            ?>
            <!-- header -->
            <header class='bg-image pb-2 justify-content-center text-center' style='overflow:hidden;' >
                <div>
                    <img src='../images/header_usernameupdate.png' height=330>
                    <div class='container px-5'>
                    </div>
                </div>
            </header>
            <!-- Features section-->
            <main>

            <?php
                require_once "../../server/db/ConnectionManager.php";
                $un='';
                $newun='';
                $unerr='';
                $title='Update Username';
                $subtitle='Enter your new username';
                $newunerr='';
                $display='none';


                if (isset($_GET['un'])){
                    $un = $_GET['un'];
                }

                if (isset($_POST['submit'])){
                    $un = $_POST['username'];
                    $newun = $_POST['newun'];
                    if(empty($newun)){
                        $newunerr ='Field must be filled';
                    }
                    else{
                    $user = $accdao -> getAccByUsername($newun);
                    if ($user == null){
                        $accdao->updateUsername($_SESSION['login'],$newun);
                        $display='block';
                        $title='Username updated successfully';
                        $subtitle="Return to<a href='Profile.php'>Profile</a>";
                        $un='';
                        $newun='';
                    }
                    else{
                        $newunerr='Username taken';
                    }
                }
                }
            ?>

            <div class='container justify-content-center my-5'>
                <!-- <div class='row'>
                    <h2>Login</h2>
                </div>  -->
                <h2 class='row justify-content-center text-center' id='title' style='display:<?=$display?>;'><?=$title?>
                        <p class='row justify-content-center text-center my-3 fw-light' style='font-size:0.8em;display:inline-block'><?=$subtitle?></p>
                </h2>
                <form method='post' class='form-group'>
                    <div class='col-6 col-lg-5 col-xl-4 col-md-6 col-sm-8 mx-auto'>
                        <div class='row justify-content-center mb-3'>
                            <div class='fw-bold animate__animated animate__fadeInUp'>Username: <input type='text' name='username' class='form-control' value='<?=$un?>'></div>
                        </div>
                        <p style='color:red;'><?=$unerr?></p>
                        <div class='row justify-content-center mb-3'>
                            <div class='fw-bold animate__animated animate__fadeInUp'>New Username: <input class='form-control' type='text' name='newun' value='<?=$newun?>'></div>
                        </div>
                        <p style='color:red;'><?=$newunerr?></p>
                        <div class='row mb-3'>
                            <div class='col animate__animated animate__fadeInUp'><input class='form-control text-white' style='background-color:#0c1559' type='submit' name='submit' value='Update'></div>
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
        <script src="../js/profile.js"></script>
    </body>
</html>