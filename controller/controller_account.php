<?php
class ControllerAccount{
    private ?ViewAccount $viewAccount;
    private ?ModelAccount $modelAccount;
    private ?ModelIndex $modelIndex;
    
    public function __construct(ViewAccount $viewAccount, ModelAccount $modelAccount, ModelIndex $modelIndex){
        $this->viewAccount=$viewAccount;
        $this->modelAccount=$modelAccount;
        $this->modelIndex=$modelIndex;
    }
    
    public function getViewAccount(): ?ViewAccount { return $this->viewAccount; }
    public function setViewAccount(?ViewAccount $viewAccount): self { $this->viewAccount = $viewAccount; return $this; }
    
    public function getModelAccount(): ?ModelAccount { return $this->modelAccount; }
    public function setModelAccount(?ModelAccount $modelAccount): self { $this->modelAccount = $modelAccount; return $this; }
    
        public function getModelIndex(): ?ModelIndex { return $this->modelIndex; }
        public function setModelIndex(?ModelIndex $modelIndex): self { $this->modelIndex = $modelIndex; return $this; }

    public function displayUser():string{
        $user='';
        
        foreach($this->modelAccount->getUser() as $row){
            
            $user=$user.'

            <div class="welcome">
                <h2>Mes Informations</h2>
                <p>Pseudo : <strong>'.$row["nickname"].'</strong></p>
                <p>Email : <strong>'.$row["email"].'</strong></p>
            </div>
            ';
        }
    
        return $user;
    }

    public function changeNickname():string{

        if(!isset($_POST["submitNickname"])){

            return "";
        }
        if(empty($_POST["nickname"])){

            return "<p><span style='color:red'>*Le champ est vide</span></p>";
        }

        $nickname=sanitize($_POST["nickname"]);

        $this->getModelAccount()->setNickname($nickname);
        $this->getModelIndex()->setNickname($nickname);

        $data=$this->getModelIndex()->getByNickname();
        if(!empty($data)){

            return "<p><span style='color:red'>*Pseudo déjà utilisé</span></p>";
        }

        return $this->getModelAccount()->changeNickname();
    }
    public function changeEmail():string{

        if(!isset($_POST["submitEmail"])){
            return "";
        }
        if(empty($_POST["email"])){
            
            return "<p><span style='color:red'>*Le champ est vide</span></p>";
        }
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            
            return "<p><span style='color:red'>*Mauvais format d'email</span></p>";
        }
        
        $email=sanitize($_POST["email"]);
        
        $this->getModelAccount()->setEmail($email);
        $this->getModelIndex()->setEmail($email);
        
        $data=$this->getModelIndex()->getByEmail();
        if(!empty($data)){

            return "<p><span style='color:red'>*Email déjà utilisé</span></p>";
        }

        return $this->getModelAccount()->changeEmail();
    }

    public function changePassword():string{

        if(!isset($_POST["submitPassword"])){

            return "";
        }
        if(empty($_POST["oldPassword"]) || empty($_POST["newPassword"]) || empty($_POST["newPassword2"])){

            return "<p><span style='color:red'>*Un ou plusieurs champs sont vide</span></p>";
        }

        $oldPassword=sanitize($_POST["oldPassword"]);
        $newPassword=sanitize($_POST["newPassword"]);
        $newPassword2=sanitize($_POST["newPassword2"]);

        $this->getModelIndex()->setPassword($oldPassword);
        $this->getModelIndex()->setEmail($_SESSION["email"]);
        
        $data=$this->getModelIndex()->getByEmail();

        if(!password_verify($oldPassword,$data[0]["password_user"])){

            return "<p><span style='color:red'>*Le mot de passe actuel ne correspond pas</span></p>";
        }

        if($_POST["newPassword"]!=$_POST["newPassword2"]){

            return "<p><span style='color: red'>*Les nouveaux mots de passe ne correspondent pas</span></p>";
        }

        $newPassword=password_hash($newPassword, PASSWORD_BCRYPT);

        $this->getModelAccount()->setPassword($newPassword);

        return $this->getModelAccount()->changePassword();
    }

    public function deleteAccount():string{

        if(!isset($_POST["submitDeleteAccount"])){

            return "";            
        }

        if(empty($_POST["password"])){

            return "<p><span style='color: red'>*Entrez le mot de passe</span></p>";
        }

        $password=sanitize($_POST["password"]);
        
        $this->getModelIndex()
        ->setPassword($password);

        $this->getModelIndex()->setEmail($_SESSION["email"]);
        $data=$this->getModelIndex()->getByEmail();

        if(!password_verify($password, $data[0]["password_user"])){

            return "<p><span style='color: red'>*Le mot de passe ne correspond pas</span></p>";
        }

        return $this->getModelAccount()->deleteAccount();
    }

    public function render(){

        $nickname=$this->changeNickname();
        $email=$this->changeEmail();
        $password=$this->changePassword();
        $delete=$this->deleteAccount();
        $user=$this->displayUser();

        echo $this->getViewAccount()
        ->setNickname($nickname)
        ->setEMail($email)
        ->setPassword($password)
        ->setDelete($delete)
        ->setUser($user)
        ->displayView();
    }
}