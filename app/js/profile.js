
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
        username:'',
        email:'',
        date:'',
        searchHist:[],
        updateun:'',
        updateemail:'',
     
      };
    },
    methods: {
      getDetails() {
        let PHPurl = "../../server/controller/retrieveProfileDetails.php?order=none";
        let userId = parseInt(document.getElementById("userId").value);
        // let para = {
        //   userId: userId,
        // };
        
        axios.get(PHPurl).then((response) => {
          console.log(response.data);
          let data = response.data;
          console.log(data);
          this.username = data.un;
          this.email = data.email;
          this.date = data.date;
          this.searchHist = data.shlist;
          this.updateemail="updateEmail.php?e=" + this.email;
          this.updateun='updateUsername.php?un='+this.username;
          console.log(this.username);
        });
        

        console.log(this.email);
      },
      sortdesc(){
        this.order='desc';
        let PHPurl = "../../server/controller/retrieveProfileDetails.php?order=desc";
        let userId = parseInt(document.getElementById("userId").value);
 
        axios.get(PHPurl).then((response) => {
          console.log(response.data);
          let data = response.data;
          console.log(data);
          this.searchHist = data.shlist;
        });

      },
      sortaesc(){
        this.order='aesc';
        let PHPurl = "../../server/controller/retrieveProfileDetails.php?order=aesc";
        let userId = parseInt(document.getElementById("userId").value);
 
        axios.get(PHPurl).then((response) => {
          console.log(response.data);
          let data = response.data;
          console.log(data);
          this.searchHist = data.shlist;
        });
      }
      
    },
    mounted() {
      this.getDetails();
    }
  });
  
  const vm = app.mount("#main");
  