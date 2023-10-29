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
      search : "",

      //for dropdown items
      isOpen: false,
      selectedOption: null,
      items: [
        {text: 'American', value: 'American'},
        {text: 'Asian' , value: 'Asian'},
        {text: 'British', value: 'British'},
        {text: 'Caribbean', value: 'Caribbean'},
        {text: 'Central Europe', value: 'Central Europe'},
        {text: 'Chinese', value: 'Chinese'},
        {text: 'Eastern Europe', value: 'Eastern Europe'},
        {text: 'French', value: 'French'},
        {text: 'Indian', value: 'Indian'},
        {text: 'Italian', value: 'Italian'},
        {text: 'Japanese', value: 'Japanese'},
        {text: 'Kosher', value: 'Kosher'},
        {text: 'Mediterranean', value: 'Mediterranean'},
        {text: 'Middle Eastern', value: 'Middle Eastern'},
        {text: 'Nordic', value: 'Nordic'},
        {text: 'South American', value: 'South American'},
        {text: 'South East Asian', value: 'South East Asian'},
      ],

      apiUrl: 'https://api.edamam.com/api/recipes/v2',
      appId: '6d9dec2e',
      appKey: '6aac0b6d7499cbc03c91fa0e81f57356',
      ingredient: "",
      cuisineType: "",
      calories: "",

      recipes: [],

      //for ingredient view more/less
      showAll: false,
      recipeStates: {},

      // sort option selected
      selectedSort: "",
    };
  },

    methods: {
      selectOption(item){
        this.selectedOption = item.text;
        console.log(item.text);
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

      SearchRecipe() {
        axios
          .get(this.apiUrl, {
            params: {
                type: 'public',
                q: this.ingredient,
                app_id: this.appId,
                app_key: this.appKey,
                cuisineType: this.selectedOption,
            }
          })
          .then((response) => {
              console.log(response);
              this.recipes = response.data.hits.slice(0, 18); // the recipes are in the 'hits' property of the API response
          })
          .catch((error) => {
            console.error('API request failed:', error);
          });
        },

      //   sortRecipesByCalories() {
      //     if (this.sortByCaloriesAsc) {
      //         // Sort recipes by calories in ascending order
      //         this.recipes.sort((a, b) => {
      //             const caloriesA = a.recipe.totalNutrients.ENERC_KCAL.quantity;
      //             const caloriesB = b.recipe.totalNutrients.ENERC_KCAL.quantity;
      //             return caloriesA - caloriesB;
      //         });
      //     } else {
      //         // Sort recipes by calories in descending order
      //         this.recipes.sort((a, b) => {
      //             const caloriesA = a.recipe.totalNutrients.ENERC_KCAL.quantity;
      //             const caloriesB = b.recipe.totalNutrients.ENERC_KCAL.quantity;
      //             return caloriesB - caloriesA;
      //         });
      //     }
  
      //     // Toggle the sorting order
      //     this.sortByCaloriesAsc = !this.sortByCaloriesAsc;
      // },

      sortRecipe() {
        if (this.selectedSort == "Calories (Low to High)") {
          this.recipes.sort((a, b) => {
            const caloriesA = a.recipe.totalNutrients.ENERC_KCAL.quantity;
            const caloriesB = b.recipe.totalNutrients.ENERC_KCAL.quantity;
            return caloriesA - caloriesB;
          }); 
        } 
        else if (this.selectedSort == "Calcium (High to Low)") {
          this.recipes.sort((a, b) => {
            const calciumA = a.recipe.recipe.totalNutrients.CA.quantity;
            const calciumB = b.recipe.recipe.totalNutrients.CA.quantity;
            return calciumA - calciumB;
          });
        }
        else if (this.selectedSort == "Fat (Low to High)") {
          this.recipes.sort((a, b) => {
            const fatA = a.recipe.recipe.totalNutrients.FAT.quantity;
            const fatB = b.recipe.recipe.totalNutrients.FAT.quantity;
            return fatA - fatB;
          });
        }
        else if (this.selectedSort == "Protein (High to Low)") {
          this.recipes.sort((a, b) => {
            const proteinA = a.recipe.totalNutrients.PROCNT.quantity;
            const proteinB = b.recipe.totalNutrients.PROCNT.quantity;
            return proteinA - proteinB;
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
    },
  });
const vm = app.mount("#RecipeMain");