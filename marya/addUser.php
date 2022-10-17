<?php

$userDbNumbre =  count($jsonData);

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $sexe = $_POST['sexe'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $is_deleted = false;
    $codeUser = $_POST['codeUser'];


    if (!empty($firstName) && !empty($lastName) && !empty($sexe) && !empty($address) && !empty($phone) && !empty($_FILES["avatar"]["name"])&& !empty($codeUser)) {
                // File upload path
                $targetDir = "public/uploads/";
                $fileName = strtolower(basename($_FILES["avatar"]["name"]));
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                // Allow certain file formats
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
                if (in_array($fileType, $allowTypes)) {
                    // Upload file to server
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)) {
                        // Insert image file name into database

                        
                        /**
                         *Insert image file name into database
                         **/
                        $codeUser = md5($codeUser);

                        $data = array(
                            'id' => $userDbNumbre +1,
                            'firstName' => $firstName,
                            'lastName' => $lastName,
                            'avatar' => $fileName,
                            'sexe' => $sexe,
                            'address' => $address,
                            'phone' => $phone,
                            'is_deleted' => $is_deleted,
                            'codeUser' => $codeUser,
                        );


                            $inp = file_get_contents('data/login.json');
                            $tempArray = json_decode($inp);
                            array_push($tempArray, $data);
                            $jsonData = json_encode($tempArray);
                            file_put_contents('data/login.json', $jsonData);

                            $statusMsg = "Valide, Vous venez de creer un nouveau utilisateur. <h1>code: ".$codeUser."</h1>";

                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                }
    } else {
        $statusMsg = 'veuillez remplir tous les champs';
    }


}

?>
    <div id="addUser">
            <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Inscrire un Nouveau Utilisateur</h5>
                            <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <?php
                            if (isset($statusMsg)) {
                                echo $statusMsg;
                            }
                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label" for="modalInputFirstname">Firstname</label>
                                    <input class="form-control" id="modalInputFirstname" type="text" aria-describedby="firstnameHelp" name="firstName" value="<?php echo $retVal = (isset($firstName)) ? $firstName : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="modalInputLastname">Lastname</label>
                                    <input class="form-control" id="modalInputLastname" type="text" aria-describedby="lastNameHelp" name="lastName" value="<?php echo $retVal = (isset($lastName)) ? $lastName : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="modalInputAddress">Address</label>
                                    <input class="form-control" id="modalInputAddress" type="text" aria-describedby="addressHelp" name="address" value="<?php echo $retVal = (isset($address)) ? $address : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="modalInputPhone">Phone</label>
                                    <input class="form-control" id="modalInputPhone" type="text" aria-describedby="phoneHelp" name="phone" value="<?php echo $retVal = (isset($phone)) ? $phone : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="modalInputSexe">Sexe</label>
                                    <input class="form-control" id="modalInputSexe" type="text" aria-describedby="sexeHelp" name="sexe" value="<?php echo $retVal = (isset($sexe)) ? $sexe : ''; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="modalInputAvatar">Photo</label>
                                    <input class="form-control" id="modalInputAvatar" type="file" aria-describedby="avatarHelp" name="avatar">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="modalInputRole">password</label>
                                    <input class="form-control" id="modalInputRole" type="password" aria-describedby="codeUser" name="codeUser">
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