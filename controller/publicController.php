<?php
/*
 * Public's controller
 */

// connect view
if(isset($_GET['connect'])){
    // click to submit
    if(!empty($_POST)){
        // create an instance and hydrate Theuser
        $recupUser = new Theuser($_POST);
        // try to connect
        $connectUser = $userManager->connectUser($recupUser);
        // connect ok (strict true)
        if($connectUser===true){
            header("Location: ./");
            exit();
        }
        // connect not ok without sql error (false)
        if(!$connectUser){
            $message = "Login et/ou mot de passe incorrecte";
        // sql error
        }else{
            $message = $connectUser;
        }
    }
    require_once "../view/public/connectPublicView.php";
    exit();
}

// article detail view
if(isset($_GET['idarticle'])&&ctype_digit($_GET['idarticle'])){
    // exercice's action

    // view
    require_once "../view/public/articlePublicView.php";
    exit();
}

// author detail view
if(isset($_GET['idauteur'])&&ctype_digit($_GET['idauteur'])){
    // select author
    $iduser = (int) $_GET['idauteur'];
    $recup = $userManager->selectOneUserById($iduser);
    // no sql error
    if(is_array($recup)){
        // user exist
        if(!empty($recup)){
            $user = new Theuser($recup);
        }else{
            $message = "Cet utilisateur n'existe plus";
        }
    }else{
        $message = $recup;
    }


    // exercice's action

    // view
    require_once "../view/public/auteurPublicView.php";
    exit();
}


// home view
require_once "../view/public/indexPublicView.php";