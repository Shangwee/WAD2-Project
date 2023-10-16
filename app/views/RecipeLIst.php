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
    <link rel="stylesheet" href="../css/recipe.css" />
    <link rel="stylesheet" href="../css/shared.css" />   
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div id="RecipeMain">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container px-5">
                    <a class="navbar-brand" href="#!">FoodWise</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" v-bind:href="links.lists" >Lists</a></li>
                            <li class="nav-item"><a class="nav-link" v-bind:href="links.inventory">Inventories</a></li>
                            <li class="nav-item"><a class="nav-link" v-bind:href="links.recipe">Recipes</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                <h1 class="fw-bolder mb-4">Recipe</h1>
                <!-- align buttom and input -->
                <div class="mb-2">
                    <form>
                        <div class="mb-3">
                          <label for="RecipeSearchInput" class="form-label">Search</label>
                          <input type="email" class="form-control" id="RecipeSearchInput" aria-describedby="searchrecpie" placeholder="Enter keywords">
                        </div>
                        <button type="button" class="btn btn-primary" v-on:click="SearchRecipe()">Submit</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <!-- Footer-->
    <footer class="py-5" style="background-color: #3b634e;">
        <div class="container px-5">
            <p class="m-0 text-center text-white">Copyright &copy; FoodWise 2023</p>
            <p class="m-0 text-center text-white"></a> icons by <a href="https://icons8.com" style="color: white;">Icons8</a></p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="../../app/js/recipe.js"></script>
</body>
</html>
