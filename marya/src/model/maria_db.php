<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=mariadb_dev;charset=utf8', 'root', '', array(
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ));
    return $db;
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

function addUser($firstname, $lastname, $address, $phone, $sexe, $avatar, $user_code, $role)
{
    global $db;
    $insert = $db->prepare("INSERT INTO user (firstname, lastname, address, phone, sexe, avatar,is_deleted,user_code, role) VALUES (?,?,?,?,?,?,?,?,?)");
    $insert->execute([$firstname, $lastname, $address, $phone, $sexe, $avatar, 0, $user_code, $role]);
}

function getUserByUserCode($userCode)
{
    global $db;
    $query = $db->prepare('SELECT * FROM user WHERE user_code = ?');
    $query->execute([$userCode]);
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    return $result;
    
}

function getUserById($id)
{
    global $db;
    $query = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute([$id]);
    $result = $query->fetch(PDO::FETCH_OBJ);
    return $result;
}


function getUsers()
{
    global $db;
    $query = $db->prepare("SELECT * FROM user ");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getUsersSexe($val)
{
    global $db;
    $query = $db->prepare("SELECT * FROM user where sexe = ?");
    $query->execute([$val]);
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getUsersDelete()
{
    global $db;
    $query = $db->prepare("SELECT * FROM user where is_deleted = 1");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getUserDelete($userCode)
{
    global $db;
    $sql = $db->prepare("UPDATE user  SET is_deleted = 1  WHERE user_code = ?");
    $sql->execute([$userCode]);
}


function addControllerAccessIn($user, $dateStarted, $token)
{
    global $db;
    $insert = $db->prepare("INSERT INTO controlleaccess (user, date_started, date_end, statut, token) VALUES (?,?,?,?,?)");
    $insert->execute([$user, $dateStarted, null, true, $token]);
}

function addControllerAccessOut($token,$dateEnd)
{
    global $db;

    $sql = $db->prepare("UPDATE controlleaccess SET date_end = ? , statut = false WHERE token = ?");
    $sql->execute([$dateEnd , $token]);
}

function getUsersControllerAccess()
{
    global $db;
    $query = $db->prepare("SELECT * FROM controlleaccess WHERE statut = true");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function getUserControllerAccess($id)
{
    global $db;
    $query = $db->prepare("SELECT * FROM controlleaccess where id=?");
    $query->execute([$id]);
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    return $result;
}




