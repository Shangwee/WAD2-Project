<?php 
// require_once __DIR__."\..\..\..\server\model\Account.php";
if (empty($_SESSION)) {
    echo"<nav class='navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-expand-xs' >
        <div class='container px-5' id='foodwise'>
            <a class='navbar-brand animate__animated animate__fadeIn fw-bold text-white' href='/WAD2-Project/app/index.php' style='font-family: Georgia,serif;font-size:30px;font-style:italic;text-shadow: 2px 2px black;'>FoodWise</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
            <div class='collapse navbar-collapse' id='navbarSupportedContent' id='navlinks'>
                <ul class='navbar-nav ms-auto mb-2 mb-lg-0 '>
                    <li class='nav-item animate__animated animate__fadeIn'><a class='nav-link' v-bind:href='links.login'>Login</a></li>
                    <li class='nav-item animate__animated animate__fadeIn'><a class='nav-link' v-bind:href='links.register'>Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>";
} else if ($_SESSION["login"]) {
    echo"<nav class='navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-expand-xs'>
        <div class='container px-5' id='foodwise'>
            <a class='navbar-brand animate__animated animate__fadeIn fw-bold text-white' href='/WAD2-Project/app/index.php' style='font-family: Georgia,serif;font-size:30px;font-style:italic;text-shadow: 2px 2px black;'>FoodWise</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
            <div class='collapse navbar-collapse' id='navbarSupportedContent' id='navlinks'>
                <ul class='navbar-nav ms-auto mb-2 mb-lg-0'>
                    <li class='nav-item animate__animated animate__fadeIn'><a class='nav-link' v-bind:href='links.recipe'>Recipes</a></li>
                    <li class='nav-item animate__animated animate__fadeIn'><a class='nav-link' v-bind:href='links.lists' >Lists</a></li>
                    <li class='nav-item animate__animated animate__fadeIn'><a class='nav-link' v-bind:href='links.inventory'>Inventories</a></li>
                    <li class='nav-item animate__animated animate__fadeIn'><a class='nav-link' v-bind:href='links.profile'>Profile</a></li>
                    <li class='nav-item animate__animated animate__fadeIn'><a class='nav-link' v-bind:href='links.logout'>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>";
}
?>