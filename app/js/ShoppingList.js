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

      // shopping list
      sList: [],

      // autocomplete
      autocomlist: [],
    };
  },
  methods: {
    addItem() {
      // add item to shopping list
      // if both inputs are filled
      let foodName = document.getElementById("foodName").value;
      if (foodName != ""){
        this.sList.push({
          id: foodName.replaceAll(" ", "").trim() + this.sList.length,
          name: foodName.trim(),
          quantity: 1,
        });
        // clear inputs
        document.getElementById("foodName").value = "";
      }
      else
      {
        alert("Please fill out both fields");
      }
      console.log(this.sList);
    },
    autocompleteSearch() {
      let url = "https://api.edamam.com/auto-complete";
      const appID = "ebe9a73f";
      const appKey = "d07cd861a3539204a41d150e9170389b";
      let search = document.getElementById("foodName").value;
      para = {
        q: search,
        app_id: appID,
        app_key: appKey,
      };
  
      // make request to api
      axios.get(url, { params: para }).then((response) => {
        this.autocomlist = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
    },

    fillsearchbar(item) {
      document.getElementById("foodName").value = item;
      this.autocomlist = [];
    },
  },
});

const vm = app.mount("#shoppingList"); 
