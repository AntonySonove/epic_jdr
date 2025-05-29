<?php
// session_start();
// include "../utils/utils.php";
// include "../model/model_character_sheet.php";
// include "../controller/controller_header.php";
// include "../view/view_character_sheet.php";

class ControllerCharacterSheet{
    //! attributs
    private ?ModelCharacterSheet $modelCharacterSheet;
    private ?ViewCharacterSheet $viewCharacterSheet;

    //! constructor
    public function __construct(ModelCharacterSheet $modelCharacterSheet, ViewCharacterSheet $viewCharacterSheet){
        $this->modelCharacterSheet = $modelCharacterSheet;
        $this->viewCharacterSheet = $viewCharacterSheet;
    }

    //! getter et setter
    public function getModelCharacterSheet(): ?ModelCharacterSheet { return $this->modelCharacterSheet; }
    public function setModelCharacterSheet(?ModelCharacterSheet $modelCharacterSheet): self { $this->modelCharacterSheet = $modelCharacterSheet; return $this; }

    public function getViewCharacterSheet(): ?ViewCharacterSheet { return $this->viewCharacterSheet; }
    public function setViewCharacterSheet(?ViewCharacterSheet $viewCharacterSheet): self { $this->viewCharacterSheet = $viewCharacterSheet; return $this; }

    //! method
    public function displayCharacter(): string{

        $character="";

        $data=$this->modelCharacterSheet->getOneCharacter();
        
        $_SESSION["id_character"]=$_GET["id_character"];
        $_SESSION["name_character"]=$_GET["name_character"];

        foreach($data as $row){

            $character=$character.'

            <form action="" method="post" class="welcome characterSheet">

                <h2 class="characterName">'.$row["name_character"].'</h2>

                <div class="stat">
                    <div class="statName">
                        <label for="modifyLp">Points de vie : </label>
                        <label for="modifyMp">Points de magie : </label>
                        <label for="modifyAtk">Attaque : </label>
                        <label for="modifyDef">Défense : </label>
                        <label for="modifyAtkm">Attaque magique : </label>
                        <label for="modifyDefm">Défense magique : </label>
                        <label for="modifySpeed">Vitesse : </label>  
                    </div>

                    <div class="currentStat">
                        <div>'.$row["lp"].'</div>
                        <div>'.$row["mp"].'</div>
                        <div>'.$row["atk"].'</div>
                        <div>'.$row["def"].'</div>
                        <div>'.$row["atkm"].'</div>
                        <div>'.$row["defm"].'</div>
                        <div>'.$row["speed"].'</div>
                    </div>

                    <div class=newStat>
                        <input class="inputFocus" type="number" name="lp" id="modifyLp">
                        <input class="inputFocus" type="number" name="mp" id="modifyMp">
                        <input class="inputFocus" type="number" name="atk" id="modifyAtk">
                        <input class="inputFocus" type="number" name="def" id="modifyDef">
                        <input class="inputFocus" type="number" name="atkm" id="modifyAtkm">
                        <input class="inputFocus" type="number" name="defm" id="modifyDefm">
                        <input class="inputFocus" type="number" name="speed" id="modifySpeed">  
                    </div>
                </div>

                <div class="options">

                    <input type="submit" name="submit" value="Modifier">

                    <a href="/repository/epic_jdr/play?name_character='.$row["name_character"].'&id_user='.$_SESSION["id_user"].'&id_character='.$row["id_character"].'">Jouer</a>
                    
                    <input style="color: red" type="submit" name="delete" value="Supprimer">
                </div>
            </form>

            <div class="return">
                <a href="/repository/epic_jdr/list?name_character='.$row["name_character"].'&id_user='.$_SESSION["id_user"].'&id_character='.$row["id_character"].'"">Retour</a>
            </div>

            ';
        }
        
        return $character;
    }

    public function modifyCharacter():string{

        if(!isset($_POST["submit"])){
            return "";
        }
        
        if(($_POST["lp"])==="" && ($_POST["mp"])==="" && ($_POST["atk"])==="" && ($_POST["def"])==="" && ($_POST["atkm"])==="" && ($_POST["defm"])==="" && ($_POST["speed"])===""){ 
            //? on utilise pas empty car on veux pouvoir accepter 0 en bdd. empty considère 0 comme une chaîne de caractère vide
            
            return "<span style='color: red'>*Veuillez remplir au moins un champ</span>";
        }
        
        //! dans le cas ou une seule stat va être modifiée
        $character=$this->getModelCharacterSheet(); //? récupérer l'objet 

        $data=$character->getOneCharacter(); //? récupérere un tableau
            
        $data = $data[0]; //? car fetchAll() retourne un tableau de tableaux
        
        //* set les valeurs du tableau pour qu'il y ai des valeurs
        $character->setLp($data["lp"]);
        $character->setMp($data["mp"]);
        $character->setAtk($data["atk"]);
        $character->setDef($data["def"]);
        $character->setAtkm($data["atkm"]);
        $character->setDefm($data["defm"]);
        $character->setSpeed($data["speed"]);


        $lp=($_POST["lp"])==="" ? $character->getLp() : (int)sanitize($_POST["lp"]);
        $mp=($_POST["mp"])==="" ? $character->getMp() : (int)sanitize($_POST["mp"]);
        $atk=($_POST["atk"])==="" ? $character->getAtk() : (int)sanitize($_POST["atk"]);
        $def=($_POST["def"])==="" ? $character->getDef() : (int)sanitize($_POST["def"]);
        $atkm=($_POST["atkm"])==="" ? $character->getAtkm() : (int)sanitize($_POST["atkm"]);
        $defm=($_POST["defm"])==="" ? $character->getDefm() : (int)sanitize($_POST["defm"]);
        $speed=($_POST["speed"])==="" ? $character->getSpeed() : (int)sanitize($_POST["speed"]);

        $this->getModelCharacterSheet()
        ->setLp($lp)
        ->setMp($mp)
        ->setAtk($atk)
        ->setDef($def)
        ->setAtkm($atkm)
        ->setDefm($defm)
        ->setSpeed($speed);

        return $this->getModelCharacterSheet()->modify();
    }

    public function deleteCharacter():string{

        if (!isset($_POST["delete"])){

            return "";
        }

        $this->getModelCharacterSheet()
        ->setId($_GET["id_character"])
        ->setName($_GET["name_character"]);

        return $this->getModelCharacterSheet()->delete();        
    }
  
    public function render(){

        $modify=$this->modifyCharacter();
        $delete=$this->deleteCharacter();
        $character=$this->displayCharacter();
       

        echo $this->getViewCharacterSheet()
        ->setModify($modify)
        ->setDelete($delete)
        ->setCharacter($character)
        ->displayView();
    }  
}

// $CharacterSheet=new ControllerCharacterSheet(new ModelCharacterSheet(), new ViewCharacterSheet());

// $CharacterSheet->render();

// include "../view/view_footer.php";
?>






