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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <style>
        #details {
                border-radius:20px;
                box-shadow: 3px 3px 5px #888888;
            }
        .box {
                --mask: 
                conic-gradient(from 135deg at top,#0000,#000 1deg 89deg,#0000 90deg) top/20.00px 51% repeat-x,
                conic-gradient(from -45deg at bottom,#0000,#000 1deg 89deg,#0000 90deg) bottom/20.00px 51% repeat-x;
            -webkit-mask: var(--mask);
                    mask: var(--mask);
        
                        
            }
    </style>
</head>

<body>
    <div id="main">
        <!-- Navbar -->

        <?php
        session_start();
        require_once './common/navbar.php';
        require_once "./common/protect.php";
        require_once "../../server/DAO/AccountDAO.php";
        if (!empty($_SESSION)) {
            $user = $_SESSION['login'];
            echo "<input type='hidden' id='userId' value = {$user} >";
        }

        $accdao = new AccountDAO();
        $userobj = $accdao->getAccByUid($_SESSION['login']);
        $un = $userobj->getUsername();
        $email = $userobj->getEmail();
        $date = $userobj->getDate();
        ?>

        <!-- header -->
        <header class='bg-image pb-2 justify-content-center text-center' style='overflow:hidden;' >
            <div>
                <img src='../images/header_profile.png' height=330>
                <div class='container px-5'>
                </div>
            </div>
        </header>

        <!-- profile content -->
        <div class="container-fluid my-4">
            <div class='row justify-content-center'>
                <div class='col-lg-4'>
                    <div class="card mt-2 animate__animated animate__fadeInUp" id='details' style='overflow-x: auto;'>
                        <div class="card-body my-3">
                            <h1 class="card-title text-center mb-5" style='font-family: Georgia,serif;'>Hi, {{username}}!</h1>
                            <div class="card-text">
                                <div class='row'>

                                    <div class='col-sm-4 my-2 text-start  fw-bold'>Username:</div>
                                    <div class='col-sm-5 my-2 text-start '>{{ username }}</div>
                                    <div class='col-sm-3 my-2 text-start '><a v-bind:href='updateun' class='btn btn-light'>Update</a></div>
                        
                                    <div class='w-100'></div>
                                    <div class='col-sm-4  my-2 fw-bold'>Email:</div>
                                    <div class='col-sm-5 my-2'>{{email}}</div>
                                    <div class='col-sm-3 my-2'><a v-bind:href='updateemail' class='btn btn-light'>Update</a></div>
                        
                                    <div class='w-100'></div>
                                    <div class='col-sm-4 fw-bold my-2'>Date Joined:</div>
                                    <div class='col-sm-5 my-2'>{{date}}</div>
                                    <div class='col-sm-3 my-2'></div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-lg-7'>
                    <div class='box'>
                    <div class="card mt-2 animate__animated animate__fadeInUp " style='max-height:500px;overflow-y: auto;border:none;'>
                        <div class="card-body">
                            <h1 class="card-title text-center mt-5 mb-3" style='font-family: Georgia,serif;'>Search History</h1>
                            <!-- <div class="dropdown animate__animated animate__fadeInUp"> -->
                          
                            <button type="button" class="btn btn-white dropdown-toggle float-end" data-bs-toggle="dropdown">Sort By Time</button>
                            <ul class="dropdown-menu dropdown animate__animated ">
                                            <li>
                                                <a class="dropdown-item" @click="sortdesc()">Lastest to Oldest</a>
                                                <a class='dropdown-item' @click="sortaesc()">Oldest to Latest</a>
                                            </li>
                                        </ul>
                                    </div>

                            <div class="card-text">
                                <table class='table mx-3'>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Search</th>
                                        <th>Cuisine</th>
                                        <th>Meal Type</th>
                                        <th>Dietary Preference</th>
                                        <th>Timestamp</th>
                                    </tr>
                                    <tr v-for='(sh,idx) in searchHist'>
                                        <td>{{idx+1}}</td>
                                        <td> {{sh.search}}</td>
                                        <td>{{sh.cuisine}}</td>
                                        <td>{{sh.meal}}</td>
                                        <td>{{sh.diet}}</td>
                                        <td>{{sh.time}}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        </div>


        <!-- Footer -->
        <?php
        require_once 'common/footer.php';
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="../../app/js/profile.js"></script>
</body>

</html>