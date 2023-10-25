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
    this.displaylist();
  },
  methods: {
    addItem() {
      // add item to shopping list
      let foodName = this.inputitem;
      let userId = parseInt(document.getElementById("userId").value);
      if (foodName != "") {
        let name = foodName.trim();
        let quantity = 1;
        let status = false;
        let PHPurl =
          "../../server/controller/shoppingList/InsertShoppingItem.php";
        let params = {
          name: name,
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
          console.log(response.data);
          // iterate through response
          for (let i = 0; i < response.data.length; i++) {
            let item = response.data[i];
            let id = item.id;
            let name = item.item;
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
            console.log(item);
            let id = item.id;
            let name = item.item;
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
