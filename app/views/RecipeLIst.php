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
                <h1 class="fw-bolder mb-4 animate__animated animate__fadeInUp">Recipe Search</h1>
                <!-- align buttom and input -->
                <div class="mb-2">
                    <form>
                        <div class="row">
                            <div class="col-9">
                                <div class="mb-3 animate__animated animate__fadeInUp">
                                    <input type="text" v-model="ingredient" class="form-control" id="RecipeSearchInput" aria-describedby="searchrecpie" placeholder="Enter ingredient">
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-primary animate__animated animate__fadeInUp" @click="SearchRecipe()">Search</button>
                            </div>
                        </div>
                        
                        <div class="row">    
                            <div class="col-12 col-md-4 col-lg-1">
                                Filter by:
                            </div>
                                               
                            <div class="col-12 col-md-4 col-lg-2">
                                <div class="dropdown animate__animated animate__fadeInUp" style="position: relative; z-index: 3;">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ selectedCuisine || 'Cuisine Type'}}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li v-for="cuisine in cuisines" :key="cuisine.value">
                                            <a class="dropdown-item" @click="selectCuisine(cuisine)">{{ cuisine.value }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-2">
                                <div class="dropdown animate__animated animate__fadeInUp" style="position: relative; z-index: 2;">
                                    <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown">
                                        {{ selectedMeal || 'Meal Type'}}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li v-for="meal in meals" :key="meal.value">
                                            <a class="dropdown-item" @click="selectMeal(meal)">{{ meal.value }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                    <div v-if="recipes.length > 0">
                        </p>
                        <div class="row">
                            <div class="col-9">
                                <h2>Recipe</h2>
                            </div>
                            <div class="col-3">
                                <div class="dropdown animate__animated animate__fadeInUp" style="position: relative; z-index: 1;">
                                    Sort by: &nbsp;&nbsp;&nbsp;
                                        <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ selectedSort || 'None' }}
                                        </button>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#" @click="setSelectedSort('Calories (Low to High)')">Calories (Low to High)</a></li>
                                        <li><a class="dropdown-item" href="#" @click="setSelectedSort('Fat (Low to High)')">Fat (Low to High)</a></li>
                                        <li><a class="dropdown-item" href="#" @click="setSelectedSort('Calcium (High to Low)')">Calcium (High to Low)</a></li>
                                        <li><a class="dropdown-item" href="#" @click="setSelectedSort('Protein (High to Low)')">Protein (High to Low)</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="recipe-cards-container animate__animated animate__fadeIn">
                            <div v-for="(recipe, index) in recipes" :key="index" class="recipe-card">
                                <img :src="recipe.recipe.image" alt="Recipe Image">
                                <h2>{{ recipe.recipe.label }}</h2>
                                <h5>Ingredients:</h5>
                                <ul>
                                    <li v-if="!recipeStates[index]" v-for="(ingredient, index) in recipe.recipe.ingredientLines.slice(0,5)" :key="`ingredient-${index}`" >
                                        {{ ingredient }}
                                    </li>
                                    <li v-else v-for="(ingredient, index) in recipe.recipe.ingredientLines" :key="`ingredient-full-${i}`">
                                        {{ ingredient }}
                                    </li>
                                </ul>
                                <button class="btn btn-link" @click="toggleIngredientsVisibility(index)">
                                    {{ recipeStates[index] ? 'View Less' : 'View More' }}
                                </button>
                                </p>
                                <button class="btn btn-primary" @click="getIngrdients(recipe.recipe.ingredientLines)">Add to Shopping List</button>
                                </p>
                                <h5>Calories:</h5> &nbsp; {{ Math.round(recipe.recipe.calories) }} {{ recipe.recipe.totalNutrients.ENERC_KCAL.unit }}
                                </p>
                                <h5>Nutrients:</h5>
                                <ul>
                                    <li>{{ `Calcium: ${Math.round(recipe.recipe.totalNutrients.CA.quantity)} ${recipe.recipe.totalNutrients.CA.unit}` }}</li>
                                    <li>{{ `Fat: ${Math.round(recipe.recipe.totalNutrients.FAT.quantity)} ${recipe.recipe.totalNutrients.FAT.unit}` }}</li>
                                    <li>{{ `Protein: ${Math.round(recipe.recipe.totalNutrients.PROCNT.quantity)} ${recipe.recipe.totalNutrients.PROCNT.unit}` }}</li>
                                </ul>
                                <a :href="recipe.recipe.url" target="_blank">View Full Recipe Page</a>
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

