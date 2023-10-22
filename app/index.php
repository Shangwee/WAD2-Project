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
        <link rel="stylesheet" href="./css/index.css" />
        <link rel="stylesheet" href="./css/shared.css" />   
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div id="main">
    <!-- Navbar -->
    <?php
        session_start();
        require_once './views/common/navbar.php';
    ?>
    <!-- Hero Section -->
    <div class="jumbotron text-center py-5" style="background-image: url('./images/home/food.jpg');background-size: cover;box-shadow: inset 0 0 0 1000px rgba(0,0,0,.5);">
        <h1 class="text-light">Welcome to FoodWise</h1>
        <p class="text-light">Your solution to reducing food waste and making eco-friendly choices.</p>
        <a class="btn btn-primary text-light" href="#get-started">Get Started</a>
    </div>

    <!-- Features Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search Recipes</h5>
                        <p class="card-text">Find delicious recipes based on the ingredients you have.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Generate Shopping List</h5>
                        <p class="card-text">Create a shopping list to buy only what you need.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Track Food Inventory</h5>
                        <p class="card-text">Keep tabs on what's in your kitchen to prevent overbuying.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Get Started Section -->
    <section id="get-started" class="py-5 text-center">
        <div class="container">
            <h2>Get Started Today</h2>
            <p>Join us in the mission to reduce food waste and make a positive impact on the environment.</p>
            <a class="btn btn-primary" href="./views/login.php">Sign Up Now</a>
        </div>
    </section>
    </div>
    <!-- Footer -->
    <?php
        require_once './views/common/footer.php';
    ?>
    <script src="../app/js/home.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
