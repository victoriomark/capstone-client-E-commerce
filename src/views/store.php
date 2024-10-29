<?phpsession_start();if (! $_SESSION['username']){    header('Location: ../index.php');}?><!doctype html><html lang="en"><head>    <meta charset="UTF-8">    <meta name="viewport"          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">    <meta http-equiv="X-UA-Compatible" content="ie=edge">    <link rel="stylesheet" href="../../css/bootstrap.min.css">    <script src="../../js/bootstrap.bundle.min.js"></script>    <script src="https://kit.fontawesome.com/d4532539ca.js" crossorigin="anonymous"></script>    <!--    ajax cdn-->    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    <!--    cdn sweet alert-->    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    <title>E-COMMERCE</title></head><style>    <style>    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');    .card img {        object-fit: cover;    }    body {        font-family: 'Poppins', sans-serif;    }    .banner {        background: url('../../Assets/images/kitchen.png') no-repeat center center;        background-size: cover;        height: 40vh;        display: flex;        align-items: center;        justify-content: center;    }    .banner-text {        font-size: 3rem;        font-weight: bold;        color: white;        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);        text-align: center;    }    .icon-container img {        width: 80px;        height: auto;    }    .icon-title {        font-weight: bold;        font-size: 1.25rem;    }    .icon-text {        font-size: 0.9rem;    }    .highlight-section {        font-size: 1.4rem;        font-weight: bold;    }    .highlight-section p {        font-size: 1rem;    }    .card{        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;    }   #btn_category{       transition: 0.5s;   }   #btn_category:hover{       transform: translateY(-10px);   }</style><body>    <header style="background-color: #000000" id="head_"  class="sticky-top  shadow-sm p-2">        <nav class="navbar navbar-expand-lg">            <div class="container-fluid">                <a class="navbar-brand" href="#">                    <h6 class="text-light">GRANNY’S<span class="text-primary">Cafe & Kitchen.</span></h6>                </a>                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">                    <span class="navbar-toggler-icon"></span>                </button>                <div class="collapse navbar-collapse" id="navbarNav">                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">                        <li class="nav-item">                            <a class="nav-link fw-bold text-light" href="homepage.php">Home</a>                        </li>                        <li class="nav-item">                            <a class="nav-link fw-bold text-light" href="./userOrders.php">Orders</a>                        </li>                    </ul>                    <div class="d-flex gap-2">                        <button data-bs-target="#cartSideBar" data-bs-toggle="offcanvas" class="btn btn-outline-primary">cart</button>                        <button id="btn_logout" class="btn btn-outline-danger fw-bold">Logout</button>                    </div>                </div>            </div>        </nav>    </header>    <div class="offcanvas  offcanvas-end" tabindex="-1" id="cartSideBar" aria-labelledby="offcanvasRightLabel">        <div class="offcanvas-header">            <h5 class="offcanvas-title fw-bold text-muted" id="offcanvasRightLabel">Cart</h5>            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>        </div>        <div class="offcanvas-body">            <table class="table">                <thead>                <tr>                    <th scope="col">Image</th>                    <th scope="col">ProductName</th>                    <th scope="col">Quantity</th>                    <th scope="col">Price</th>                    <th scope="col">Total</th>                    <th scope="col">Action</th>                </tr>                </thead>                <tbody>                <?php                  include_once '../controller/cartController.php';                  $userId = $_SESSION['userId'];                  $cart = new \controller\cartController();                  $cart->DisplayCart($userId);                ?>                </tbody>            </table>          <button data-bs-target="#checkOutModal" data-bs-toggle="modal" class="btn btn-outline-dark">CheckOut</button>        </div>    </div>    <div class="container-fluid  p-0">        <div class="banner flex-column">            <div class="banner-text">              MENU            </div>        </div>    </div><section class="p-5"><h5>Featured Category</h5>    <div class="container-fluid row gap-3">        <?php        include_once '../controller/categoryController.php';        $category = new  \controller\categoryController();        $category->GetAllCategoryDisplayToStore();        ?>    </div></section><section id="productCon" class="container-fluid row gap-3 justify-content-center align-items-center p-5">    <?php     include_once '../controller/productController.php';     $product = new \controller\productController();     $product->DisplayToStore();    ?></section>    <!-- Modal for check out -->    <div class="modal fade" id="checkOutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">        <form id="orderForm" action="../controller/cartController.php" class="modal-dialog modal-dialog-centered modal-lg">            <div class="modal-content">                <div class="modal-header">                    <h1 class="modal-title fs-5" id="exampleModalLabel">Summary Order</h1>                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                </div>                <div class="modal-body d-flex flex-column gap-2">                    <?php                    $userId = $_SESSION['userId'];                      $cart->orders($userId);                    ?>                </div>                <div class="modal-footer">                    <button type="submit" class="btn btn-primary">submit</button>                </div>            </div>        </form>    </div>    <footer class="bg-dark text-white pt-4">        <div class="container">            <div class="row">                <!-- About Section -->                <div class="col-lg-4 col-md-6 mb-4">                    <h5>About Us</h5>                    <p>                        We are dedicated to providing you with the best products, ensuring quality and customer satisfaction.                    </p>                </div>                <!-- Links Section -->                <div class="col-lg-4 col-md-6 mb-4">                    <h5>Quick Links</h5>                    <ul class="list-unstyled">                        <li><a href="#" class="text-white">Home</a></li>                        <li><a href="#" class="text-white">Shop</a></li>                        <li><a href="#" class="text-white">Contact Us</a></li>                        <li><a href="#" class="text-white">Privacy Policy</a></li>                    </ul>                </div>                <!-- Contact Section -->                <div class="col-lg-4 col-md-6 mb-4">                    <h5>Contact Us</h5>                    <ul class="list-unstyled">                        <li><i class="bi bi-telephone-fill"></i> +63 123 456 789</li>                        <li><i class="bi bi-envelope-fill"></i> support@example.com</li>                        <li><i class="bi bi-geo-alt-fill"></i> 123 Main Street, Manila, PH</li>                    </ul>                </div>            </div>            <!-- Social Media Icons -->            <div class="row justify-content-center">                <div class="col-auto">                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>                    <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>                    <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>                </div>            </div>            <!-- Copyright -->            <div class="text-center mt-3">                <p class="mb-0">&copy; 2024 Your Company. All Rights Reserved.</p>            </div>        </div>    </footer><script>    $(document).ready(function (){        $(document).on('submit','#cart_form',function (event){            event.preventDefault();            const formData = new FormData(this)            formData.append('action','AddCart')            $.ajax({                url: '../controller/cartController.php',                type: 'post',                data: formData,                contentType: false,                processData: false,                dataType: 'json',                success: function (res){                    if (res.success === true){                        Swal.fire({                            text: res.message,  // Display the error message                            confirmButtonColor: '#4361ee',                            icon: 'success',                            toast: true,                            target: 'body',                            position: 'top-end',                            showConfirmButton: false,                            timer: 2000,  // Auto-close the alert after 2 seconds                            timerProgressBar: true,  // Show the progress bar for the timer                        });                        setTimeout(()=>{window.location.reload()},2000)                    }                    if (res.message === 'Insufficient stock available.'){                        Swal.fire({                            text: res.message,  // Display the error message                            confirmButtonColor: '#4361ee',                            icon: 'error',                            toast: true,                            target: 'body',                            position: 'top-end',                            showConfirmButton: false,                            timer: 2000,  // Auto-close the alert after 2 seconds                            timerProgressBar: true,  // Show the progress bar for the timer                        });                    }                }            })        })        $(document).on('click','#btn_logout',function (){            Swal.fire({                text: "Are You Sure Want to Logout ",                icon: "question",                showCancelButton: true,                confirmButtonColor: "#3085d6",                cancelButtonColor: "#d33",                confirmButtonText: "Yes,"            }).then((result) => {                if (result.isConfirmed) {                  window.location.href = '../../Auth/logout.php';                }            });        })        $(document).on('click','#btn_remove',function (e){            $.ajax({                url: '../controller/cartController.php',                type: 'post',                data: {                    cartId: e.target.value,                    action: 'Remove'                },                dataType: 'json',                success: function (res){                   window.location.reload();                }            })        })        $(document).on('submit', '#orderForm', function (event) {            event.preventDefault();            let orderItems = [];            const formData = new FormData(this);            const productIds = $('input[name="productId[]"]').map(function() { return $(this).val(); }).get();            const productNames = $('input[name="productName[]"]').map(function() { return $(this).val(); }).get();            const quantities = $('input[name="quantity[]"]').map(function() { return $(this).val(); }).get();            const prices = $('input[name="price[]"]').map(function() { return $(this).val(); }).get();            const itemTotals = $('input[name="itemTotal[]"]').map(function() { return $(this).val(); }).get();            for (let i = 0; i < productIds.length; i++) {                orderItems.push({                    productId: productIds[i],                    productName: productNames[i],                    quantity: quantities[i],                    price: prices[i],                    itemTotal: itemTotals[i]                });            }            formData.append('orderItems', JSON.stringify(orderItems));            formData.append('action', 'createOrders');            $.ajax({                url: '../controller/orderController.php',                type: 'post',                data: formData,                contentType: false,                processData: false,                dataType: 'json',                success: function (res) {                    if (res.success === false){                        Swal.fire({                            text: res.message,  // Display the error message                            confirmButtonColor: '#4361ee',                            icon: 'error',                            toast: true,                            target: 'body',                            position: 'top-end',                            showConfirmButton: false,                            timer: 2000,  // Auto-close the alert after 2 seconds                            timerProgressBar: true,  // Show the progress bar for the timer                        });                    }else {                        Swal.fire({                            text: res.message,  // Display the error message                            confirmButtonColor: '#4361ee',                            icon: 'success',                            toast: true,                            target: 'body',                            position: 'top-end',                            showConfirmButton: false,                            timer: 2000,  // Auto-close the alert after 2 seconds                            timerProgressBar: true,  // Show the progress bar for the timer                        });                        setTimeout(()=>{window.location.reload()},2000)                    }                }            });        });        $(document).on('click', '#btn_category', function () {            const categoryName = $(this).data('category'); // Get category name from data attribute            console.log(categoryName); // Debug to ensure the correct category name is passed            $.ajax({                url: '../controller/productController.php',                type: 'post',                data: {                    categoryName: categoryName,  // Correctly pass categoryName                    action: 'showUsingCategory'                },                success: function (data) {                    $('#productCon').html(data);                }            });        });    })</script></body></html>