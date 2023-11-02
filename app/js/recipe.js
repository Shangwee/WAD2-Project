const app = Vue.createApp({
  data() {
    return {
      // name:value pairs here
      links: {
        home: "../index.php ",
        lists: "./ShoppingList.php",
        inventory: "./Inventory.php",
        recipe: "./RecipeList.php",
        profile: "./Profile.php",
        login: "./login.php",
        logout: "../../server/controller/Logout.php",
        register: "./register.php",
      },

      //for dropdown items
      selectedCuisine: null,
      cuisines: [
        {value: 'American'},
        {value: 'Asian'},
        {value: 'British'},
        {value: 'Caribbean'},
        {value: 'Central Europe'},
        {value: 'Chinese'},
        {value: 'Eastern Europe'},
        {value: 'French'},
        {value: 'Indian'},
        {value: 'Italian'},
        {value: 'Japanese'},
        {value: 'Kosher'},
        {value: 'Mediterranean'},
        {value: 'Middle Eastern'},
        {value: 'Nordic'},
        {value: 'South American'},
        {value: 'South East Asian'},
      ],
      
      selectedMeal: null,
      meals:[
        {value: 'breakfast'},
        {value: 'brunch'},
        {value: 'lunch'},
        {value: 'dinner'},
        {value: 'snack'},
        {value: 'teatime'},
      ],

      selectedDietary: null,
      dietaries:[
        {value: 'alcohol-free'},
        {value: 'dairy-free'},
        {value: 'egg-free'},
        {value: 'pork-free'},
        {value: 'peanut-free'},
        {value: 'vegan'},
        {value: 'vegetarian'},
      ],

      apiUrl: 'https://api.edamam.com/api/recipes/v2',
      appId: '6d9dec2e',
      appKey: '6aac0b6d7499cbc03c91fa0e81f57356',
      ingredient: "",
      cuisineType: "",
      mealType: "",
      health: "",

      recipes: [],
      recommendedRecipes: [],
      inventoryIngredients: "",

      //for ingredient view more/less
      showAll: false,
      recipeStates: {},

      // sort option selected
      selectedSearchSort: "",
      selectedInventorySort: "",

      displayed: false,
    };
  },

  mounted() {
    this.getIngredientsFromDatabase();
  },

  methods: {
    selectCuisine(cuisine){
      this.selectedCuisine = cuisine.value;
      console.log(cuisine.value);
    },

    selectMeal(meal){
      this.selectedMeal = meal.value;
      console.log(meal.value);
    },

    selectDietary(dietary){
      this.selectedDietary = dietary.value;
      console.log(dietary.value);
    },

    getIngrdients(item){
      let url = this.links.lists + "?";
      for (var i = 0; i < item.length; i++) {
        // redirect to shopping list page with ingredients as parameters 
        // encode each ingredient to avoid errors
        let ingredient = encodeURIComponent(item[i]);
        url += "ingredients[]=" + ingredient + "&";
      }
        // remove last '&' character
        url = url.slice(0, -1);
        // redirect to shopping list page with ingredients as parameters
        window.location.href = url;
    },

    getIngredientsFromDatabase() {
      axios
        .get('../../server/controller/getIngredients.php')
        .then((response) => {
          let datas = response.data;
          for (let i = 0; i < datas.length; i++) {
            let item = datas[i];
            let name = item.item;
            this.inventoryIngredients += name + ", ";
          }
          console.log(this.inventoryIngredients);
          this.getRecommendedRecipes();
        })
        .catch(function (error) {
          console.error('Error:', error);
        });
    },

    getRecommendedRecipes() {
      axios
        .get(this.apiUrl, {
          params: {
          type: 'public',
          q: this.inventoryIngredients,
          app_id: this.appId,
          app_key: this.appKey,
          cuisineType: this.selectedCuisine,
          mealType: this.selectedMeal,
          health: this.selectedDietary,
          }
        })
        .then((response) => {
          console.log(response);
          if(response.data.hits.length > 0){
            this.recommendedRecipes = response.data.hits.slice(0, 18); // the recipes are in the 'hits' property of the API response
            this.displayed = true;
          }
          else{
            window.alert('No recipes found for the search. Please try a different ingredient.');
            this.ingredient = "";
          }
        })
        .catch((error) => {
          console.error('API request failed:', error);
          this.recipes = [];
        });
    },

    getRecipesBasedOnSearch() {
      axios
        .get(this.apiUrl, {
          params: {
          type: 'public',
          q: this.ingredient,
          app_id: this.appId,
          app_key: this.appKey,
          cuisineType: this.selectedCuisine,
          mealType: this.selectedMeal,
          health: this.selectedDietary,
          }
        })
        .then((response) => {
          console.log(response);
          if(response.data.hits.length > 0){
            this.recipes = response.data.hits.slice(0, 18); // the recipes are in the 'hits' property of the API response
          }
          else{
            window.alert('No recipes found for the search. Please try a different ingredient.');
            this.ingredient = "";
          }
        })
        .catch((error) => {
          console.error('API request failed:', error);
          this.recipes = [];
        });
    },

    setSelectedSearchSort(sortOption){
      this.selectedSearchSort = sortOption;
      this.sortSearchRecipe();
    },

    setSelectedInventorySort(sortOption){
      this.selectedInventorySort = sortOption;
      this.sortInventoryRecipe();
    },

    sortSearchRecipe() {
      if (this.selectedSearchSort == "Calories (Low to High)") {
        this.recipes.sort((a, b) => {
          const caloriesA = a.recipe.totalNutrients.ENERC_KCAL.quantity;
          const caloriesB = b.recipe.totalNutrients.ENERC_KCAL.quantity;
          return caloriesA - caloriesB;
        }); 
      } 
      else if (this.selectedSearchSort == "Calcium (High to Low)") {
        this.recipes.sort((a, b) => {
          const calciumA = a.recipe.totalNutrients.CA.quantity;
          const calciumB = b.recipe.totalNutrients.CA.quantity;
          return calciumB - calciumA;
        });
      }
      else if (this.selectedSearchSort == "Fat (Low to High)") {
        this.recipes.sort((a, b) => {
          const fatA = a.recipe.totalNutrients.FAT.quantity;
          const fatB = b.recipe.totalNutrients.FAT.quantity;
          return fatA - fatB;
        });
      }
      else if (this.selectedSearchSort == "Protein (High to Low)") {
        this.recipes.sort((a, b) => {
          const proteinA = a.recipe.totalNutrients.PROCNT.quantity;
          const proteinB = b.recipe.totalNutrients.PROCNT.quantity;
          return proteinB - proteinA;
        });
      }
    },

    sortInventoryRecipe() {
      if (this.selectedInventorySort == "Calories (Low to High)") {
        this.recommendedRecipes.sort((a, b) => {
          const caloriesA = a.recipe.totalNutrients.ENERC_KCAL.quantity;
          const caloriesB = b.recipe.totalNutrients.ENERC_KCAL.quantity;
          return caloriesA - caloriesB;
        }); 
      } 
      else if (this.selectedInventorySort == "Calcium (High to Low)") {
        this.recommendedRecipes.sort((a, b) => {
          const calciumA = a.recipe.totalNutrients.CA.quantity;
          const calciumB = b.recipe.totalNutrients.CA.quantity;
          return calciumB - calciumA;
        });
      }
      else if (this.selectedInventorySort == "Fat (Low to High)") {
        this.recommendedRecipes.sort((a, b) => {
          const fatA = a.recipe.totalNutrients.FAT.quantity;
          const fatB = b.recipe.totalNutrients.FAT.quantity;
          return fatA - fatB;
        });
      }
      else if (this.selectedInventorySort == "Protein (High to Low)") {
        this.recommendedRecipes.sort((a, b) => {
          const proteinA = a.recipe.totalNutrients.PROCNT.quantity;
          const proteinB = b.recipe.totalNutrients.PROCNT.quantity;
          return proteinB - proteinA;
        });
      }
    },
    
    toggleIngredientsVisibility(recipeIndex){
      this.showAll = !this.showAll;

      if(this.recipeStates[recipeIndex]){
        this.recipeStates[recipeIndex] = false;
      }
      else{
        this.recipeStates[recipeIndex] = true;
      }
    },

    updateSearchHistory(){
      axios
      .post("../../server/controller/updateSearchHistory.php", {id:$_SESSION['login'], search:this.ingredient, cuisine: this.selectedOption})
      .then(response =>{
        console.log(response.data);
        app.updateSearchHistory();
      })
      .catch(err=>{
        console.log(err)
      })
    }
  },
});
const vm = app.mount("#RecipeMain");
