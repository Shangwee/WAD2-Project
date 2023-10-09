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
    };
  },
  methods: {
    addItem() {
      // add item to shopping list
      // if both inputs are filled
      if (document.getElementById("foodName").value != "" && document.getElementById("foodQuanity").value != ""){
        this.sList.push({
          name: document.getElementById("foodName").value,
          quantity: document.getElementById("foodQuanity").value,
        });

        // clear inputs
        document.getElementById("foodName").value = "";
        document.getElementById("foodQuanity").value = "";
        this.displayList();
      }
      else
      {
        alert("Please fill out both fields");
      }
      console.log(this.sList);
    },

    displayList(){
      var listing_page = document.getElementById("MainList");
      // clear everything in div
      listing_page.innerHTML = "";
      // add ul 
      listing_page.innerHTML += "<ul id='list'>";
      // create lisf of items
      for (var i = 0; i < this.sList.length; i++){
        listing_page.innerHTML += "<li>" + this.sList[i].name + " - " + this.sList[i].quantity + "</li>";
      }
      // close ul
      listing_page.innerHTML += "</ul>";
    }, 
  },
});

const vm = app.mount("#shoppingList");
