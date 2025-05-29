<?php
// $host = 'nom_du_serveur';
// $dbname = 'nom_de_la_base';
// $user = 'nom_utilisateur';
// $pass = 'mot_de_passe';

// $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);


// #Activation du rewrite des URL
// RewriteEngine On

// #base du projet (emplacement à partir de la racine du serveur)
// RewriteBase /repository/epic_jdr/

// #si ce n'est pas un répertoire
// RewriteCond %{REQUEST_FILENAME} !-d

// # Si ce n'est pas un fichier
// RewriteCond %{REQUEST_FILENAME} !-f

// RewriteRule ^(.+)$ index.php [QSA,L]
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//! Include des fichiers commun à chaque routes
include "./utils/utils.php";

//! Récupérer l'url entrée par l'utilisateur
$url=parse_url($_SERVER["REQUEST_URI"]);

//! Analyser l'intérieur de l'url pour récupérer le path (partie de l'url se trouvant après le nom de domaine)
isset($url["path"]) ? $path=$url["path"] : $path="/";

//! Comparer le path obtenu avec les routes mise en place

//* page d'acceuil


switch($path){
    case "/repository/epic_jdr/":
        include "./controller/controller_header.php";
        include "./view/view_header.php";

        $header=new ControllerHeader(new ViewHeader);
        $header->render();

        include "./model/model_index.php";
        include "./controller/controller_index.php";
        include "./view/view_index.php";
        
        $index=new ControllerIndex(new ModelIndex, new ViewIndex());
        $index->render();
        include "./view/view_footer.php";

        break;
    
    //* Page mon compte
    case "/repository/epic_jdr/account":
        session_start();
        include "./controller/controller_header.php";
        include "./view/view_header.php";
        
        $header=new ControllerHeader(new ViewHeader);
        $header->render();
        
        include "./model/model_account.php";
        include "./model/model_index.php";
        include "./controller/controller_account.php";
        include "./view/view_account.php";
        
        $account=new ControllerAccount(new ViewAccount, new ModelAccount(),new ModelIndex());
        $account->render();
        include "./view/view_footer.php";

        break;

    //* Page de création de personnage
    case "/repository/epic_jdr/create":
        session_start();
        include "./controller/controller_header.php";
        include "./view/view_header.php";
        
        $header=new ControllerHeader(new ViewHeader);
        $header->render();
        
        include "./model/model_create_character.php";
        include "./controller/controller_create_character.php";
        include "./view/view_create_character.php";
        
        $CreateCharacter=new ControllerCreateCharacter(new ModelCreateCharacter(), new ViewCreateCharacter());
        $CreateCharacter->render();
        include "./view/view_footer.php";

        break;
    
    //*Page de liste des personnages
   case "/repository/epic_jdr/list":
        session_start();
        include "./controller/controller_header.php";
        include "./view/view_header.php";
        
        $header=new ControllerHeader(new ViewHeader);
        $header->render();
        
        include "./model/model_character_list.php";
        include "./controller/controller_character_list.php";
        include "./view/view_character_list.php";
        
        $characterList=new ControllerCharacterList(new ModelCharacterList,new ViewCharacterList);
        $characterList->render();
        include "./view/view_footer.php";

        break;

    //* Page de fiche personnage
    case "/repository/epic_jdr/sheet":
        session_start();
        include "./controller/controller_header.php";
        include "./view/view_header.php";
        
        $header=new ControllerHeader(new ViewHeader);
        $header->render();
        
        include "./model/model_character_sheet.php";
        include "./controller/controller_character_sheet.php";
        include './view/view_character_sheet.php';
        
        $CharacterSheet=new ControllerCharacterSheet(new ModelCharacterSheet(), new ViewCharacterSheet());
        $CharacterSheet->render();
        include "./view/view_footer.php";

        break;

    //* Page de jeu
    case "/repository/epic_jdr/play":
        session_start();
        include "./controller/controller_header.php";
        include "./view/view_header.php";
        
        $header=new ControllerHeader(new ViewHeader);
        $header->render();
        
        include "./model/model_play.php";
        include "./controller/controller_play.php";
        include './view/view_play.php';
        
        $play=new ControllerPlay(new ViewPlay, new ModelPlay());
        $play->render();
        include "./view/view_footer.php";

        break;
}