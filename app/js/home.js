const app = Vue.createApp({
  data() {
    return {
      // name:value pairs here
      links: {
        home: "./index.php",
        lists: "./views/ShoppingList.php",
        inventory: "./views/Inventory.php",
        recipe: "./views/RecipeList.php",
        profile: "./views/Profile.php",
        login: "./views/login.php",
        logout: "../server/controller/Logout.php",
        register: "./views/register.php",
      },
    };
  },
  methods: {
    
  },
});

const vm = app.mount("#main");


