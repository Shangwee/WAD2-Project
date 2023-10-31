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
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
</head>
<body>
<div id="shoppingList">
    <!-- navbar -->
    <?php
        session_start();
        require_once "./common/protect.php";
        require_once './common/navbar.php';
    ?>
    <div class="jumbotron text-center py-5" style="background-image: url('../images/home/food.jpg');background-size: cover;box-shadow: inset 0 0 0 1000px rgba(0,0,0,.5);">
        <h1 class="text-light animate__animated animate__fadeIn">Shopping List</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- hidden input of user session ID-->
                <input type="hidden" id="userId" value="<?php echo $_SESSION['login']; ?>">
            </div>
            <div class="col-md-6 text-end animate__animated animate__fadeInUp">
                <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addItemModal">Add Item</button>
                <button class="btn btn-secondary mx-1" data-bs-toggle="modal" data-bs-target="#filterModal">Filter</button>
                <button class="btn btn-info ms-2" data-bs-toggle="modal" data-bs-target="#sortModal">Sort</button>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
            <p id="filterStatus" v-if="isFilter"><em>Filter Applied</em></p>
                <h2 v-if="sList.length == 0" class="text-center my-5 animate__animated animate__fadeInUp"> <iconify-icon icon="noto-v1:sad-but-relieved-face" width="35" height="35"></iconify-icon> List is empty...</h2>
                <div v-else id="MainList">    
                    <ul class="list-group animate__animated animate__fadeIn">
                        <li class="list-group-item d-flex justify-content-between align-items-center" v-for="(item, index) in sList">
                            <div>
                                <input class="form-check-input mx-1" type="checkbox" v-model="item.status" v-on:click="checkItem(item)">
                                <span class="item-name" v-bind:id="item.id">{{item.name}}</span>
                                <div v-if="editlist.includes(item.id)" class="animate__animated animate__fadeIn">
                                    <select class="mx-1" id="editOptions" v-model="item.category">
                                        <option v-for="option in categoryOption">{{option}}</option>
                                    </select>
                                    <input class="mx-1" type="number" min="1" max="100" placeholder="Quantity" name="foodName" v-model="item.quantity">
                                </div>
                                <div v-else class="animate__animated animate__fadeIn">
                                <span class="badge bg-info rounded-pill ms-2">{{item.category}}</span>
                                    <span class="badge bg-primary rounded-pill ms-2">Qty: {{item.quantity}}</span>
                                </div>
                            </div>
                            <div>
                                <button v-if="editlist.includes(item.id)" class="btn btn-success btn-sm edit-item mx-1" v-on:click="saveItemQuanity(item)">Save</button>
                                <button v-else class="btn btn-primary btn-sm edit-item mx-1" v-on:click="editItemQuanity(item)">Edit</button>
                                <button class="btn btn-danger btn-sm delete-item mx-1" v-on:click="deleteItem(item.id)">Delete</button>
                            </div>
                        </li>
                        <!-- Add more items here -->
                    </ul>
                    <div class="my-2 animate__animated animate__fadeInUp">
                        <button class="btn btn-primary btn-sm me-2" v-on:click="clearList()">Clear List</button>
                    </div>
                    <div v-if="allChecked" class="my-2 animate__animated animate__fadeInUp">
                        <button class="btn btn-success btn-sm me-2" v-on:click="saveList()">Save List</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <h2 class="h2 animate__animated animate__fadeInUp">Recommendations</h2>
                <ul class="list-group animate__animated animate__fadeInUp">
                    <li class="list-group-item d-flex justify-content-between align-items-center"  v-for="(item, index) in recommendation">
                        <div>
                            <span class="item-name" v-bind:id="item.id">{{item.name}}</span>
                            <span class="badge bg-info rounded-pill ms-2">{{item.category}}</span>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-sm edit-item mx-1" data-bs-toggle="modal" data-bs-target="#addItemModal" v-on:click="addRecommandedItem(item)">Add</button>
                        </div>
                    </li>
                    <!-- Add more recommendations here -->
                </ul>
            </div>
        </div>
    </div>
    <!-- toaster -->

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
                            <label for="itemCategory" class="form-label">Category</label>
                            <select class="form-select" id="itemCategory" v-model="selectedCategory">
                                <option v-for="option in categoryOption">{{option}}</option>
                            </select>
                            <label for="itemQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="itemQuantity" min="1" max="100" v-model="quantity">
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
                            <select class="form-select" id="sortOptions" v-model="selectedSort">
                                <option v-for="option in sortOption">{{option}}</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" @click="sortShoppingList()">Apply Sort</button>
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