const app = Vue.createApp({
  data() {
    return {
      // name:value pairs here
      links: {
        home: "./ ",
        lists: "./views/ShoppingList.html",
        inventory: "./views/Inventory.html",
        recipe: "./views/RecipeList.html",
        profile: "./views/Profile.html",
      },
    };
  },
  methods: {
    
  },
});

const vm = app.mount("#main");


