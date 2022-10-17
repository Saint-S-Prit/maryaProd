<?php
session_start();
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header('Location:index.php');
}
require('src/model/maria_db.php');
$id = $_SESSION['id'];
  //$logger = getUserById($id);
  $users = getUsers();
  $usersDeleted = getUsersDelete();
  $userCurrent = getUserById($id);

  $femmes = getUsersSexe('femme');
  $hommes = getUsersSexe('homme');

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
                  <div class="position-relative"><img class="avatar avatar-md" src="img/avatar-3.jpg" alt="Nadia Halsey">
                    <div class="availability-status bg-success"></div>
                  </div>
                  <div class="ms-3"> <strong class="d-block">Nadia Halsey</strong><span class="d-block text-xs">lorem ipsum dolor sit amit</span><small class="d-block">9:30am</small></div>
                </a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="position-relative"><img class="avatar avatar-md" src="img/avatar-2.jpg" alt="Peter Ramsy">
                    <div class="availability-status bg-warning"></div>
                  </div>
                  <div class="ms-3"> <strong class="d-block">Nadia Halsey</strong><span class="d-block text-xs">lorem ipsum dolor sit amit</span><small class="d-block">9:30am</small></div>
                </a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="position-relative"><img class="avatar avatar-md" src="img/avatar-1.jpg" alt="Sam Kaheil">
                    <div class="availability-status bg-danger"></div>
                  </div>
                  <div class="ms-3"> <strong class="d-block">Nadia Halsey</strong><span class="d-block text-xs">lorem ipsum dolor sit amit</span><small class="d-block">9:30am</small></div>
                </a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="position-relative"><img class="avatar avatar-md" src="img/avatar-5.jpg" alt="Sara Wood">
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

 
          <li class="list-inline-item logout px-lg-2"> <a class="nav-link text-sm text-reset px-1 px-lg-0" id="logout" href="login.html"> <span class="d-none d-sm-inline-block">Logout </span>
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
      <div class="sidebar-header d-flex align-items-center p-4"><img class="avatar shadow-0 img-fluid rounded-circle" src="public/uploads/<?= $userCurrent->avatar?>"
       alt="<?= $userCurrent->avatar?>">
        <div class="ms-3 title">
          <h1 class="h5 mb-1">
          <?= $userCurrent->lastname?>
          </h1>
          <p class="text-sm text-gray-700 mb-0 lh-1">
            <?= $userCurrent->firstname?>
          </p>
        </div>
      </div>
      <ul class="list-unstyled">
        <li class="sidebar-item active"><a class="sidebar-link" href="admin.php">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy">
              <use xlink:href="#real-estate-1"> </use>
            </svg><span>Accueil</span></a></li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="user.php">
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
          <h2 class="h5 mb-0"></h2>
        </div>
      </div>
      
