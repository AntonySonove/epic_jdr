<?php
session_start();
include "../utils/utils.php";
include "../model/model_create_character.php";
include "../controller/controller_header.php";
include "../view/view_create_character.php";


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
        if(isset($_POST["submit"])){

            //* vérifier si les chams sont vides
            if(empty($_POST["name"]) || empty($_POST["lp"]) || empty($_POST["mp"]) || empty($_POST["atk"]) || empty($_POST["def"]) || empty($_POST["atkm"]) || empty($_POST["defm"]) || empty($_POST["speed"])){

                return "<span style='color: red'>*Un ou plusieurs champs sont vides</span>";

            }else{
                //* nettoyage des données
                $name=sanitize($_POST["name"]);
                $lp=sanitize($_POST["lp"]);
                $mp=sanitize($_POST["mp"]);
                $atk=sanitize($_POST["atk"]);
                $def=sanitize($_POST["def"]);
                $atkm=sanitize($_POST["atkm"]);
                $defm=sanitize($_POST["defm"]);
                $speed=sanitize($_POST["speed"]);   
            }

            //* vérifier que le nom du personnage est disponible en bdd
            $this->getModelCreateCharacter()->setName($name);
            $data=$this->getModelCreateCharacter()->getByName();

            if(!empty($data)){
            
                return "<span style='color: red'>*Ce nom n'est pas disponible</span>";
            }

            //* donner les informations au model
            $this->getModelCreateCharacter()->setName($name)->setLp($lp)->setMp($mp)->setAtk($atk)->setDef($def)->setAtkm($atkm)->setDefm($defm)->setSpeed($speed)->setId($_SESSION["id_user"]);
            
            //* demander au model d'utiliser sa fonction add
            return $this->getModelCreateCharacter()->addCharacter();
        }

        return "";
    }

    public function render():void{

        //* charger les messages de la fonction signUpCharacter
        $message=$this->signUpCharacter();

        echo $this->getViewCreateCharacter()->setMessage($message)->displayView();
    }
}

$CreateCharacter=new ControllerCreateCharacter(new ModelCreateCharacter(), new ViewCreateCharacter());
$CreateCharacter->render();


include "../view/view_footer.php";
?>