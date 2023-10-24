<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shopping List</title>
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
        session_start();
        require_once './common/navbar.php';
        require_once "./common/protect.php";
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="h1">My Shopping List</h1>
                <!-- hidden input of user session ID-->
                <input type="hidden" id="userId" value="<?php echo $_SESSION['login']; ?>">
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addItemModal">Add Item</button>
                <!-- <button class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#loadShoppingListModal">Load Shopping List</button> -->
                <button class="btn btn-secondary mx-1" data-bs-toggle="modal" data-bs-target="#filterModal">Filter</button>
                <button class="btn btn-info ms-2" data-bs-toggle="modal" data-bs-target="#sortModal">Sort</button>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
            <p id="filterStatus" v-if="isFilter"><em>Filter Applied</em></p>
                <h2 v-if="sList.length == 0" class="text-center my-5"> <iconify-icon icon="noto-v1:sad-but-relieved-face" width="35" height="35"></iconify-icon> List is empty...</h2>
                <div v-else id="MainList">    
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center" v-for="(item, index) in sList">
                            <div>
                                <input class="form-check-input mx-1" type="checkbox" v-model="item.status" v-on:click="checkItem(item)">
                                <span class="item-name" v-bind:id="item.id">{{item.name}}</span>
                                <input v-if="editlist.includes(item.id)" class="mx-1" type="number" min="1" max="100" placeholder="Quantity" name="foodName" v-model="item.quantity">
                                <span class="badge bg-primary rounded-pill ms-2" v-else>Qty: {{item.quantity}}</span>
                            </div>
                            <div>
                                <button v-if="editlist.includes(item.id)" class="btn btn-success btn-sm edit-item mx-1" v-on:click="saveItemQuanity(item)">Save</button>
                                <button v-else class="btn btn-primary btn-sm edit-item mx-1" v-on:click="editItemQuanity(item)">Edit</button>
                                <button class="btn btn-danger btn-sm delete-item mx-1" v-on:click="deleteItem(item.id)">Delete</button>
                            </div>
                        </li>
                        <!-- Add more items here -->
                    </ul>
                    <div class="my-2">
                        <button class="btn btn-primary btn-sm me-2" v-on:click="clearList()">Clear List</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <h2 class="h2">Recommendations</h2>
                <ul class="list-group">
                    <li class="list-group-item">Recommended Item 1</li>
                    <li class="list-group-item">Recommended Item 2</li>
                    <li class="list-group-item">Recommended Item 3</li>
                    <!-- Add more recommendations here -->
                </ul>
            </div>
        </div>
    </div>
    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="itemInput">Item Name</label>
                            <input type="text" class="form-control" id="itemInput" v-model="inputitem" v-on:keyup="autocompleteSearch()">
                            <div id="autocom" class="mt-3" v-if="autocomlist.length != 0">
                                <strong>Suggested: </strong>
                                <button v-for="(item, index) in autocomlist" type="button" class="btn btn-secondary btn-sm mx-1 mb-1" v-bind:value="item" v-on:click="fillsearchbar(item)">{{item}}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="addItem()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Shopping List Modal -->
    <div class="modal fade" id="loadShoppingListModal" tabindex="-1" aria-labelledby="loadShoppingListModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loadShoppingListModalLabel">Load Shopping List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add a form or input field to allow users to input or select a shopping list to load -->
                    <form>
                        <div class="mb-3">
                            <label for="shoppingListFile" class="form-label">Select a file to load</label>
                            <input type="file" class="form-control" id="shoppingListFile">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Load</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Shopping List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add filter options and form here -->
                    <form>
                        <div class="mb-3">
                            <label for="filterOptions" class="form-label">Filter by:</label>
                            <select class="form-select" id="filterOptions" v-model="selectedFilter">
                                <option v-for="option in filterOption">{{option}}</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="filterShoppingList()">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sort Modal -->
    <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sortModalLabel">Sort Shopping List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add sorting options and form here -->
                    <form>
                        <div class="mb-3">
                            <label for="sortOptions" class="form-label">Sort by:</label>
                            <select class="form-select" id="sortOptions">
                                <option value="name">Name (A-Z)</option>
                                <option value="quantity">Quantity (Low to High)</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Apply Sort</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer-->
<?php
    require_once './common/footer.php';
?>


<!-- Add Bootstrap 5 and Bootstrap Icons links -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="../js/ShoppingList.js"></script>
</body>
</html>