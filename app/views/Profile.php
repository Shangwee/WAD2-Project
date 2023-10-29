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
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/index.css" />
        <link rel="stylesheet" href="../css/shared.css" />   
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

</head>
<body>
    <div id="main">
    <!-- Navbar -->

    <?php
    session_start();
    require_once './common/navbar.php';
    require_once "./common/protect.php";
    require_once "../../server/DAO/AccountDAO.php";

    $accdao = new AccountDAO();
    $userobj = $accdao->getAccByUid($_SESSION['login']);
    $un = $userobj->getUsername();
    $email = $userobj->getEmail();

    ?>
    <!-- Header-->
    <header class="bg-image py-5" style="background-image: url('../images/home/food.jpg'); box-shadow: inset 0 0 0 1000px rgba(0,0,0,.5);">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="fw-bolder text-white mb-2 animate__animated animate__fadeInUp">Profile</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- profile content -->
    <div class="container my-5">
        <div class="card mt-2 animate__animated animate__fadeInUp col-5 mx-auto">
            <div class="card-body">
                <h1 class="card-title text-center my-5">Hi, <?=$un?>!</h1>
                    <div class="card-text">
                        <table class='table mx-3 table-borderless' >
                            <tr >
                                <td>Username:</td>
                                <td><?=$un?></td>
                                <td><a href='updateUsername.php?un=<?=$un?>' class='btn btn-light'>Update</a></td>
                            </tr>
                            <tr >
                                <td>Email:</td>
                                <td><?=$email?></td>
                                <td><a href='updateEmail.php' class='btn btn-light'>Update</button></td>
                            </tr>
                            <tr>
                                <td>Date Joined:</td>
                                <td><?=$email?></td>
                                <td></td>
                            </tr>
                            
                        </table>
                    </div>
            </div>
        </div>
    </div>

    <script>
        // function updateUsername(){
        //     <?=$accdao?>->
        // }
    </script>

    <!-- Footer -->
    <?php
        require_once 'common/footer.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="../../app/js/profile.js"></script>
</body>
</html>