<?php
  $userCurents = getJson("data/UserCurent.json");
?>
<section class="pt-0">
        <div class="container-fluid">
          <div class="row gy-4">
            <div class="col-lg-8">
              <div class="card">
                <div  class="card-body">
                  <h3  class="h4 mb-3">Aujourd'hui</h3>

                  <div id='list-user'>
                  <?php
                      foreach ($userCurents as $userCurent) {

                        ?>
                        <a class="d-block d-flex align-items-center text-reset text-decoration-none bg-dash-dark-2 py-2 px-3" href="#">
                          <div class="position-relative">
                            <img class="avatar" src="public/uploads/<?= $userCurent['avatar'] ?>"alt="">
                            <span class="availability-status bg-success"></span>
                          </div>
                          <div class="ms-3">
                            <p class="fw-bold mb-0"><?= $userCurent['firstName'].' '.$userCurent['lastName'] ?></p>
                            <p class="small fw-light mb-0"><?= $userCurent['dateTime'] ?></p>
                          </div>
                        </a>

                        <?php
                      }


                  ?>
                      </div>

                  
                  

                  <!-- <a class="d-block d-flex align-items-center text-reset text-decoration-none bg-dash-dark-2 py-2 px-3" href="#">
                    <div class="position-relative">
                      <img class="avatar" src="public/diallo.jpg" alt="">
                      <span class="availability-status bg-success"></span>
                    </div>
                    <div class="ms-3">
                      <p class="fw-bold mb-0">Mamadou Diallo</p>
                      <p class="small fw-light mb-0">2022-03-22 09:26:11</p>
                    </div>
                  </a>

                  <a class="d-block d-flex align-items-center text-reset text-decoration-none bg-dash-dark-2 py-2 px-3" href="#">
                    <div class="position-relative">
                      <img class="avatar" src="public/thioro.jpg" alt="">
                      <span class="availability-status bg-success"></span>
                    </div>
                    <div class="ms-3">
                      <p class="fw-bold mb-0">Thioro Thiam</p>
                      <p class="small fw-light mb-0">2022-03-24 20:16:41</p>
                    </div>
                  </a>
                  
                  
                  <a class="d-block d-flex align-items-center text-reset text-decoration-none bg-dash-dark-2 py-2 px-3" href="#">
                    <div class="position-relative"><img class="avatar" src="public/karim.jpg" alt=""><span class="availability-status bg-success"></span></div>
                    <div class="ms-3">
                      <p class="fw-bold mb-0">Karim Diop</p>
                      <p class="small fw-light mb-0">2022-02-12 12:59:51</p>
                    </div>
                  </a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>