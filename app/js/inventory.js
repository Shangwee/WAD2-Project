
  
function openForm() {
    if (document.getElementById("myForm").style.display === "none" || document.getElementById("myForm").style.display === ""){
        document.getElementById("myForm").style.display = "block"
    }
    else{document.getElementById("myForm").style.display = "none"}
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
function removeFromInv(serial){
    if (document.getElementById("modeselect").value === "current"){
        if (confirm("Remove the item from inventory and mark it as consumed?")){
    axios
        .get("../../server/controller/invcon.php", {
            params: {
                "uid": user,
                "function": "remove",
                "serial": serial
            }
        })
        $('#myTable').DataTable().ajax.reload()
        invTable.ajax.reload(null, false)}
        else{
            return
        }
}
else{
    if (confirm("Delete the item from inventory history?")){
    axios
    .get("../../server/controller/invcon.php", {
        params: {
            "uid": user,
            "function": "delete",
            "serial": serial
        }
    })
    $('#myTable').DataTable().ajax.reload()
    invTable.ajax.reload(null, false)}
    else{
        return
    }
}}
function addToInv(item, qty, expiry, category) {
    if (confirm("Add the item to the inventory?")){
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
    else{
        return
    }
    
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
