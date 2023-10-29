
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
          logout: "../../server/controller/logout.php",
          register: "./register.php",
        },
      };
    },
    methods: {
      
    },
  });
  
  const vm = app.mount("#main");
  