<!-- https://codepen.io/jlalovi/details/bIyAr -->
<div class="container">
  <!-- DONUT CHART BLOCK (LEFT-CONTAINER) --> 
  <div class="donut-chart-block block"> 
    <h2 class="titular">Mois en cours</h2>
    <div class="donut-chart">
 <!-- PORCIONES GRAFICO CIRCULAR
      ELIMINADO #donut-chart
      MODIFICADO CSS de .donut-chart -->
      <div id="porcion1" class="recorte"><div class="quesito ios" data-rel="21"></div></div>
     <div id="porcion2" class="recorte"><div class="quesito mac" data-rel="39"></div></div>
     <div id="porcion3" class="recorte"><div class="quesito win" data-rel="31"></div></div>
     <div id="porcionFin" class="recorte"><div class="quesito linux" data-rel="9"></div></div>
 <!-- FIN AÑADIDO GRÄFICO -->
          <p class="center-date">Mars<br><span class="scnd-font-color">2022</span></p>        
  </div>
        <ul class="os-percentages horizontal-list">
            <li>
                <p class="ios os scnd-font-color">Karim</p>
                <p class="os-percentage">21<sup>%</sup></p>
            </li>
            <li>
                <p class="mac os scnd-font-color">Thioro</p>
                <p class="os-percentage">39<sup>%</sup></p>
            </li>
            <li>
                <p class="linux os scnd-font-color">Mamadou</p>
                <p class="os-percentage">9<sup>%</sup></p>
            </li>
        </ul>
    </div>
 <!-- LINE CHART BLOCK (LEFT-CONTAINER) -->
                <div class="line-chart-block block">
     <div class="line-chart">
       <div class='grafico'>
       <ul class='eje-y'>
         <li data-ejeY='30'></li>
         <li data-ejeY='20'></li>
         <li data-ejeY='10'></li>
         <li data-ejeY='0'></li>
       </ul>
       <ul class='eje-x'>
         <li>Avril</li>
         <li>Mai</li>
         <li>Juin</li>
       </ul>
         <span data-valor='25'>
           <span data-valor='8'>
             <span data-valor='13'>
               <span data-valor='5'>   
                 <span data-valor='23'>   
                 <span data-valor='12'>
                     <span data-valor='15'>
                     </span></span></span></span></span></span></span>
       </div>
       
     </div>
                    <ul class="time-lenght horizontal-list">
                        <li><a class="time-lenght-btn" href="#14">Semaine</a></li>
                        <li><a class="time-lenght-btn" href="#15">Mois</a></li>
                        <li><a class="time-lenght-btn" href="#16">Année</a></li>
                    </ul>
                    <ul class="month-data clear">
                        <li>
                            <p>AVRIL<span class="scnd-font-color"> 2022</span></p>
                            <p><span class="entypo-plus increment"> </span>21<sup>%</sup></p>
                        </li>
                        <li>
                            <p>MAI<span class="scnd-font-color"> 2022</span></p>
                            <p><span class="entypo-plus increment"> </span>48<sup>%</sup></p>
                        </li>
                        <li>
                            <p>JUIN<span class="scnd-font-color"> 2022</span></p>
                            <p><span class="entypo-plus increment"> </span>35<sup>%</sup></p>
                        </li>
                    </ul>
                </div>
                

  
  <div class="bar-chart-block block">
    <h2 class='titular'>Taux par semaine <span>*10</span></h2>
    <div class='grafico bar-chart'>
       <ul class='eje-y'>
         <li data-ejeY='60'></li>
         <li data-ejeY='45'></li>
         <li data-ejeY='30'></li>
         <li data-ejeY='15'></li>
         <li data-ejeY='0'></li>
       </ul>
       <ul class='eje-x'>
         <li data-ejeX='37'><i>Lundi</i></li>
         <li data-ejeX='56'><i>Mardi</i></li>
         <li data-ejeX='25'><i>Mercredi</i></li>
         <li data-ejeX='18'><i>Jeudi</i></li>
         <li data-ejeX='45'><i>Vendredi</i></li>
         <li data-ejeX='50'><i>Samedi</i></li>
         <li data-ejeX='31'><i>Dimance</i></li>
       </ul>
    </div>
  </div>
            </div>



      <!-- Page Footer-->
      <footer class="position-absolute bottom-0 bg-dash-dark-2 text-white text-center py-3 w-100 text-xs" id="footer">
        <div class="container-fluid text-center">
          <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          <p class="mb-0 text-dash-gray">2021 &copy; Your company. Design by <a href="https://bootstrapious.com">Bootstrapious</a>.</p>
        </div>
      </footer>
    </div>
  </div>



  <style>
    /************************
Css orignal https://codepen.io/jlalovi/details/bIyAr
************************/
@import url(https://fonts.googleapis.com/css?family=Ubuntu:400,700);
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;  
}
body {
	background: #1f253d;
}

ul {
	list-style-type: none;
	margin: 0;
	padding-left: 0;
}

h1 {
	font-size: 23px;
}

h2 {
	font-size: 17px;
}

p {
	font-size: 15px;
}

a {
	text-decoration: none;
	font-size: 15px;
}
	a:hover {
		text-decoration: underline;
	}

