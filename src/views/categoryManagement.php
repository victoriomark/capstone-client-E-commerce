<!doctype html><html lang="en"><head>    <meta charset="UTF-8">    <meta name="viewport"          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">    <meta http-equiv="X-UA-Compatible" content="ie=edge">    <title>Category</title>    <link rel="stylesheet" href="../../css/bootstrap.min.css">    <link rel="stylesheet" href="../../style.css">    <script src="../../js/bootstrap.bundle.min.js"></script>    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">    <!-- Include jQuery -->    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    <!-- Include DataTables JS -->    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>    <!--    ajax cdn-->    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    <!--    cdn sweet alert-->    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head><body><header style="background-color: #000000" class="container-fluid d-flex justify-content-between align-items-center p-3">    <nav aria-label="breadcrumb">        <ol class="breadcrumb">            <li class="breadcrumb-item"><a class="text-light" href="./dashboard.php">Dashboard</a></li>            <li class="breadcrumb-item active text-light" aria-current="page">Category</li>        </ol>    </nav>    <button data-bs-toggle="modal" data-bs-target="#categoryModal" class="btn btn-outline-primary">Create New Category</button></header><section class="mt-5 p-4">    <table id="example" class="table">        <thead>        <tr>            <th>CategoryId</th>            <th>Category Name</th>            <th>Action</th>        </tr>        </thead>        <tbody>        <?php           include_once '../controller/categoryController.php';           $categoryList = new \controller\categoryController();           $categoryList->displayCategory();        ?>        </tbody>    </table></section><!-- category modal Modal --><div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">    <form id="formCategory" action="../controller/categoryController.php" method="post" class="modal-dialog modal-dialog-centered">        <div class="modal-content">            <div class="modal-header">                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Category</h1>                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>            </div>            <div class="modal-body">                <div class="form-floating mb-3">                    <input name="CategoryName" type="text" class="form-control" id="floatingInput">                    <label for="floatingInput">Category Name</label>                </div>            </div>            <div class="modal-footer">                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                <button type="submit" class="btn btn-primary">Create</button>            </div>        </div>    </form></div><script>    let table = new DataTable('#example',{        scrollCollapse: true,        scrollY: '50vh',        destroy: true,        paging: true,        searching: true,        ordering: true    });</script><script>    $(document).ready(function (){        $(document).on('submit','#formCategory',function (event){            event.preventDefault();            const formData = new FormData(this)            formData.append('action','create')            $.ajax({                url: '../controller/categoryController.php',                type: 'post',                data: formData,                contentType: false,                processData: false,                dataType: 'json',                success: function (res){                    switch (res.success){                        case false:                            Swal.fire({                                text: res.message,  // Display the error message                                confirmButtonColor: '#4361ee',                                icon: 'error',                                toast: true,                                target: 'body',                                position: 'top-end',                                showConfirmButton: false,                                timer: 2000,  // Auto-close the alert after 2 seconds                                timerProgressBar: true,  // Show the progress bar for the timer                            });                            break;                        case true:                            Swal.fire({                                icon: "success",                                text: res.message,                                showConfirmButton: false,                                timer: 1500                            });                            $('#categoryModal').modal('hide')                            setTimeout(() =>{window.location.reload()},2000)                            break;                    }                }            })        })        $(document).on('click','#btn_update',function (e){            $.ajax({                url: '../controller/categoryController.php',                type: 'post',                data: {                    id: e.target.value,                    action: 'update'                },                success: function (res){                    $('body').append(res)                    $(`#ModalUpdate_${e.target.value}`).modal('show')                }            })        })        $(document).on('submit','#formCategorySave',function (event){            event.preventDefault();            const formData = new FormData(this)            formData.append('action','save')            $.ajax({                url: '../controller/categoryController.php',                type: 'post',                data: formData,                contentType: false,                processData: false,                dataType: 'json',                success: function (res){                  switch (res.success){                      case false:                          Swal.fire({                              text: res.message,  // Display the error message                              confirmButtonColor: '#4361ee',                              icon: 'error',                              toast: true,                              target: 'body',                              position: 'top-end',                              showConfirmButton: false,                              timer: 2000,  // Auto-close the alert after 2 seconds                              timerProgressBar: true,  // Show the progress bar for the timer                          });                          break;                      default:                          Swal.fire({                              text: res.message,  // Display the error message                              confirmButtonColor: '#4361ee',                              icon: 'success',                              toast: true,                              target: 'body',                              position: 'top-end',                              showConfirmButton: false,                              timer: 2000,  // Auto-close the alert after 2 seconds                              timerProgressBar: true,  // Show the progress bar for the timer                          });                          setTimeout(() =>{window.location.reload()},2000)                  }                }            })        })        $(document).on('click','#btn_remove',function (e){            $.ajax({                url: '../controller/categoryController.php',                type: 'post',                data: {                    id: e.target.value,                    action: 'remove'                },                dataType: 'json',                success:function (res){                    switch (res.success){                        case false:                            Swal.fire({                                text: res.message,  // Display the error message                                confirmButtonColor: '#4361ee',                                icon: 'error',                                toast: true,                                target: 'body',                                position: 'top-end',                                showConfirmButton: false,                                timer: 2000,  // Auto-close the alert after 2 seconds                                timerProgressBar: true,  // Show the progress bar for the timer                            });                            break;                        default:                            Swal.fire({                                text: res.message,  // Display the error message                                confirmButtonColor: '#4361ee',                                icon: 'success',                                toast: true,                                target: 'body',                                position: 'top-end',                                showConfirmButton: false,                                timer: 2000,  // Auto-close the alert after 2 seconds                                timerProgressBar: true,  // Show the progress bar for the timer                            });                            setTimeout(() =>{window.location.reload()},2000)                    }                }            })        })    })</script></body></html>