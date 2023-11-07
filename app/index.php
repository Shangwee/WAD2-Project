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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/shared.css" />
    <style>
        .card {
            border-radius: 20px;
            box-shadow: 3px 3px 5px #888888;
        }

        .main {
            font-size: 85px;
            font-family: Georgia, serif;

        }

        .subtitle {
            font-size: 0.4em;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .middle {
            position: relative;
            top: 70px;
            padding: 0px;
            margin: 0px;
            text-align: center;
        }

        .box {
            position: relative;
            background-color: white;
            padding: 20px;
            margin: 5px;
            border: 1px solid black;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div id="home">
        <!-- Navbar -->
        <?php
        session_start();
        require_once 'views/common/navbar.php';
        if (!empty($_SESSION)) {
            $user = $_SESSION['login'];
            echo "<input type='hidden' id='userId' value = {$user} >";
        }
        ?>
        <div class='container-fluid'>
            <!-- <div class='row' > -->
            <div class='row middle w-100 justify-content-center mb-2 animate__animated animate__fadeInUp'>
                <div class='col-xl-6 text-center'>
                    <img src='images/home/Subject.png' height=300>
                    <div class='main'>
                        <i>Taste, Not Waste</i>
                        <div class='subtitle'>Your one-stop solution to reducing food wastage</div>
                    </div>
                </div> 
            <?php if (!empty($_SESSION['login'])) {
                echo "
                    <div class='col-xl-3 mx-5 mt-4 text-center'>
                        <div class='row justify-content-center'>
                            <div class='box col-xl-12 col-lg-9 col-md-9 col-sm-10'>
                                <h4>Expired Items</h4>
                                <h1>{{Expire}}</h1>
                            </div>
                        </div>
                        <div class='row justify-content-center'>
                            <div class='box col-xl-12 col-lg-9 col-md-9 col-sm-10'>
                                <h4>Items with Low Quantity</h4>
                                <h1>{{LowQuantity}}</h1>
                            </div>
                        </div>
                        <div class='row justify-content-center'>
                            <div class='box col-xl-12 col-lg-9 col-md-9 col-sm-10'>
                                <h4>Total items in Inventory</h4>
                                <h1>{{TotalInventory}}</h1>
                            </div>
                        </div>
                    </div>";
            }?> 
            </div>
        <div class='row justify-content-center mt-5 animate__animated animate__fadeInUp' style='position:relative;top:120px;'>
            <div class='col-lg-4 col-md-10 col-sm-10'>
                <div class='card text-center mx-3 mb-2'>
                    <div class='card-body'>
                        <div class='card-text'>
                            <h4>Unsure of what to cook with your leftovers?</h4>
                            <?php
                            if (empty($_SESSION)) {
                                echo " <a href='views/register.php'>
                                            <button class='btn w-100' style='font-style:italic;'><h4 class='fw-light'>Search Recipes on FoodWise ▷</h4></button>
                                            </a>";
                            } else {
                                echo "<a v-bind:href='links.recipe'><button class='btn w-100' style='font-style:italic;'><h4 class='fw-light'>Search Recipes on FoodWise ▷</h4></button></a>";
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class='col-lg-4 col-md-10 col-sm-10'>
                <div class='card text-center mx-3 mb-2'>
                    <div class='card-body'>
                        <div class='card-text'>
                            <h4>Always buying more than what you need?</h4>
                            <?php
                            if (empty($_SESSION)) {
                                echo " <a href='views/register.php'><button class='btn w-100' style='font-style:italic;'><h4 class='fw-light'>Manage your Shopping List with FoodWise ▷</h4></button></a>";
                            } else {
                                echo "<a v-bind:href='links.lists'><button class='btn w-100' style='font-style:italic;'><h4 class='fw-light'>Manage your Shopping List with FoodWise ▷</h4></button></a>";
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
            <div class='col-lg-4 col-md-10 col-sm-10'>
                <div class='card text-center mx-3 mb-2'>
                    <div class='card-body'>
                        <div class='card-text'>
                            <h4>Never know what's left in your kitchen?</h4>
                            <?php
                            if (empty($_SESSION)) {
                                echo " <a href='views/register.php'><button class='btn w-100' style='font-style:italic;'><h4 class='fw-light'>Track your inventory with FoodWise ▷</h4></button></a>";
                            } else {
                                echo "<a v-bind:href='links.inventory'><button class='btn w-100' style='font-style:italic;'><h4 class='fw-light'>Track your inventory with FoodWise ▷</h4></button</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer-->
    <?php
    require_once 'views/common/footer.php';
    ?>
    <script src="js/home.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>