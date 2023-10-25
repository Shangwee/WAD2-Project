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
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
            require_once './views/common/navbar.php';
        ?>
        <!-- Hero Section -->
        <div class="jumbotron text-center py-5" style="background-image: url('./images/home/food.jpg');background-size: cover;box-shadow: inset 0 0 0 1000px rgba(0,0,0,.5);">
            <h1 class="text-light animate__animated animate__fadeIn">Welcome to FoodWise</h1>
            <p class="text-light animate__animated animate__fadeInUp">Your solution to reducing food waste and making eco-friendly choices.</p>
        </div>

        <!-- Features Section -->
        <div class="container my-5">
            <h2 class="animate__animated animate__fadeIn">Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mt-2 animate__animated animate__fadeInUp">
                        <div class="card-body">
                            <h5 class="card-title">Search Recipes <span class="material-icons">receipt_long</span></h5>
                            <p class="card-text">Find delicious recipes based on the ingredients you have.</p>
                            <?php
                                if (empty($_SESSION)) {
                                    echo "<a href='views/login.php' class='btn btn-primary'>Learn More</a>";
                                } else { 
                                    echo "<a v-bind:href='links.recipe' class='btn btn-primary'>Learn More</a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mt-2 animate__animated animate__fadeInUp">
                        <div class="card-body">
                            <h5 class="card-title">Generate Shopping List <span class="material-icons">shopping_bag</span></h5>
                            <p class="card-text">Create a shopping list to ensure that you only buy the necessities.</p>
                            <?php
                                if (empty($_SESSION)) {
                                    echo "<a href='views/login.php' class='btn btn-primary'>Learn More</a>";
                                } else {
                                    echo "<a v-bind:href='links.lists' class='btn btn-primary'>Learn More</a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mt-2 animate__animated animate__fadeInUp">
                        <div class="card-body">
                            <h5 class="card-title">Track Food Inventory <span class="material-icons">inventory_2</span></h5>
                            <p class="card-text">Keep tabs on what's in your kitchen to prevent overbuying.</p>
                            <?php
                                if (empty($_SESSION)) {
                                    echo "<a href='views/login.php' class='btn btn-primary'>Learn More</a>";
                                } else {
                                    echo "<a v-bind:href='links.inventory' class='btn btn-primary'>Learn More</a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Get Started Section -->
        <?php 
        if (empty($_SESSION)) {
            echo "
            <section id='get-started' class='py-5 text-center'>
            <div class='container'>
                <h2 class='animate__animated animate__fadeIn'>Get Started Today</h2>
                <p class='animate__animated animate__fadeInUp'>Join us in the mission to reduce food waste and make a positive impact on the environment.</p>
                <a class='btn btn-primary animate__animated animate__fadeInUp' href='views/register.php'>Sign Up Now</a>
            </div>
            </section>
            </div>
            ";
        }
        ?>
        <!-- Testimonials Section -->
        <section id="testimonials" class="bg-light py-5">
            <div class="container">
                <h2 class="animate__animated animate__fadeIn">What Our Users Say</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 animate__animated animate__fadeInLeft">
                            <div class="card-body">
                                <p>"This app has made meal planning so much easier and helped us reduce food waste in our household."</p>
                                <p class="text-right">- <span class="material-icons">face_5</span>John D.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 animate__animated animate__fadeInRight">
                            <div class="card-body">
                                <p>"I love the shopping list feature. It's so convenient and eco-friendly!"</p>
                                <p class="text-right">- <span class="material-icons">face_3</span> Sarah K.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us Section -->
        <section id="contact-us" class="py-5 ">
            <div class="container">
                <h2 class="animate__animated animate__fadeIn">Contact Us <span class="material-icons">contact_support</span></h2>
                <p class="animate__animated animate__fadeInUp">If you have any questions or feedback, feel free to reach out to us. We'd love to hear from you!</p>
                <a class="btn btn-primary animate__animated animate__fadeInUp" href="#contact">Contact Us</a>
            </div>
        </section>
        <!-- Footer -->
        <?php
            require_once './views/common/footer.php';
        ?>
    </div>
    <script src="./js/home.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
