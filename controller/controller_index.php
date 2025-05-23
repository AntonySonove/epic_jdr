<?php
    session_start();
    // include "../model/model_index.php";
    // include "../utils/utils.php";
    // include "../controller/controller_header.php";
    // include "../view/view_index.php";

class ControllerIndex{

    //! attributs
    private ?ModelIndex $modelIndex;
    private ?ViewIndex $viewIndex;

    //! constructor
    public function __construct(ModelIndex $modelIndex, ViewIndex $viewIndex){
        $this->modelIndex = $modelIndex;
        $this->viewIndex = $viewIndex;
    }

    //! getter et setter
    public function getModelIndex(): ?ModelIndex { return $this->modelIndex; }
    public function setModelIndex(?ModelIndex $modelIndex): self { $this->modelIndex = $modelIndex; return $this; }

    public function getViewIndex(): ?ViewIndex { return $this->viewIndex; }
    public function setViewIndex(?ViewIndex $viewIndex): self { $this->viewIndex = $viewIndex; return $this; }

    //! method

        //! Inscription
    public function signUp():?string{
        
        //* vérifier qu'on reçoit le formulaire
        if(!isset($_POST["submit"])){
           
            return "";
        }

        //* vérifier que les champs ne sont pas vides
        if(empty($_POST["nickname"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["password2"])){

            return "<p><span style='color: red'>*Un ou plusieurs champs sont vides</span></p>";
        }

        //* vérifier le format de l'email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){

            return "<p><span style='color: red'>*Mauvais format d'email</span></p>";
        }


        //* vérifier que les mots de passe correspondent
        if($_POST["password"]!=$_POST["password2"]){

            return "<p><span style='color: red'>*Les mots de passe ne correspondent pas</span></p>";
        }

        //* nettoyage des données
        $nickname=sanitize($_POST["nickname"]);
        $email=sanitize($_POST["email"]);
        $password=sanitize($_POST["password"]);
        $password2=sanitize($_POST["password2"]);
        
        //* chiffrage du mot de passe
        $password=password_hash($password,PASSWORD_BCRYPT);

        //* donner les informations au model
        $this->getModelIndex()->setEmail($email);
        $this->getModelIndex()->setNickname($nickname);
        $this->getModelIndex()->setPassword($password);
        
        //* vérifier si l'email et le pseudo sont disponible
        $dataEmail=$this->getModelIndex()->getByEmail();
        if(!empty($dataEmail)){

            return "<p><span style='color: red'>*Email déjà utilisé</span></p>";
        }

        $dataNickname=$this->getModelIndex()->getByNickname();
        if(!empty($dataNickname)){

        return "<p><span style='color: red'>*Pseudo déjà utilisé</span></p>";
        }
        

        //* demander au model d'utiliser sa fonction add
        return $this->getModelIndex()->addUser();
    }
    
        //! Connexion
    public function signIn():?string{
        if(isset($_POST["submitConnexion"])){
            
            //* verifier ques champs ne sont pas vides
            if(empty($_POST["emailConnexion"]) || empty($_POST["passwordConnexion"])){
                
                return "<p><span style='color: red'>*Un ou plusieurs champs sont vides</span></p>";
                
            }
            
            //* vérifier le format de l'email 
            if(!filter_var($_POST["emailConnexion"], FILTER_VALIDATE_EMAIL)){
                
                return "<p><span style='color: red'>*Mauvais format d'email</span></p>";
            }
            
            //* nettoyage des données
            $email=sanitize($_POST["emailConnexion"]);
            $password=sanitize($_POST["passwordConnexion"]);
            
            //* donner les informations au model
            $this->getModelIndex()->setEmail($email);
            $this->getModelIndex()->setPassword($password);
            
            $data=$this->getModelIndex()->getByEmail();
            if(empty($data)){
                
                return "<p><span style='color: red'>*L'e-mail et/ou le mot de passe ne correspondent pas</span></p>";
            }
            
            //* vérifier le mot de passe
            if(!password_verify($password,$data[0]["password_user"])){
                
                return "<p><span style='color: red'>*L'e-mail et/ou le mot de passe ne correspondent pas</span></p>";
            }
            
            //*enregistrer le login dans $_SESSION
            $_SESSION["id_user"] = $data[0]["id_user"];
            $_SESSION["nickname"] = $data[0]["nickname"];
            $_SESSION["email"] = $data[0]["email"];

            //* redirection vers la page Mon compte
            header("Location:/repository/epic_jdr/account");
        }
        return "";
    }

        //! rendu
    public function render():void{

        //* charger les messages de la fonction signUpCharacter
        $message=$this->signUp();
        $messageConnexion=$this->signIn();

        echo $this->getViewIndex()->setMessage($message)->setMessageConnexion($messageConnexion)->displayView();
    }
}
    
// $index=new ControllerIndex(new ModelIndex, new ViewIndex);

// $index->render();

// include "../view/view_footer.php";
