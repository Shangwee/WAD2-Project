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
      // inventory list
      inventory: [],
      // shopping list
      sList: [],
      // autocomplete
      autocomlist: [],
      // recommendation
      recommendation: [],
      // edit list
      editlist: [],
      // input from search bar
      inputitem: "",
      // status message of saving or deleting
      statusMessage: "",
      // category option
      categoryOption: [
        "Produce",
        "Dairy and Protein",
        "Grains and Bakery",
        "Snacks and Pantry",
        "others",
      ],
      // category option selected
      selectedCategory: "Produce",
      // quantity
      quantity: 1,
      // is filter
      isFilter: false,
      // filter option
      filterOption: ["All", "Checked", "Unchecked"],
      // filter option selected
      selectedFilter: "All",
      // sort option
      sortOption: ["None", "Name (A-Z)", " Quantity (Low to High)"],
      // sort option selected
      selectedSort: "None",
    };
  },
  mounted() {
    // get list from database
    this.addIngredientFromRecipe();
    this.displaylist();
    this.displayRecommendation();
    this.checkItemsFromIventory();
  },
  computed: {
    // check if all the items are checked
    allChecked() {
      return this.sList.every((item) => item.status);
    },
  },
  methods: {
    addItem() {
      // add item to shopping list
      let foodName = this.inputitem;
      let userId = parseInt(document.getElementById("userId").value);
      if (foodName != "") {
        let name = foodName.trim();
        let quantity = this.quantity;
        let category = this.selectedCategory;
        let status = false;
        let PHPurl =
          "../../server/controller/shoppingList/InsertShoppingItem.php";
        let params = {
          name: name,
          category: category,
          quantity: quantity,
          checkStatus: status,
          userId: userId,
        };
        // make get request to php
        axios.get(PHPurl, { params: params }).then((response) => {
          console.log(response);
          this.statusMessage = response.status;
          // reload the list
          this.displaylist();
          // clear inputs
          this.inputitem = "";
          this.quantity = 1;
          this.selectedCategory = "Produce";
        });
      } else {
        alert("Please fill out both fields");
      }
    },

    deleteItem(itemID) {
      console.log(itemID);
      let PHPurl =
        "../../server/controller/shoppingList/DeleteShoppingItem.php";
      let deleteConfirmation = confirm(
        "Are you sure you want to delete this item?"
      );
      let params = {
        id: itemID,
      };
      // make get request to php
      if (deleteConfirmation == true) {
        // exit function
        axios.get(PHPurl, { params: params }).then((response) => {
          console.log(response);
          this.statusMessage = response.status;
        });
      } else {
        return;
      }
      // remove item from list
      this.sList.splice(this.sList.indexOf(itemID), 1);
    },

    clearList() {
      // clear shopping list
      let clear = confirm("Are you sure you want to clear your list?");
      if (clear == true) {
        // exit function
        let PHPurl =
          "../../server/controller/shoppingList/ClearShoppingList.php";
        let params = {
          userId: parseInt(document.getElementById("userId").value),
        };
        axios.get(PHPurl, { params: params }).then((response) => {
          console.log(response);
          this.statusMessage = response.status;
          this.sList = [];
        });
      } else {
        return;
      }
      // clear list in database
    },

    saveList() {
      let PHPurl = "../../server/controller/shoppingList/SaveShoppingList.php";
      // iterate through list
      let userId = parseInt(document.getElementById("userId").value);
      let isSave  = confirm("Are you sure you want to save your list?");
      if (isSave == true) {
        let params = {
          slist: this.sList,
          userId: userId,
        };
        // make get request to php
        axios.get(PHPurl, { params: params }).then((response) => {
          console.log(response);
          this.statusMessage = response.status;
        });
        alert("Your list has been saved!");
        this.displaylist();
      } else {
        return;
      }
    },

    editItemQuanity(item) {
      // push item id into editlist
      console.log("item loaded", item);
      console.log(item.id);
      this.editlist.push(item.id);
      console.log("betore editing");
    },

    saveItemQuanity(item) {
      // remove item id from editlist
      this.editlist.splice(this.editlist.indexOf(item.id), 1);
      // update item in database
      let PHPurl = "../../server/controller/shoppingList/EditShoppingItem.php";
      let params = {
        id: item.id,
        category: item.category,
        quantity: item.quantity,
      };
      // make get request to php
      axios.get(PHPurl, { params: params }).then((response) => {
        console.log(response);
        this.statusMessage = response.status;
      });
      console.log("after editing");
    },

    checkItem(item) {
      // check item from shopping list
      item.status = !item.status;
      console.log(item.status);

      let PHPurl = "../../server/controller/shoppingList/CheckShoppingItem.php";
      let params = {
        id: item.id,
        checkStatus: item.status,
      };

      // make get request to php
      axios.get(PHPurl, { params: params }).then((response) => {
        console.log(response);
        this.statusMessage = response.status;
      });
      console.log("check item");
    },

    displaylist() {
      // display list
      this.sList = [];
      let userId = parseInt(document.getElementById("userId").value);
      let PHPurl =
        "../../server/controller/shoppingList/DisplayEveryItemByUser.php";
      let params = {
        userId: userId,
      };

      axios
        .get(PHPurl, { params: params })
        .then((response) => {
          // iterate through response
          for (let i = 0; i < response.data.length; i++) {
            let item = response.data[i];
            let id = item.id;
            let name = item.item;
            let category = item.category;
            let quantity = item.quantity;
            let checkStatus = item.checkStatus;
            let ischecked = false;
            if (checkStatus == 1) {
              ischecked = true;
            } else {
              ischecked = false;
            }
            this.sList.push({
              id: id,
              name: name,
              category: category,
              quantity: quantity,
              status: ischecked,
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    autocompleteSearch() {
      let url = "https://api.edamam.com/auto-complete";
      const appID = "ebe9a73f";
      const appKey = "d07cd861a3539204a41d150e9170389b";
      let search = this.inputitem;
      para = {
        q: search,
        app_id: appID,
        app_key: appKey,
      };

      // make request to api
      axios
        .get(url, { params: para })
        .then((response) => {
          this.autocomlist = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    fillsearchbar(item) {
      // fill search bar with item
      this.inputitem = item;
      this.autocomlist = [];
    },

    sortShoppingList() {
      if (this.selectedSort == "None") {
        this.displaylist();
        return;
      } else if (this.selectedSort == "Name (A-Z)") {
        this.sList.sort((a, b) => {
          return a.name.localeCompare(b.name);
        });
      } else if (this.selectedSort == "Quantity (Low to High)") {
        this.sList.sort((a, b) => {
          return a.quantity - b.quantity;
        });
      }
    },

    displayRecommendation() {
      this.recommendation = [];
      let PHPurl = "../../server/controller/recommendation.php";
      axios
        .get(PHPurl)
        .then((response) => {
          let datas = response.data;
          for (let i = 0; i < datas.length; i++) {
            let item = datas[i];
            let name = item.item;
            let category = item.category;
            let reason = item.reason;
            this.recommendation.push({
              name: name,
              category: category,
              reason: reason,
            });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    addRecommandedItem(item) {
      this.inputitem = item.name;
      this.selectedCategory = item.category;
    },

    addIngredientFromRecipe() {
      // if there is no ingredient in url, exit function
      if (window.location.search == "") {
          return;
      } else {
        let url = "https://api.edamam.com/api/food-database/v2/parser";
        const appID = "ebe9a73f";
        const appKey = "d07cd861a3539204a41d150e9170389b";
        const urlParams = new URLSearchParams(window.location.search);
        const ingredients = urlParams.getAll("ingredients[]");
        for (let i = 0; i < ingredients.length; i++) {
          let ingredient = ingredients[i];
          para = {
            ingr: ingredient,
            app_id: appID,
            app_key: appKey,
          };
          // make request to api
          let name = "";
          let category = "";
          let quantity = 1;
          let userId = parseInt(document.getElementById("userId").value);
          axios.get(url, { params: para }).then((response) => {
            let datas = response.data.parsed[0];
            name = datas.food.label;
            category = "others";
            // check if qunatity is null
            if (datas.quantity != null) {
              // round up to the nearest integer
              quantity = Math.ceil(datas.quantity);
            }
            let PHPurl =
              "../../server/controller/shoppingList/InsertShoppingItem.php";
            let params = {
              name: name,
              category: category,
              quantity: quantity,
              checkStatus: false,
              userId: userId,
            };
            // make get request to php
            axios.get(PHPurl, { params: params }).then((response) => {
              console.log(response);
            });
          });
        }
        setTimeout(() => window.location.href = './ShoppingList.php', 1000)
      }
    },

    checkItemsFromIventory() {
      //  check items from inventory
      let PHPurl = "../../server/controller/shoppingList/CheckItemsFromInventory.php";
      let userId = parseInt(document.getElementById("userId").value);
      let params = {
        userId: userId,
      };
      // make get request to php
      axios.get(PHPurl, { params: params }).then((response) => {
        $response = response.data;
        for (let i = 0; i < $response.length; i++) {
            let item = $response[i];
            let name = item.item;
            let lowerCaseName = name.toLowerCase();
            // add into inventory
            this.inventory.push(lowerCaseName);
        }
      });
    },

    filterShoppingList() {
      // filter shopping list
      this.isFilter = true;
      let PHPurl =
        "../../server/controller/shoppingList/FilterShoppingList.php";
      if (this.selectedFilter == "All") {
        this.isFilter = false;
        this.displaylist();
        return;
      } else {
        let params = {
          selectedFilter: this.selectedFilter,
          userId: parseInt(document.getElementById("userId").value),
        };
        // make get request to php
        axios.get(PHPurl, { params: params }).then((response) => {
          console.log(response.data);
          this.sList = [];
          // iterate through response
          let datas = response.data;
          let length = datas.length;
          for (let i = 0; i < length; i++) {
            let item = datas[i];
            let id = item.id;
            let name = item.item;
            let category = item.category;
            let quantity = item.quantity;
            let checkStatus = item.checkStatus;
            let ischecked = false;
            if (checkStatus == 1) {
              ischecked = true;
            } else {
              ischecked = false;
            }
            this.sList.push({
              id: id,
              name: name,
              category: category,
              quantity: quantity,
              status: ischecked,
            });
          }
        });
      }
    },
  },
});

const vm = app.mount("#shoppingList");
