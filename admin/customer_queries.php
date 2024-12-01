<?php
include('queries_delete.php');
?>

<!doctype html>
<html lang="en">
  <head>


  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./bags.png" type="image/x-icon">
    <title>Voyageur Bags - Admin</title>
    <!-- Simple bar CSS -->

    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/select2.css">
    <link rel="stylesheet" href="css/dropzone.css">
    <link rel="stylesheet" href="css/uppy.min.css">
    <link rel="stylesheet" href="css/jquery.steps.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>

    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>
  </head>
  
  <body class="vertical  light  ">
    <div class="wrapper">
        <nav class="topnav navbar navbar-light">
            <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
              <i class="fe fe-menu navbar-toggler-icon"></i>
            </button>
            
            <ul class="nav">
    
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="avatar avatar-sm mt-2">
                    <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="profile.php">Profile</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </li>
            </ul>
            
          </nav>
      <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="dashboard.php">
          <img class="navbar-brand-img brand-sm" style="width: 65px; height:65px;" src="./bags.png" alt="">
              </a>
              <h5 style="position:relative; top:40px; ">Voyageur Bags</h5>
</div>
  <!--FOR Dashboard-->
  <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="dashboard">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="./dashboard.php"><span class="ml-1 item-text">Home</span></a>
                </li>
              
              </ul>
            </li>
        
<!-- FOR CATEGORIES -->

<li class="nav-item dropdown">
              <a href="#charts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-grid fe-16"></i>
                <span class="ml-3 item-text">Category</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="charts">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./category_add.php"><span class="ml-1 item-text">Add category</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./category_list.php"><span class="ml-1 item-text">Categories</span></a>
              </ul>
            </li>
          

<!-- FOR ITEMS -->

<li class="nav-item dropdown">
              <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">Items</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="forms">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./items_add.php"><span class="ml-1 item-text">Add Items</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./items_list.php"><span class="ml-1 item-text">Items</span></a>
                </li>
                </ul>
</li>

          
<!-- FOR ORDERS -->

<li class="nav-item dropdown">
              <a href="#layouts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-16 fe-shopping-bag"></i>
                <span class="ml-3 item-text">Orders</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="layouts">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./order_list.php"><span class="ml-1 item-text">Order Lsit</span></a>
                </li>
              </ul>
            </li>

                <!-- FOR team -->
<li class="nav-item dropdown">
              <a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Team</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="contact">
              <a class="nav-link pl-3" href="./member_add.php"><span class="ml-1">Add Members</span></a>
                <a class="nav-link pl-3" href="./members_list.php"><span class="ml-1">Members List</span></a>
              </ul>
            </li>


            

<!-- FOR STORES -->
<li class="nav-item dropdown">
              <a href="#support" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-map-pin fe-16"></i>
                <span class="ml-3 item-text">Location</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="support">
                <a class="nav-link pl-3" href="./stores_add.php"><span class="ml-1">Add Stores</span></a>
                <a class="nav-link pl-3" href="./stores_list.php"><span class="ml-1">Store list</span></a>
              </ul>
            </li>

            
<!-- FOR MARKETING -->

<li class="nav-item dropdown">
              <a href="#fileman" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Marketing</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="fileman">
                <a class="nav-link pl-3" href="./tagline_add.php"><span class="ml-1">Add Tagline</span></a>
                <a class="nav-link pl-3" href="./tagline.php"><span class="ml-1">Tagline</span></a>
              </ul>
            </li>

            
            <!-- FOR USERS LIST -->
            <li class="nav-item dropdown">
              <a href="#auth" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">Users</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="auth">
                <a class="nav-link pl-3" href="./users_list.php"><span class="ml-1">Users List</span></a>
              </ul>
            </li>


<!-- FOR Helpdesk -->

<li class="nav-item dropdown">
              <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-help-circle fe-16"></i>
                <span class="ml-3 item-text">Help Desk</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="tables">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./customer_queries.php"><span class="ml-1 item-text">Customer Queries</span></a>
                </li>
              </ul>
            </li>


</div>
        </nav>
      </aside>


<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <h2 class="page-title">Queries
          </h2>
          <div class="card shadow mb-4">
            <div class="card-header">
              <strong class="card-title">Lists of Queries</strong>
              <form method="post" action="">
            <div class="card-body">
      

            <?php if (isset($_SESSION['error'])) { ?>
      
      <script>
     swal.fire(
  '<?php echo $_SESSION['error'];?>',
  '<?php echo $_SESSION['status_code'];?>',
  'error'
)
      
      </script>
  <?php   unset($_SESSION['error']);
  unset($_SESSION['status_code']);
  } ?>
  <?php
  if (isset($_SESSION['success'])) { ?>
      
  <script>
       swal.fire(
  '<?php echo $_SESSION['success'];?>',
  '<?php echo $_SESSION['status_code'];?>',
  'success'
)
  </script>
    <?php 
  unset($_SESSION['success']);
  unset($_SESSION['status_code']);
  } ?>
  
<table id="userDataList" class="display" style="width:100%">
    <thead>
        <tr>
          <th>Sr no.</th>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
            <th>message</th>
            <th>Query Date</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
            </div>
            </div>
        
            <!---<button type="submit" value="Update" class="btn btn-primary">Add New</button>--->
    
</form>
  </main>

  
<script>
  //for sr no
  function updateSerialNumbers() {
    var dataTable = $('#userDataList').DataTable();
    dataTable.rows().every(function (rowIdx, tableLoop, rowLoop) {
        var rowData = this.data();
        // Update the serial number (Sr. No.) in the first column
        var serialNumber = rowIdx + 1;
        $(this.node()).find('td:first').text(serialNumber);
    });
}
</script>
    
