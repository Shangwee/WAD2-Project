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
      recipes: [],
      limitedRecipes: []
    };
  },

    methods: {
      // toggleDropdown() {
      //   this.isOpen = !this.isOpen;
      //   console.log(isOpen);
      // },

      selectOption(item){
        this.selectedOption = item.text;
        console.log(item.text);
        //this.isOpen = false;
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
              this.recipes = response.data.hits; // the recipes are in the 'hits' property of the API response
              this.limitedRecipes = this.recipes.slice(0, 18)
          })
          .catch((error) => {
            console.error('API request failed:', error);
          });
        },
      },
});
const vm = app.mount("#RecipeMain");
