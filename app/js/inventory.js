
  
function openForm() {
    if (document.getElementById("myForm").style.display === "none" || document.getElementById("myForm").style.display === ""){
        document.getElementById("myForm").style.display = "block"
    }
    else{document.getElementById("myForm").style.display = "none"}
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
function sendToAPI(file) {
    axios
        .post("https://www.brocade.io/api/items/009800895250")
        .then(response => {
            console.log(response.data)
        })

}
function removeFromInv(serial){
    axios
        .get("../../server/controller/invcon.php", {
            params: {
                "uid": user,
                "function": "remove",
                "serial": serial
            }
        })
        .then(response=>{
            console.log(response.data)
            return response.data
        })
        $('#myTable').DataTable().ajax.reload()
        invTable.ajax.reload(null, false)
}
function addToInv(item, qty, expiry, category) {
    axios
        .get("../../server/controller/invcon.php", {
            params: {
                "uid": user,
                "function": "add",
                "item": item,
                "qty": qty,
                "expiry": expiry,
                "category": category
            }
        })
        .then(response=>{
            console.log(response.data)
            return response.data
        })
        $('#myTable').DataTable().ajax.reload(null, false)
        invTable.ajax.reload(null, false)
}

function processImg(e) { sendToAPI(e.target.files) }

function sendToApi(file) {

}
function renderForm(){
const inv = Vue.createApp({
    data() {
        return {
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
            item: "",
            qty: "",
            expiry: "",
            category: "",
        }
    },
    methods: {
        submit() {
            let success = addToInv(this.item, this.qty, this.expiry, this.category)
            this.item = ""
            this.qty = ""
            this.expiry = ""
            this.category = ""
            $('#myTable').DataTable().ajax.reload(null, false)
            invTable.ajax.reload(null, false)
        }
    }
}).mount("#main")}

function changeMode(){
    let selectedmode = document.getElementById("modeselect").value
    invTable.ajax.url('../../server/controller/invtabledisplay.php?mode='+selectedmode+'&uid='+user).load()
    $('#myTable').DataTable().ajax.reload()
    invTable.ajax.reload(null, false)
}
function checkExpiry(){
    axios
        .get("../../server/controller/invcon.php", {
            params: {
                "uid": user,
                "function": 'checkexpire'
            }
        })
        .then(response=>{
console.log(response.data)
        })

}
  