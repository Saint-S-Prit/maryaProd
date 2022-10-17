 <!-- Modal Form-->
 <div class="card-body pt-0 text-center">
        <a href="?page=add">
          <button  class="btn btn-primary" type="button"        data-bs-toggle="modal" data-bs-target="#myModal">
            Ajouter utilisateur
          </button>
        </a>
        <!-- Modal-->
        <div class="modal fade text-start" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Signin Modal</h5>
                <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Lorem ipsum dolor sit amet consectetur.</p>

                <?php
                if (isset($statusMsg)) {
                  echo $statusMsg;
                }
                ?>
                <form method="post">
                  <div class="mb-3">
                    <label class="form-label" for="modalInputFirstname">Firstname</label>
                    <input class="form-control" id="modalInputFirstname" type="text" aria-describedby="firstnameHelp" name="firstname">
                    <div class="form-text" id="firstnameHelp">We'll never share your firstname with anyone else.</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="modalInputLastname">Lastname</label>
                    <input class="form-control" id="modalInputLastname" type="text" aria-describedby="lastnameHelp" name="lastname">
                    <div class="form-text" id="lastnameHelp">We'll never share your lastname with anyone else.</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="modalInputAddress">Address</label>
                    <input class="form-control" id="modalInputAddress" type="text" aria-describedby="addressHelp" name="address">
                    <div class="form-text" id="addressHelp">We'll never share your Address with anyone else.</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="modalInputPhone">Phone</label>
                    <input class="form-control" id="modalInputPhone" type="text" aria-describedby="phoneHelp" name="phone">
                    <div class="form-text" id="phoneHelp">We'll never share your Phone with anyone else.</div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="modalInputSexe">Phone</label>
                    <input class="form-control" id="modalInputSexe" type="text" aria-describedby="sexeHelp" name="sexe">
                    <div class="form-text" id="phoneHelp">We'll never share your Phone with anyone else.</div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="modalInputAvatar">Phone</label>
                    <input class="form-control" id="modalInputAvatar" type="file" aria-describedby="avatarHelp">
                    <div class="form-text" id="phoneHelp">We'll never share your Avatar with anyone else.</div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" name="submit">Enregistrer</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <section class="pt-0">
        <div class="container-fluid">
          <div class="row gy-4">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <?php
                    if ($jsonData) {

                      foreach ($jsonData as  $user)
                      {
                        ?>
                          <div class="row gy-3 align-items-center">
                            <div class="col-lg-4">
                              <div class="d-flex align-items-center"><strong class="text-sm d-none d-lg-block">
                              <?= $user["id"] ?>
                              </strong>

                              <img class="avatar ms-3" src="public/uploads/<?= $user["avatar"] ?>" alt="Alexander Shelby">
                                <div class="ms-3">
                                  <h3 class="h5 mb-0"><?= $user["firstName"]." ". $user["lastName"] ?></h3>
                                  <p class="text-sm fw-light mb-0">
                                    @
                                    <?= $user["firstName"] ?>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 text-center">
                              <div class="d-inline-block py-1 px-4 rounded-pill bg-dash-dark-3 fw-light text-sm">
                                <?= 
                                  $retVal = ($user["is_deleted"]) ? "debloquer" : "bloquer" ;
                                ?>
                               </div>
                            </div>
                            <div class="col-lg-4">
                              <ul class="list-inline text-center mb-0 d-flex justify-content-between mb-0 text-sm">
                                <li class="list-inline-item"><i class="fab fa-blogger-b me-2"></i>
                                <?= 
                                   $user["sexe"];
                                ?>
                                </li>
                                <li class="list-inline-item"><i class="fab fa-blogger-b me-2"></i>
                                <?= 
                                  $user["address"] ;
                                ?>
                                </li>
                                <li class="list-inline-item"><i class="fas fa-phone me-2"></i> <?= $user["phone"] ?></li>
                               
                              </ul>
                            </div>
                          </div>
                          <hr>

                        <?php
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>