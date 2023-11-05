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
      Expire:0,
      LowQuantity :0,
      TotalInventory :0,
    };
  },
  mounted() {
    this.getStats();
  },

  methods: {
    getStats() {
      let PHPurl = "../server/controller/home/getUserStats.php";
      let userId = parseInt(document.getElementById("userId").value);
      let para = {
        userId: userId,
      };
      
      axios.get(PHPurl, {params:para}).then((response) => {
        this.Expire = str(response.data.totelExpiring);
        this.LowQuantity = str(response.data.LowQuantity);
        this.TotalInventory = str(response.data.totalInventory);
      });
      console.log(this.Expire);
    }
  },
});

const vm = app.mount("#home");