<!-- jQuery library -->
// <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  
  <!-- <script src="js/jquery.min.js"></script> -->
<!-- DataTables CSS and JS library -->
<script type="text/javascript" src="datatables/datatables.min.js"></script>

  <script src="js/popper.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/simplebar.min.js"></script>
  <script src='js/daterangepicker.js'></script>
  <script src='js/jquery.stickOnScroll.js'></script>
  <script src="js/tinycolor-min.js"></script>
  <script src="js/config.js"></script>
  <script src="js/d3.min.js"></script>
  <script src="js/topojson.min.js"></script>
  <script src="js/datamaps.all.min.js"></script>
  <script src="js/datamaps-zoomto.js"></script>
  <script src="js/datamaps.custom.js"></script>
  <script src="js/Chart.min.js"></script>
  <script>
    /* defind global options */
    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
    Chart.defaults.global.defaultFontColor = colors.mutedColor;
  </script>
  <script src="js/gauge.min.js"></script>
  <script src="js/jquery.sparkline.min.js"></script>
  <script src="js/apexcharts.min.js"></script>
  <script src="js/apexcharts.custom.js"></script>
  <script src='js/jquery.mask.min.js'></script>
  <script src='js/select2.min.js'></script>
  <script src='js/jquery.steps.min.js'></script>
  <script src='js/jquery.validate.min.js'></script>
  <script src='js/jquery.timepicker.js'></script>
  <script src='js/dropzone.min.js'></script>
  <script src='js/uppy.min.js'></script>
  <script src='js/quill.min.js'></script>
  
  <script>
  
  $(document).ready(function(){
      $('#userDataList').dataTable({
              "processing": true,
              "ajax": "queries_fetchData.php",
              responsive: true,
              "columns": [
                { 
                data: null,
                render: function(data, type, row, meta) {
                    // Calculate serial number
                    var serialNumber = meta.row + 1;
                    
                    // Return the content for the first column (Sr. No.)
                    return serialNumber;
                }
            },
                  {data: 'id'},
                  {data: 'name'},
                  {data:'email'},
                  {data:'phone'},
                  {data:'message'},
                  {data:'query_date'},
                  {data:'action'}
              ]
          });
  });
</script>

  <script>
    $('.select2').select2(
    {
      theme: 'bootstrap4',
    });
    $('.select2-multi').select2(
    {
      multiple: true,
      theme: 'bootstrap4',
    });
    $('.drgpicker').daterangepicker(
    {
      singleDatePicker: true,
      timePicker: false,
      showDropdowns: true,
      locale:
      {
        format: 'MM/DD/YYYY'
      }
    });
    $('.time-input').timepicker(
    {
      'scrollDefault': 'now',
      'zindex': '9999' /* fix modal open */
    });
    /** date range picker */
    if ($('.datetimes').length)
    {
      $('.datetimes').daterangepicker(
      {
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale:
        {
          format: 'M/DD hh:mm A'
        }
      });
    }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end)
    {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker(
    {
      startDate: start,
      endDate: end,
      ranges:
      {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);
    cb(start, end);
    $('.input-placeholder').mask("00/00/0000",
    {
      placeholder: "__/__/____"
    });
    $('.input-zip').mask('00000-000',
    {
      placeholder: "____-___"
    });
    $('.input-money').mask("#.##0,00",
    {
      reverse: true
    });
    $('.input-phoneus').mask('(000) 000-0000');
    $('.input-mixed').mask('AAA 000-S0S');
    $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ',
    {
      translation:
      {
        'Z':
        {
          pattern: /[0-9]/,
          optional: true
        }
      },
      placeholder: "___.___.___.___"
    });
    // editor
    var editor = document.getElementById('editor');
    if (editor)
    {
      var toolbarOptions = [
        [
        {
          'font': []
        }],
        [
        {
          'header': [1, 2, 3, 4, 5, 6, false]
        }],
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [
        {
          'header': 1
        },
        {
          'header': 2
        }],
        [
        {
          'list': 'ordered'
        },
        {
          'list': 'bullet'
        }],
        [
        {
          'script': 'sub'
        },
        {
          'script': 'super'
        }],
        [
        {
          'indent': '-1'
        },
        {
          'indent': '+1'
        }], // outdent/indent
        [
        {
          'direction': 'rtl'
        }], // text direction
        [
        {
          'color': []
        },
        {
          'background': []
        }], // dropdown with defaults from theme
        [
        {
          'align': []
        }],
        ['clean'] // remove formatting button
      ];
      var quill = new Quill(editor,
      {
        modules:
        {
          toolbar: toolbarOptions
        },
        theme: 'snow'
      });
    }
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function()
    {
      'use strict';
      window.addEventListener('load', function()
      {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form)
        {
          form.addEventListener('submit', function(event)
          {
            if (form.checkValidity() === false)
            {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
  <script>
    var uptarg = document.getElementById('drag-drop-area');
    if (uptarg)
    {
      var uppy = Uppy.Core().use(Uppy.Dashboard,
      {
        inline: true,
        target: uptarg,
        proudlyDisplayPoweredByUppy: false,
        theme: 'dark',
        width: 770,
        height: 210,
        plugins: ['Webcam']
      }).use(Uppy.Tus,
      {
        endpoint: 'https://master.tus.io/files/'
      });
      uppy.on('complete', (result) =>
      {
        console.log('Upload complete! We’ve uploaded these files:', result.successful)
      });
    }
  </script>
  <script src="js/apps.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag()
    {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
  </script>

</body>
</html>