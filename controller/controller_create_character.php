<?php
// session_start();
// include "../utils/utils.php";
// include "../model/model_create_character.php";
// include "../controller/controller_header.php";
// include "../view/view_create_character.php";


class ControllerCreateCharacter{
    private ?ModelCreateCharacter $modelCreateCharacter;
    private ?ViewCreateCharacter $viewCreateCharacter;

    public function __construct(ModelCreateCharacter $modelCreateCharacter, ViewCreateCharacter $viewCreateCharacter){
        $this->modelCreateCharacter = $modelCreateCharacter;
        $this->viewCreateCharacter = $viewCreateCharacter;
    }

    public function getModelCreateCharacter():ModelCreateCharacter{
        return $this->modelCreateCharacter;
    }
    public function getViewCreateCharacter():ViewCreateCharacter{
        return $this->viewCreateCharacter;
    }
    public function setModelCreateCharacter(?ModelCreateCharacter $modelCreateCharacter):self {
        $this->modelCreateCharacter = $modelCreateCharacter;
        return $this;
    }
    public function setViewCreateCharacter(ViewCreateCharacter $viewCreateCharacter):?self{
        $this->viewCreateCharacter = $viewCreateCharacter;
        return $this;
    }


    public function signUpCharacter():string | int{
        //*vérifier qu'on reçoit le formulaire
        if(!isset($_POST["submit"])){
            return "";
        }
        //* vérifier si le nom du personnage est renseigné
        if(empty($_POST["name"])){

            return "<span style='color: red'>*Veuillez saisir un nom</span>";
        }
        //* nettoyage des données
        $name=sanitize($_POST["name"]);
        $lp=sanitize($_POST["lp"]);
        $mp=sanitize($_POST["mp"]);
        $atk=sanitize($_POST["atk"]);
        $def=sanitize($_POST["def"]);
        $atkm=sanitize($_POST["atkm"]);
        $defm=sanitize($_POST["defm"]);
        $speed=sanitize($_POST["speed"]); 
        //* appliquer 0 si un champ n'est pas renseigné ou renseigné avec un 0
        $lp = $_POST["lp"] === "" ? 0 : (int)$_POST["lp"];
        $mp = $_POST["mp"] === "" ? 0 : (int)$_POST["mp"];
        $atk = $_POST["atk"] === "" ? 0 : (int)$_POST["atk"];
        $def = $_POST["def"] === "" ? 0 : (int)$_POST["def"];
        $atkm = $_POST["atkm"] === "" ? 0 : (int)$_POST["atkm"];
        $defm = $_POST["defm"] === "" ? 0 : (int)$_POST["defm"];
        $speed = $_POST["speed"] === "" ? 0 : (int)$_POST["speed"];
        //* vérifier que le nom du personnage est disponible en bdd
        $this->getModelCreateCharacter()->setName($name);
        
        $data=$this->getModelCreateCharacter()->getByName();

        if(!empty($data)){
        
            return "<span style='color: red'>*Ce nom n'est pas disponible</span>";
        }
        //* donner les informations au model
        $this->getModelCreateCharacter()
        ->setName($name)->setLp($lp)->setMp($mp)->setAtk($atk)->setDef($def)->setAtkm($atkm)->setDefm($defm)->setSpeed($speed)->setId($_SESSION["id_user"]);
        //* demander au model d'utiliser sa fonction add
        return $this->getModelCreateCharacter()->addCharacter();
    }

    public function render():void{

        $message=$this->signUpCharacter();

        echo $this->getViewCreateCharacter()->setMessage($message)->displayView();
    }
}

// $CreateCharacter=new ControllerCreateCharacter(new ModelCreateCharacter(), new ViewCreateCharacter());
// $CreateCharacter->render();

// include "../view/view_footer.php";