h1, h2, p, a, span{
	color: #fff;
}
	.scnd-font-color {
		color: #9099b7;
	}
.titular {
display: block;
line-height: 60px;
margin: 0;
text-align: center;
border-top-left-radius: 5px;
border-top-right-radius: 5px;
}
.horizontal-list {
	margin: 0;
	padding: 0;
	list-style-type: none;
}
	.horizontal-list li {
		float: left;
	}
		.block {
			margin: 25px 25px 25px 25px;
			background: #394264;
			border-radius: 5px;
      float: left;
      width: 90% !important;
      overflow: hidden;
		}
		/******************************************** LEFT CONTAINER *****************************************/
		.left-container {}
			.menu-box {
				height: 360px;
			}

			.donut-chart-block {
				overflow: hidden;
			}
				.donut-chart-block .titular {
					padding: 10px 0;
				}
				.os-percentages li {
					width: 75px;
					border-left: 1px solid #394264;
					text-align: center;					
					background: #50597b;
				}
					.os {
						margin: 0;
						padding: 10px 0 5px;
						font-size: 15px;		
					}
						.os.ios {
							border-top: 4px solid #e64c65;
						}
						.os.mac {
							border-top: 4px solid #11a8ab;
						}
						.os.linux {
							border-top: 4px solid #fcb150;
						}
						.os.win {
							border-top: 4px solid #4fc4f6;
						}
					.os-percentage {
						margin: 0;
						padding: 0 0 15px 10px;
						font-size: 25px;
					}
			.line-chart-block, .bar-chart-block {
				height: 400px;
			}
				.line-chart {
					height: 200px;
					background: #11a8ab;
				}
				.time-lenght {
					padding-top: 22px;
					padding-left: 38px;
          overflow: hidden;
				}
					.time-lenght-btn {
						display: block;
						width: 70px;
						line-height: 32px;
						background: #50597b;
						border-radius: 5px;
						font-size: 14px;
						text-align: center;
						margin-right: 5px;
						-webkit-transition: background .3s;
						transition: background .3s;
					}
						.time-lenght-btn:hover {
							text-decoration: none;
							background: #e64c65;
						}
				.month-data {
					padding-top: 28px;
				}
					.month-data p {
						display: inline-block;
						margin: 0;
						padding: 0 25px 15px;            
						font-size: 16px;
					}
						.month-data p:last-child {
							padding: 0 25px;
              float: right;
							font-size: 15px;
						}
						.increment {
							color: #e64c65;
						}

/******************************************
↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓ ↓
ESTILOS PROPIOS DE LOS GRÄFICOS
↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ ↑ 
GRAFICO LINEAL
******************************************/

.grafico {
  padding: 2rem 1rem 1rem;
  width: 100%;
  height: 100%;
  position: relative;
  color: #fff;
  font-size: 80%;
}
.grafico span {
  display: block;
  position: absolute;
  bottom: 3rem;
  left: 2rem;
  height: 0;
  border-top: 2px solid;
  transform-origin: left center;
}
.grafico span > span {
  left: 100%; bottom: 0;
}
[data-valor='25'] {width: 75px; transform: rotate(-45deg);}
[data-valor='8'] {width: 24px; transform: rotate(65deg);}
[data-valor='13'] {width: 39px; transform: rotate(-45deg);}
[data-valor='5'] {width: 15px; transform: rotate(50deg);}
[data-valor='23'] {width: 69px; transform: rotate(-70deg);}
[data-valor='12'] {width: 36px; transform: rotate(75deg);}
[data-valor='15'] {width: 45px; transform: rotate(-45deg);}

