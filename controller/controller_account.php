<?php
session_start();
include "../model/model_account.php";
include "../utils/utils.php";
include "../controller/controller_header.php";
include "../view/view_account.php";

class ControllerAccount{
    private ?ViewAccount $viewAccount;
    private ?ModelAccount $modelAccount;

    public function __construct(ViewAccount $viewAccount, ModelAccount $modelAccount){
        $this->viewAccount=$viewAccount;
        $this->modelAccount=$modelAccount;
    }

    public function getViewAccount(): ?ViewAccount { return $this->viewAccount; }
    public function setViewAccount(?ViewAccount $viewAccount): self { $this->viewAccount = $viewAccount; return $this; }

    public function getModelAccount(): ?ModelAccount { return $this->modelAccount; }
    public function setModelAccount(?ModelAccount $modelAccount): self { $this->modelAccount = $modelAccount; return $this; }

    public function displayUser():string{
        $user='';
        
        foreach($this->modelAccount->getUser() as $row){
            
            $user=$user.'
            <p>Pseudo : <strong>'.$row["nickname"].'</strong></p>
            <p>Email : <strong>'.$row["email"].'</strong></p>
            ';
        }
    
        return $user;
    }

    public function render(){

        $user=$this->displayUser();

        echo $this->getViewAccount()
        ->setUser($user)
        ->displayView();
    }
}
$account=new ControllerAccount(new ViewAccount, new ModelAccount());

$account->render();
     
include "../view/view_footer.php";