<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>FoodWise</title>
        <!-- Js scripts -->
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/ShoppingList.css" />
        <link rel="stylesheet" href="../css/shared.css" />   
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <div id="shoppingList">
            <!-- navbar -->
            <?php
                require_once './common/navbar.php';
            ?>
            <!-- Header-->
             <!-- Header-->
             <header class="bg-image py-5" style="background-image: url('../images/home/food.jpg'); box-shadow: inset 0 0 0 1000px rgba(0,0,0,.5);">
                <div class="container px-5">
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-6">
                            <div class="text-center my-5">
                                <h1 class="fw-bolder text-white mb-2">Shopping list</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main>
                <!-- Shopping list -->
                <div class="shopping-list m-3">
                    <div class="row">
                        <div class="col-xl-10 my-2">
                            <div class="row">  
                                <div class=" col-xxl-9 mx-1 my-2">
                                    <input type="text" class="form-control" id="foodName" placeholder="Add item here" name="foodName" v-on:keyup="autocompleteSearch()"> 
                                </div>
                                <div class="col-xxl-1  mx-1 my-2">
                                    <button type="button" class="btn btn-primary px-5" v-on:click="addItem()">Add</button>
                                </div>
                                <div class="col-xxl-1 mx-1 my-2" v-if="sList.length != 0">
                                    <button type="button" class="btn btn-danger px-5" v-on:click="clearList()">Clear</button>
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div id="autocom" v-if="autocomlist.length != 0">
                                    <strong>Suggested: </strong>
                                    <button v-for="(item, index) in autocomlist" type="button" class="btn btn-secondary btn-sm mx-1 mb-1" v-bind:value="item" v-on:click="fillsearchbar(item)">
                                        {{item}}
                                    </button>
                                </div>
                            </div>
                            <div>
                                <h2 v-if="sList.length == 0" class="text-center my-5"> <iconify-icon icon="noto-v1:sad-but-relieved-face" width="35" height="35"></iconify-icon> List is empty...</h2>
                                <div v-else id="MainList">
                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="(item, index) in sList">
                                            <div class="row g-3">
                                                <div class="col-auto">
                                                    <input class="form-check-input" type="checkbox" v-bind:id="item.id">{{item.name}}
                                                </div>
                                                <div class="col-auto">
                                                    <input v-if="editlist.includes(item.id)" type="number" class="form-control" min="1" max="100" placeholder="Quantity" name="foodName" v-model="item.quantity">
                                                    <div v-else>Qty: {{item.quantity}}</div>
                                                </div>
                                                <div class="col-xxl-12">
                                                    <button v-if="editlist.includes(item.id)" type="button" class="btn btn-primary btn-sm mx-1"v-on:click="saveItemQuanity(item)">Save</button>
                                                    <button v-else type="button" class="btn btn-primary btn-sm mx-1"v-on:click="editItemQuanity(item)">Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm mx-1" v-on:click="deleteItem(item)">Delete</button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button v-if="sList.length != 0" type="button" class="btn btn-primary my-1" v-on:click="saveList()">Save List</button>
                            <p id='saveStatus'></p>
                        </div>
                        <div class="col-xl-2 my-2">
                            <!-- recommanded card -->
                            <div class="card mx-auto" id="RecommandCard">
                                <div class="card-header">
                                  Recommandations <button type="button" class="btn btn-primary btn-sm float-end" v-on:click="displaylist()">Add all</button>
                                </div>
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item">An item <button type="button" class="btn btn-primary btn-sm float-end" >Add</button></li>
                                  <li class="list-group-item">A second item <button type="button" class="btn btn-primary btn-sm float-end" >Add</button></li>
                                  <li class="list-group-item">A third item <button type="button" class="btn btn-primary btn-sm float-end" >Add</button></li>
                                  <li class="list-group-item">A fourth item <button type="button" class="btn btn-primary btn-sm float-end" >Add</button></li>
                                  <li class="list-group-item">A fifth item <button type="button" class="btn btn-primary btn-sm float-end" >Add</button></li>
                                  <li class="list-group-item">A sixth item <button type="button" class="btn btn-primary btn-sm float-end" >Add</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Footer-->
            <?php
                require_once './common/footer.php';
            ?>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="../js/ShoppingList.js"></script>
    </body>
</html>