[data-valor]:before {
  content: '';
  position: absolute;
  display: block;
  right: -4px;
  bottom: -3px;
  padding: 4px;
  background: #fff;
  border-radius: 50%;
}
[data-valor='23']:after {
  content: '+' attr(data-valor) '%';
  position: absolute;
  right: -2.7rem;
  top: -1.7rem;
  padding: .3rem .5rem;
  background: #50597B;
  border-radius: .5rem;
  transform: rotate(45deg);  
}
[class^='eje-'] {
  position: absolute;
  left: 0;
  bottom: 0rem;
  width: 100%;
  padding: 1rem 1rem 0 2rem;
  height: 80%;
}
.eje-x {
  height: 2.5rem;
}
.eje-y li {
  height: 25%;
  border-top: 1px solid #777;
}
[data-ejeY]:before {
  content: attr(data-ejeY);
  display: inline-block;
  width: 2rem;
  text-align: right;
  line-height: 0;
  position: relative;
  left: -2.5rem;
  top: -.5rem;
} 
.eje-x li {
  width: 33%;
  float: left;
  text-align: center;
}

/******************************************
GRAFICO CIRCULAR PIE CHART
******************************************/
.donut-chart {
  position: relative;
	width: 200px;
  height: 200px;
	margin: 0 auto 2rem;
	border-radius: 100%
 }
p.center-date {
  background: #394264;
  position: absolute;
  text-align: center;
	font-size: 28px;
  top:0;left:0;bottom:0;right:0;
  width: 130px;
  height: 130px;
  margin: auto;
  border-radius: 50%;
  line-height: 35px;
  padding: 15% 0 0;
}
.center-date span.scnd-font-color {
 line-height: 0; 
}
.recorte {
    border-radius: 50%;
    clip: rect(0px, 200px, 200px, 100px);
    height: 100%;
    position: absolute;
    width: 100%;
  }
.quesito {
    border-radius: 50%;
    clip: rect(0px, 100px, 200px, 0px);
    height: 100%;
    position: absolute;
    width: 100%;
    font-family: monospace;
    font-size: 1.5rem;
  }
#porcion1 {
    transform: rotate(0deg);
  }

#porcion1 .quesito {
    background-color: #E64C65;
    transform: rotate(76deg);
  }
#porcion2 {
    transform: rotate(76deg);
  }
#porcion2 .quesito {
    background-color: #11A8AB;
    transform: rotate(140deg);
  }
#porcion3 {
    transform: rotate(215deg);
  }
#porcion3 .quesito {
    background-color: #4FC4F6;
    transform: rotate(113deg);
  }
#porcionFin {
    transform:rotate(-32deg);
  }
#porcionFin .quesito {
    background-color: #FCB150;
    transform: rotate(32deg);
  }
.nota-final {
  clear: both;
  color: #4FC4F6;
  font-size: 1rem;
  padding: 2rem 0;
}
.nota-final strong {
  color: #E64C65;
}
.nota-final a {
  color: #FCB150;
  font-size: inherit;
}
/**************************
BAR-CHART
**************************/
.grafico.bar-chart {
  background: #3468AF;
  padding: 0 1rem 2rem 1rem;
  width: 100%;
  height: 60%;
  position: relative;
  color: #fff;
  font-size: 80%;
}
.bar-chart [class^='eje-'] {
  padding: 0 1rem 0 2rem;
  bottom: 1rem;
}
.bar-chart .eje-x {
  bottom: 0;
}
 .bar-chart .eje-y li {
  height: 20%;
  border-top: 1px solid #fff;
}
.bar-chart .eje-x li {
  width: 14%;
  position: relative;
  text-align: left;
}
.bar-chart .eje-x li i {
  transform: rotatez(-45deg) translatex(-1rem);
  transform-origin: 30% 60%;
  display: block;
}
.bar-chart .eje-x li:before {
  content: '';
  position: absolute;
  bottom: 1.9rem;
  width: 70%;
  right: 5%;
  box-shadow: 3px 0 rgba(0,0,0,.1), 3px -3px rgba(0,0,0,.1);
}
.bar-chart .eje-x li:nth-child(1):before {
  background: #E64C65;  
  height: 570%;
}
.bar-chart .eje-x li:nth-child(2):before {
  background: #11A8AB;  
  height: 900%;
}
.bar-chart .eje-x li:nth-child(3):before {
  background: #FCB150;  
  height: 400%;
}
.bar-chart .eje-x li:nth-child(4):before {
  background: #4FC4F6;  
  height: 290%;
}
.bar-chart .eje-x li:nth-child(5):before {
  background: #FFED0D;  
  height: 720%;
}
.bar-chart .eje-x li:nth-child(6):before {
  background: #F46FDA;  
  height: 820%;
}
.bar-chart .eje-x li:nth-child(7):before {
  background: #15BFCC;  
  height: 520%;
}
/*****************************
USO NÚMEROS MÁGICOS EN ALGUNOS VALORES
POR NO PARARME A ESTUDIAR A FONDO
EL CSS DEL PEN ORIGINAL
*****************************/
  </style>
  <!-- JavaScript files-->
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/vendor/just-validate/js/just-validate.min.js"></script>
  <script src="public/vendor/chart.js/Chart.min.js"></script>
  <script src="public/vendor/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="public/js/charts-home.js"></script>
  <!-- Main File-->
  <script src="public/js/front.js"></script>
  <script>

