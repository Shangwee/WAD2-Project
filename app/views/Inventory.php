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
    
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/recipe.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <script src="../js/inventory.js"></script>
    <!-- Datatables-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <style>
        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding-left:10px;
            padding-right:10px;
            padding-top:5px;
            padding-bottom:5px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            width: 150px;
            right:0px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text],
        .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus,
        .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }
    </style>
</head>
<body>

    <main>
        <div id="main">
        <!-- navbar -->
        <?php
        session_start();
        require_once "./common/protect.php";
        require_once './common/navbar.php';
        // getting user variable from php to javascript
        $user = $_SESSION["login"];
        echo "<input type = 'hidden' id = 'passuser' name = 'userid' value = {$user}>";
        ?>
        <script>
            var user = document.getElementById("passuser").value
            window.addEventListener("load", myInit, true); function myInit() {
                renderForm();
                checkExpiry();
                invTable = $("#myTable").DataTable({
                    columnDefs: [
                    ],
                    columns: [
                        { title: 'S/N' },
                        { title: 'Item' },
                        { title: 'Qty' },
                        { title: 'Expiry' },
                        { title: 'Category' },
                        { title: '',
                            "render": function ( data, type, row ) {
                        if (document.getElementById("modeselect").value === 'current' || document.getElementById("modeselect").value === 'historical') {
                            return '<button>Remove</button>';
                        }
                        return ''; }}
                    ],
                    ajax: {
                        url: `../../server/controller/invtabledisplay.php?mode=current&uid=${user}`,
                        type: 'GET',
                        dataSrc: "",
                    }
                })
                invTable.on('click', 'button', function (e) {
                    let data = invTable.row(e.target.closest('tr')).data()[0]
                    let success = removeFromInv(data)
                    $('#myTable').DataTable().ajax.reload(null, false)
                    invTable.ajax.reload(null, false)
                })
            }

        </script>
        <!-- header -->
        <header class="bg-image py-5" style="background-image: url('../images/header1.png'); ">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center my-5">
                            <h1 class="fw-bolder  mb-2 animate__animated animate__fadeInUp" style='font-family: Georgia,serif;'>Inventory</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

            <div class="form-popup" id="myForm">
                <form action="/action_page.php" class="form-container">

                    <label for="Item"><b>Item</b></label>
                    <input type="text" placeholder="Enter Item Name" v-model="item" required>

                    <label for="qty"><b>Quantity</b></label>
                    <input type="text" placeholder="Enter Qty" v-model="qty" required>

                    <label for="expiry"><b>Expiry Date (YYYY-MM-DD)</b></label>
                    <input type="text" placeholder="Enter Expiry" v-model="expiry" required>

                    <label for="category"><b>Category</b></label>
                    <input type="text" placeholder="Enter Category" v-model="category" required>

                    <button type="button" class="btn" @click="submit()">Add</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>
        </div>
        <div class="container">
            <div class="row my-3">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <h3>Filter</h3>
                    <div class="row justify-content-between mb-2">
                        <div class="col-sm-9" style = "width:225px;">
                            <select class="form-select float-start" onchange="changeMode()" id = "modeselect">
                                <option value = "current">
                                    Current Inventory
                                </option>
                                <option value = "historical">
                                    Historical Inventory
                                </option>
                                <option value = "expiring">
                                    Expiring Soon
                                </option>
                                <option value = "expired">
                                    Expired Today
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                                <button class = "open-button float-end" onclick = "openForm()">Add To Inventory</button>
                            </div>
                    </div>

                    <table class="table" id="myTable" class="display-compact order-column table">
                    </table>
                    <div class="col-sm-1">
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer-->
    <?php
    require_once './common/footer.php';
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <!-- Core theme JS-->
    <script src="../../app/js/inventory.js"></script>
</body>

</html>