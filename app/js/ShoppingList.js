const app = Vue.createApp({
  data() {
    return {
      // name:value pairs here
      links: {
        home: "./ ",
        lists: "./ShoppingList.php",
        inventory: "./Inventory.php",
        recipe: "./RecipeList.php",
        profile: "./Profile.php",
      },

      // shopping list
      sList: [],

      // autocomplete
      autocomlist: [],
      
      editlist: [], 
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
          status: false,
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
      // fill search bar with item
      document.getElementById("foodName").value = item;
      this.autocomlist = [];
    },

    deleteItem(item) {
      // delete item from shopping list
      this.sList.splice(this.sList.indexOf(item), 1);
      console.log(this.sList);
      console.log("delete item");
    },

    clearList() {
      // clear shopping list
      let clear = confirm("Are you sure you want to clear your list?");
      if (clear == false){
        // exit function
        return;
      }
      this.sList = [];
      console.log(this.sList);
      console.log("clear list");
    },

    editItemQuanity(item){
      // push item id into editlist
      this.editlist.push(item.id);
      console.log(this.editlist);
      console.log(this.sList);
      console.log("betore editing");
    },

    saveItemQuanity(item){
      // remove item id from editlist
      this.editlist.splice(this.editlist.indexOf(item.id), 1);
      console.log(this.editlist);
      console.log(this.sList);
      console.log("after editing");
    },

    saveList() {
      // iterate sLIst
      let PHPurl = "../../server/controller/shoppingList/processInsertShoppingItem.php";
      for(let i = 0; i < this.sList.length; i++){
        let item = this.sList[i];
        let name = item.name
        let quantity = item.quantity;
        let checkStatus = item.status;
        let params = {
          name: name,
          quantity: quantity,
          checkStatus: checkStatus,
        };

        // make post request to php
        axios.post(PHPurl, {params: {params}})
        .then((response) => {
          console.log(response.data);
          document.getElementById('saveStatus').innerText = response.data.status;
        })
        .catch((error) => {
          console.log(error);
          document.getElementById('saveStatus').innerText = "Error: " + error.message;
        });
      }      
      // clear list
      // this.sList = [];
    },
  },
});

const vm = app.mount("#shoppingList"); 
