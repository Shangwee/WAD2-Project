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
    };
  },
  methods: {},
});

const vm = app.mount("#shoppingList");
