<?php


  if (isset($_POST['submit'])) {
   if (!empty($_POST['userCode'])) {
     $userCode = $_POST['userCode'];
     $codeHash = md5($userCode);
     $path = "data/login.json";
     $jsonString = file_get_contents($path);
     $jsonData = json_decode($jsonString, true);
    foreach ($jsonData as $user) {
       if ($user['codeUser'] == $codeHash) 
       {
         session_start();
         $_SESSION['firstName'] = $user['firstName'];
         $_SESSION['lastName'] = $user['lastName'];
         $_SESSION['avatar'] = $user['avatar'];
         header('Location:admin.php');       
      }
      else
      {
        $rep = "code non valide";
      }
     
   }
  }else
  {
    $rep = "Veuillez renseigner le code";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dark Admin by Bootstrapious.com</title>
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
  <link rel="shortcut icon" href="public/img/favicon.ico">
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
  <div class="login-page">
    <div class="container d-flex align-items-center position-relative py-5">
      <div class="card shadow-sm w-100 rounded overflow-hidden bg-none">
        <div class="card-body p-0">
          <div class="row gx-0 align-items-stretch">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex justify-content-center flex-column p-4 h-100">
                <div class="py-5">
                  <h1 class="display-6 fw-bold">Access Control</h1>
                  <p class="fw-light mb-0">Veuillez  vous identifier</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="d-flex align-items-center px-4 px-lg-5 h-100 bg-dash-dark-2">
              <form method="post">
                                <div class="mb-3">
                                    <label class="form-label" for="modalInputFirstname">identication</label>
                                    <input class="form-control" 
                                    id="modalInputFirstname"
                                     type="password" aria-describedby="userCode"
                                    name="userCode">
                                </div>
                                <?php
                                  if (isset($rep)) {
                                    echo "<p>".$rep."</p>";
                                  }
                                ?>
                                <p></p>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" name="submit">Enregistrer</button>
                            
                        </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="login-footer text-center position-absolute bottom-0 start-0 w-100">
      <p class="text-white">Design by <a class="external" href="https://bootstrapious.com/p/admin-template">MariaDb</a>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      </p>
    </div>
  </div>
  <!-- JavaScript files-->
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/vendor/just-validate/js/just-validate.min.js"></script>
  <script src="public/vendor/chart.js/Chart.min.js"></script>
  <script src="public/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
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
    // this is set to BootstrapTemple website as you cannot 
    // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
    // while using file:// protocol
    // pls don't forget to change to your domain :)
    injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
  </script>
  <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>

</html>