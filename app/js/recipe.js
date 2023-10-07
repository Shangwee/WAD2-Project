const app = Vue.createApp({
  data() {
    return {
      // name:value pairs here
      links: {
        home: "./ ",
        lists: "./ShoppingList.html",
        inventory: "./Inventory.html",
        recipe: "./RecipeList.html",
        profile: "./Profile.html",
      },
      search : "",
    };
  },
  methods: {
    SearchRecipe() {
      const APP_ID = "4a95ac6a";
      const APP_KEY = "e29b58cfc49814187da386b3b9ccd5b4";
      this.search = "chicken";
      const url ="https://api.edamam.com/search?q=" + this.search +"&app_id="+ APP_ID +"&app_key=" + APP_KEY;
      axios.get(url).then(response => {
        console.log(response);
      });
    },
  },
});

const vm = app.mount("#RecipeMain");