var pieChartValues = [{
  y: 39.16,
  exploded: true,
  indexLabel: "Hello",
  color: "#1f77b4"
}, {
  y: 21.8,
  indexLabel: "Hi",
  color: "#ff7f0e"
}, {
  y: 21.45,
  indexLabel: "pk",
  color: " #ffbb78"
}, {
  y: 5.56,
  indexLabel: "one",
  color: "#d62728"
}, {
  y: 5.38,
  indexLabel: "two",
  color: "#98df8a"
}, {
  y: 3.73,
  indexLabel: "three",
  color: "#bcbd22"
}, {
  y: 2.92,
  indexLabel: "four",
  color: "#f7b6d2"
}];
renderPieChart(pieChartValues);

function renderPieChart(values) {

  var chart = new CanvasJS.Chart("pieChart", {
    backgroundColor: "white",
    colorSet: "colorSet2",

    title: {
      text: "Pie Chart",
      fontFamily: "Verdana",
      fontSize: 25,
      fontWeight: "normal",
    },
    animationEnabled: true,
    data: [{
      indexLabelFontSize: 15,
      indexLabelFontFamily: "Monospace",
      indexLabelFontColor: "darkgrey",
      indexLabelLineColor: "darkgrey",
      indexLabelPlacement: "outside",
      type: "pie",
      showInLegend: false,
      toolTipContent: "<strong>#percent%</strong>",
      dataPoints: values
    }]
  });
  chart.render();
}
var columnChartValues = [{
  y: 686.04,
  label: "one",
  color: "#1f77b4"
}, {
  y: 381.84,
  label: "two",
  color: "#ff7f0e"
}, {
  y: 375.76,
  label: "three",
  color: " #ffbb78"
}, {
  y: 97.48,
  label: "four",
  color: "#d62728"
}, {
  y: 94.2,
  label: "five",
  color: "#98df8a"
}, {
  y: 65.28,
  label: "Hi",
  color: "#bcbd22"
}, {
  y: 51.2,
  label: "Hello",
  color: "#f7b6d2"
}];
renderColumnChart(columnChartValues);

function renderColumnChart(values) {

  var chart = new CanvasJS.Chart("columnChart", {
    backgroundColor: "white",
    colorSet: "colorSet3",
    title: {
      text: "Column Chart",
      fontFamily: "Verdana",
      fontSize: 25,
      fontWeight: "normal",
    },
    animationEnabled: true,
    legend: {
      verticalAlign: "bottom",
      horizontalAlign: "center"
    },
    theme: "theme2",
    data: [

      {
        indexLabelFontSize: 15,
        indexLabelFontFamily: "Monospace",
        indexLabelFontColor: "darkgrey",
        indexLabelLineColor: "darkgrey",
        indexLabelPlacement: "outside",
        type: "column",
        showInLegend: false,
        legendMarkerColor: "grey",
        dataPoints: values
      }
    ]
  });

  chart.render();
}

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