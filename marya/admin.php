<?php
session_start();

  function getJson($path)
  {
    return json_decode(file_get_contents($path), true);

  }

  // get All Admins
  $jsonData = getJson("data/login.json");


  // get User By Id
  function getUserById($id,$users)
  {
      $user = array_filter($users, function($user)use($id){
          return $user['id'] == $id;
      });
      
      $user = array_values($user);
      //[IMPORTANT]
      return @$user[0]?:[];
  }

  function apiSendPost($url,$data){
    $payload = json_encode($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
    );
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }

  // emit user
  function emitNewUser($user)
  {
    return apiSendPost('http://localhost:8088/api/v1.0/emit-user', $user);
  }

  function emitUserNotFound()
  {
    return 'Ko';
  }


  $firstName = $_SESSION['firstName'];
  $lastName = $_SESSION['lastName'];
  $avatar = $_SESSION['avatar'];
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Choices.js-->
  <link rel="stylesheet" href="public/vendor/choices.js/public/assets/styles/choices.min.css">
  <!-- Google fonts - Muli-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="public/css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="public/css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.ico">


  <!-- script socket -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.2/socket.io.js" integrity="sha512-VJ6+sp2E5rFQk05caiXXzQd1wBABpjEj1r5kMiLmGAAgwPItw1YpqsCCBtq8Yr1x6C49/mTpRdXtq8O2RcZhlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
  <header class="header">
    <nav class="navbar navbar-expand-lg py-3 bg-dash-dark-2 border-bottom border-dash-dark-1 z-index-10">
      <div class="search-panel">
        <div class="search-inner d-flex align-items-center justify-content-center">
          <div class="close-btn d-flex align-items-center position-absolute top-0 end-0 me-4 mt-2 cursor-pointer"><span>Close </span>
            <svg class="svg-icon svg-icon-md svg-icon-heavy text-gray-700 mt-1">
              <use xlink:href="#close-1"> </use>
            </svg>
          </div>
          <div class="row w-100">
            <div class="col-lg-8 mx-auto">
              <form class="px-4" id="searchForm" action="#">
                <div class="input-group position-relative flex-column flex-lg-row flex-nowrap">
                  <input class="form-control shadow-0 bg-none px-0 w-100" type="search" name="search" placeholder="What are you searching for...">
                  <button class="btn btn-link text-gray-600 px-0 text-decoration-none fw-bold cursor-pointer text-center" type="submit">Search</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid d-flex align-items-center justify-content-between py-1">
        <div class="navbar-header d-flex align-items-center"><a class="navbar-brand text-uppercase text-reset" href="index.html">
            <div class="brand-text brand-big"><strong class="text-primary">Espace</strong><strong>Admin</strong></div>
            <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div>
          </a>
          <button class="sidebar-toggle">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy transform-none">
              <use xlink:href="#arrow-left-1"> </use>
            </svg>
          </button>
        </div>
        <ul class="list-inline mb-0">
          <li class="list-inline-item"><a class="search-open nav-link px-0" href="#">
              <svg class="svg-icon svg-icon-xs svg-icon-heavy text-gray-700">
                <use xlink:href="#find-1"> </use>
              </svg></a></li>
          <!-- Messages dropdown -->
          <li class="list-inline-item dropdown px-lg-2"><a class="nav-link text-reset px-1 px-lg-0" id="navbarDropdownMenuLink1" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                <use xlink:href="#envelope-1"> </use>
              </svg><span class="badge bg-dash-color-1">5</span></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink1">
              <li><a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="position-relative"><img class="avatar avatar-md" src="public/img/avatar-3.jpg" alt="Nadia Halsey">
                    <div class="availability-status bg-success"></div>
                  </div>
                  <div class="ms-3"> <strong class="d-block">Nadia Halsey</strong><span class="d-block text-xs">lorem ipsum dolor sit amit</span><small class="d-block">9:30am</small></div>
                </a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="position-relative"><img class="avatar avatar-md" src="public/img/avatar-2.jpg" alt="Peter Ramsy">
                    <div class="availability-status bg-warning"></div>
                  </div>
                  <div class="ms-3"> <strong class="d-block">Nadia Halsey</strong><span class="d-block text-xs">lorem ipsum dolor sit amit</span><small class="d-block">9:30am</small></div>
                </a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="position-relative"><img class="avatar avatar-md" src="public/img/avatar-1.jpg" alt="Sam Kaheil">
                    <div class="availability-status bg-danger"></div>
                  </div>
                  <div class="ms-3"> <strong class="d-block">Nadia Halsey</strong><span class="d-block text-xs">lorem ipsum dolor sit amit</span><small class="d-block">9:30am</small></div>
                </a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="position-relative"><img class="avatar avatar-md" src="public/img/avatar-5.jpg" alt="Sara Wood">
                    <div class="availability-status bg-secondary"></div>
                  </div>
                  <div class="ms-3"> <strong class="d-block">Nadia Halsey</strong><span class="d-block text-xs">lorem ipsum dolor sit amit</span><small class="d-block">9:30am</small></div>
                </a></li>
              <li><a class="dropdown-item text-center message" href="#"> <strong>See All Messages <i class="fas fa-angle-right ms-1"></i></strong></a></li>
            </ul>
          </li>
          <!-- Tasks dropdown                   -->
          <li class="list-inline-item dropdown px-lg-2"><a class="nav-link text-reset px-1 px-lg-0" id="navbarDropdownMenuLink2" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                <use xlink:href="#paper-stack-1"> </use>
              </svg><span class="badge bg-dash-color-3">9</span></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdownMenuLink2">
              <li><a class="dropdown-item" href="#">
                  <div class="d-flex justify-content-between mb-1"><strong>Task 1</strong><span>40% complete</span></div>
                  <div class="progress" style="height: 2px">
                    <div class="progress-bar bg-dash-color-1" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </a></li>
              <li><a class="dropdown-item" href="#">
                  <div class="d-flex justify-content-between mb-1"><strong>Task 2</strong><span>20% complete</span></div>
                  <div class="progress" style="height: 2px">
                    <div class="progress-bar bg-dash-color-2" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </a></li>
              <li><a class="dropdown-item" href="#">
                  <div class="d-flex justify-content-between mb-1"><strong>Task 3</strong><span>70% complete</span></div>
                  <div class="progress" style="height: 2px">
                    <div class="progress-bar bg-dash-color-3" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </a></li>
              <li><a class="dropdown-item" href="#">
                  <div class="d-flex justify-content-between mb-1"><strong>Task 4</strong><span>40% complete</span></div>
                  <div class="progress" style="height: 2px">
                    <div class="progress-bar bg-dash-color-4" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </a></li>
              <li><a class="dropdown-item" href="#">
                  <div class="d-flex justify-content-between mb-1"><strong>Task 5</strong><span>30% complete</span></div>
                  <div class="progress" style="height: 2px">
                    <div class="progress-bar bg-dash-color-1" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </a></li>
              <li> <a class="dropdown-item text-center" href="#"> <strong>See All Tasks <i class="fas fa-angle-right ms-1"></i></strong></a></li>
            </ul>

 
          <li class="list-inline-item logout px-lg-2"> <a class="nav-link text-sm text-reset px-1 px-lg-0" id="logout" href="deconnexion.php"> <span class="d-none d-sm-inline-block">Logout </span>
              <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                <use xlink:href="#disable-1"> </use>
              </svg></a></li>
        </ul>
      </div>
    </nav>
  </header>
  <div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
      <!-- Sidebar Header-->
      <div class="sidebar-header d-flex align-items-center p-4">

       <img class="avatar shadow-0 img-fluid rounded-circle" src="public/uploads/<?= $avatar ?>"
       alt="<?= $avatar?>">
        <div class="ms-3 title">
          <h1 class="h5 mb-1">
          <?=$lastName?>
          </h1>
          <p class="text-sm text-gray-700 mb-0 lh-1">
            <?= $firstName?>
          </p>
        </div>
      </div>
      <ul class="list-unstyled">
        <li class="sidebar-item active"><a class="sidebar-link" href="?page=usersCurents">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy">
              <use xlink:href="#real-estate-1"> </use>
            </svg><span>Accueil</span></a></li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="?page=users">
                <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                  <use xlink:href="#disable-1"> </use>
                </svg><span>Utilisateurs</span>
              </a>
            </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="statistique.php">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy">
              <use xlink:href="#disable-1"> </use>
            </svg><span>Statistiques</span>
          </a>
        </li>
      </ul>

    </nav>
    <div class="page-content">
      <!-- Page Header-->
      <div class="bg-dash-dark-2 py-4">
        <div class="container-fluid">
          <h2 class="h5 mb-0">Tableau de bord</h2>
        </div>
      </div>
      
    <section>
        <div class="container-fluid">
        <div class="row gy-4">
            <div class="col-md-3 col-sm-6">
            <div class="card mb-0">
                <div class="card-body">
                <div class="d-flex align-items-end justify-content-between mb-2">
                    <div class="me-2">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                        <use xlink:href="#user-1"> </use>
                    </svg>
                    <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">Hommes</p>
                    </div>
                    <p class="text-xxl lh-1 mb-0 text-dash-color-1">33</p>
                </div>
                <div class="progress" style="height: 3px">
                    <div class="progress-bar bg-dash-color-1" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-md-3 col-sm-6">
            <div class="card mb-0">
                <div class="card-body">
                <div class="d-flex align-items-end justify-content-between mb-2">
                    <div class="me-2">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                        <use xlink:href="#stack-1"> </use>
                    </svg>
                    <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">Femmes</p>
                    </div>
                    <p class="text-xxl lh-1 mb-0 text-dash-color-2">22</p>
                </div>
                <div class="progress" style="height: 3px">
                    <div class="progress-bar bg-dash-color-2" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-md-3 col-sm-6">
            <div class="card mb-0">
                <div class="card-body">
                <div class="d-flex align-items-end justify-content-between mb-2">
                    <div class="me-2">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                        <use xlink:href="#survey-1"> </use>
                    </svg>
                    <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">inactif users</p>
                    </div>
                    <p class="text-xxl lh-1 mb-0 text-dash-color-3">12</p>
                </div>
                <div class="progress" style="height: 3px">
                    <div class="progress-bar bg-dash-color-3" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-md-3 col-sm-6">
            <div class="card mb-0">
                <div class="card-body">
                <div class="d-flex align-items-end justify-content-between mb-2">
                    <div class="me-2">
                    <svg class="svg-icon svg-icon-sm svg-icon-heavy text-gray-600 mb-2">
                        <use xlink:href="#paper-stack-1"> </use>
                    </svg>
                    <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">Users</p>
                    </div>
                    <p class="text-xxl lh-1 mb-0 text-dash-color-4">12</p>
                </div>
                <div class="progress" style="height: 3px">
                    <div class="progress-bar bg-dash-color-4" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

      <!--list looger login -->

    <div class="container">

      <?php 
        if (isset($_GET['page']))
        {
          $p = $_GET['page'];

          switch ($p) {
            case 'users':
              include 'users.php';
              break;
            
            case 'add':
              include 'addUser.php';
              break;
            
            case 'addUserCurent':
              include 'AddUserCurent.php';
              break;
            
            default:
            include 'usersCurents.php';
              break;
          }
        }
        else
        {
          include 'usersCurents.php';
        }
      ?>
      </div>

      <!-- Page Footer-->
      <footer class="position-absolute bottom-0 bg-dash-dark-2 text-white text-center py-3 w-100 text-xs" id="footer">
        <div class="container-fluid text-center">
          <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          <p class="mb-0 text-dash-gray">2022 &copy; Team Marya. Design by <a href="#">MariaDb</a>.</p>
        </div>
      </footer>
    </div>
  </div>
  <!-- JavaScript files-->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/vendor/just-validate/js/just-validate.min.js"></script>
  <script src="public/vendor/chart.js/Chart.min.js"></script>
  <script src="public/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="public/js/charts-home.js"></script>
  <!-- Main File-->
  <script src="public/js/front.js"></script>
  <script>
    // ------------------------------------------------------- //
    //   Inject SVG Sprite - 
    //   see more here 
    //   https://css-tricks.com/ajaxing-svg-sprite/
    // ------------------------------------------------------ //
    function injectSvgSprite(path) {

      var ajax = new XMLHttpRequest();
      ajax.open("GET", path, true);
      ajax.send();
      ajax.onload = function(e) {
        var div = document.createElement("div");
        div.className = 'd-none';
        div.innerHTML = ajax.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
      }
    }
    injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
  </script>
  <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">



  <script>
    window.onload = function (){
        const socket = io.connect('http://localhost:8088');
        socket.on("newUser", function(data) {
            console.log("enter");
            let html = `
      <a class="d-block d-flex align-items-center text-reset  text-decoration-none bg-dash-dark-2 py-2 px-3" href="#">
          <div class="position-relative">
            <img class="avatar" src="public/uploads/${data.avatar}" alt="">
            <span class="availability-status bg-success"></span>
          </div>
          <div class="ms-3">
            <p class="fw-bold mb-0">${data.firstName} ${data.lastName}</p>
            <p class="small fw-light mb-0">${data.dateTime}</p>
          </div>
        </a>
      `;
            $("#list-user").append(html);

            console.log("enter");

        });
    }
</script>
</body>

</html>