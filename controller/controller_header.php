<?php
// include "../view/view_header.php";
class ControllerHeader{
    private ? ViewHeader $viewHeader;

    public function __construct(ViewHeader $viewHeader){
        $this->viewHeader=$viewHeader;
    }

    public function getViewHeader(){ return $this->viewHeader; }
    public function setViewHeader($viewHeader): self { $this->viewHeader = $viewHeader; return $this; }

    public function Header():string{

        $header='
        
<header>
    <div class="logo">
        <a href="/repository/epic_jdr/"><img class="logo" src="/repository/epic_jdr/src/ressources/logo_epic_jdr(1).png" width="150" height="150" alt="logo"></a>
    </div>
    <?= $header ?>
</header>
        
        ';
        
        if(isset($_SESSION["id_user"]) && !empty( $_SESSION["id_user"] )){
        
            $header= '
        
<header>
    <div class="logo">
        <a href="/repository/epic_jdr/account"><img class="logo" src="/repository/epic_jdr/src/ressources/logo_epic_jdr(1).png" width="150" height="150" alt="logo"></a>
    </div>
    
    <div id="burgerMenuButton">
        <div class="burgerMenu"></div>
        <div class="burgerMenu"></div>
        <div class="burgerMenu"></div>
    </div>
    
    <div id="dropdownHeader" class="hideDropdown">
        <div class="linkHeader">
            <a href="/repository/epic_jdr/create">Nouveau personnage</a>
        </div>
        <div class="linkHeader">
            <a href="/repository/epic_jdr/list">Mes personnages</a>
        </div>
        <div class="linkHeader">
            <a href="/repository/epic_jdr/account">Mon compte</a>
        </div>
        <div class="linkHeader">
            <a href="/repository/epic_jdr/controller/controller_disconnect.php">Déconnexion</a>
        </div>
    </div>
        
    <div id="nav">
        <div class="linkHeader">
            <a href="/repository/epic_jdr/create">Nouveau personnage</a>
        </div>
        <div class="linkHeader">
            <a href="/repository/epic_jdr/list">Mes personnages</a>
        </div>
        <div class="linkHeader">
            <a href="/repository/epic_jdr/account">Mon compte</a>
        </div>
        <div class="linkHeader">
            <a href="/repository/epic_jdr/controller/controller_disconnect.php">Déconnexion</a>
        </div>
    </div>
</header>            
                ';
            }
        return $header;
    }

    public function render(){
        
        $header=$this->Header();

        echo $this->getViewHeader()
        ->setHeader($header)
        ->displayView();
    }
}
    
// $header= new ControllerHeader(new ViewHeader);

// $header->render();


