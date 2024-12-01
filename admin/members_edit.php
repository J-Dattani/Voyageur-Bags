<?php
include('conn.php');

// Check if 'id' parameter is set in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM team WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for the provided ID.";
        exit;
    }
} else {
    echo "Error: 'id' parameter is missing in the URL.";
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member = $_POST['name'];
    $designation = $_POST['designation'];

    // Check if an image was uploaded
    if (isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name'])) {
        // Get the file name
        $fileName = basename($_FILES["image"]["name"]);

        // Define folder to store uploaded images
        $targetDir = "uploads_stores/";

        // Define file path
        $targetFilePath = $targetDir . $fileName;

        // Get file extension
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (!in_array($fileType, $allowTypes)) {
            $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.";
            header("location: ./members_edit.php?id=$id");
            exit();
        }

        // Upload file to server
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            header("location: ./members_edit.php?id=$id");
            exit();
        }

        // Update query with image
        $update_query = "UPDATE team SET member=?, designation=?, image=? WHERE id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("sssi", $member, $designation, $fileName, $id); // Updated parameter binding for image

    } else {
        // Update query without image
        $update_query = "UPDATE team SET member=?, designation=? WHERE id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssi", $member, $designation, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "Member details updated successfully!";
        header("location: ./members_list.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating member details: " . $conn->error;
        header("location: ./members_edit.php?id=$id");
        exit();
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./bags.png" type="image/x-icon">
    <title>Voyageur Bags - Admin</title>>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/select2.css">
    <link rel="stylesheet" href="css/dropzone.css">
    <link rel="stylesheet" href="css/uppy.min.css">
    <link rel="stylesheet" href="css/jquery.steps.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
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
<di class="navbar-nav flex-fill w-100 mb-2">
            <div class="nav-item dropdown">
              <a href="./dashboard.php" data-toggle="collapse" aria-expanded="false" class="nav-link">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
              </a>
              <div class="collapse list-unstyled pl-4 w-100" id="dashboard">
              </div>
</div>

<!-- FOR CATEGORIES -->

<li class="nav-item dropdown">
              <a href="#charts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-grid fe-16"></i>
                <span class="ml-3 item-text">Category</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="charts">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./category_add.php"><span class="ml-1 item-text">Add</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./category_list.php"><span class="ml-1 item-text">list</span></a>
              </ul>
            </li>

<!-- FOR Itens -->

<li class="nav-item dropdown">
              <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fe fe-layers fe-16"></i>
                <span class="ml-3 item-text">Items</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="forms">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./items_add.php"><span class="ml-1 item-text">Add</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./items_list.php"><span class="ml-1 item-text">List</span></a>
                </li>
                </ul>

                          
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
          <h2 class="page-title">Items
          </h2>
          <div class="card shadow mb-4">
            <div class="card-header">
              <strong class="card-title">Edit Item</strong>
            </div>
            <form  enctype="multipart/form-data" action="" method="post">
            
            <div class="card-body">
              <div class="row">
             
                <div class="col-md-6">
                    <div class="card-body">
                        <div class="form-group">
                        
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="<?php echo ($row['member']); ?>" 
                          required>
                        </div>
                        <div class="form-group">
                          <label for="designation">Designation</label>
                          <input class="form-control form-control-lg" id="designation" name="designation" type="text" value="<?php echo ($row['designation']); ?>" required>

                         
                        </div>
                        
                </div> <!-- /.col -->
                
                </div>

                                  
                <div class="form-group mb-3">
                <br>
                <label for="image">Add Image</label>
                
                  <input type="file" id="image"  name="image" class="form-control-file" >
                  
                  </div>
                  
                </div>
                  <br>    
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a type="submit" href="members_list.php" class='btn btn-danger'>Dismiss</a>
            
                </div>
                
                </div>
            </div>
        </div>
                      </div>
                      
          </div> <!-- / .card -->
      
          <?php if (isset($_SESSION['error'])) { ?>
            <h3 style="font-size: large;color: red;">
              <?php 
              echo "<br>";
              echo $_SESSION['error'];
              echo $_SESSION['success'];
              ?>
            </h3>
          <?php } ?>
          
        </form>

          
  </main>
    
  <script src="js/jquery.min.js"></script>
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
    <?php
session_destroy()
?>  
</body>
</html>
