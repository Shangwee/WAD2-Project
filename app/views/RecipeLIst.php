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
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
        <main>
        <div id="RecipeMain">
        <!-- navbar -->
        <?php
            session_start();
            require_once './common/navbar.php';
            require_once "./common/protect.php";
        ?>
            <div class="container">
                </p>
                <h1 class="fw-bolder mb-4 animate__animated animate__fadeInUp">Recipe</h1>
                <!-- align buttom and input -->
                <div class="mb-2">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 animate__animated animate__fadeInUp">
                                    <input type="text" v-model="ingredient" class="form-control" id="RecipeSearchInput" aria-describedby="searchrecpie" placeholder="Enter ingredient">
                                </div>
                            </div>
                            <div class="col">
                                <div class="dropdown animate__animated animate__fadeInUp">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown">
                                        {{ selectedOption || 'Select a Cuisine Type'}}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li v-for="item in items" :key="item.value">
                                            <a class="dropdown-item" @click="selectOption(item)">{{ item.text }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary animate__animated animate__fadeInUp" @click="SearchRecipe()">Search</button>
                    </form>
                </div>
                    <div v-if="recipes.length > 0">
                        </p>
                        <h2>Recipes</h2>
                        <div class="recipe-cards-container animate__animated animate__fadeIn">
                            <div v-for="(recipe, index) in recipes" :key="index" class="recipe-card">
                                <img :src="recipe.recipe.image" alt="Recipe Image">
                                <h2>{{ recipe.recipe.label }}</h2>
                                <h5>Ingredients:</h5>
                                <ul>
                                    <li v-for="(ingredient, i) in recipe.recipe.ingredientLines" :key="i">{{ ingredient }}</li>
                                </ul>
                                <h5>Nutrients:</h5>
                                <ul>
                                    <li>{{ `Calcium: ${Math.round(recipe.recipe.totalNutrients.CA.quantity)} ${recipe.recipe.totalNutrients.CA.unit}` }}</li>
                                    <li>{{ `Fat: ${Math.round(recipe.recipe.totalNutrients.FAT.quantity)} ${recipe.recipe.totalNutrients.FAT.unit}` }}</li>
                                    <li>{{ `Carbs: ${Math.round(recipe.recipe.totalNutrients.CHOCDF.quantity)} ${recipe.recipe.totalNutrients.CHOCDF.unit}` }}</li>
                                    <li>{{ `Protein: ${Math.round(recipe.recipe.totalNutrients.PROCNT.quantity)} ${recipe.recipe.totalNutrients.PROCNT.unit}` }}</li>
                                </ul>
                                <a :href="recipe.recipe.url" target="_blank">Full Recipe</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <!-- Footer-->
    <?php
        require_once './common/footer.php';
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="../../app/js/recipe.js"></script>
</body>
</html>

