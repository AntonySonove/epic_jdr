<?php
session_start();
include "../utils/utils.php";
include "../model/model_character_sheet.php";
include "../controller/controller_header.php";
include "../view/view_character_sheet.php";

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

        $_SESSION["id_character"]= $data[0]["id_character"];
        $_SESSION["name_character"]= $data[0]["name_character"];
        
        var_dump($_SESSION);
        foreach($data as $row){

            $character=$character.'

            <form action="" method="post" class="welcome characterSheet">

                <h2 class="characterName">'.$row["name_character"].'</h2>

                <div class="stat">
                    <div class="statName">
                        <div>Points de vie : </div>
                        <div>Points de magie : </div>
                        <div>Attaque : </div>
                        <div>Défense : </div>
                        <div>Attaque magique : </div>
                        <div>Défense magique : </div>
                        <div>Vitesse : </div>  
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
                        <input class="inputFocus" type="number" name="lp" >
                        <input class="inputFocus" type="number" name="mp" >
                        <input class="inputFocus" type="number" name="atk" >
                        <input class="inputFocus" type="number" name="def" >
                        <input class="inputFocus" type="number" name="atkm" >
                        <input class="inputFocus" type="number" name="defm" >
                        <input class="inputFocus" type="number" name="speed" >  
                    </div>
                </div>

                <div class="modify">
                    <input type="submit" name="submit" value="Modifier">
                </div> 
            </form>

            <div class="return">
                <a href="../controller/controller_character_list.php?name_character='.$row["name_character"].'&id_user='.$_SESSION["id_user"].'&id_character='.$row["id_character"].'"">Retour</a>
            </div>
            ';
        }
        
        return $character;
    }

    public function modify():string{

        if(!isset($_POST["submit"])){
            return "";
        }
        
        if(empty($_POST["lp"]) && empty($_POST["mp"])){
            
            return "<span style='color: red'>*Veuillez remplir au moins un champ</span>";
        }
        
        //! dans le cas ou une seule stat va être modifiée
        $character=$this->getModelCharacterSheet(); //? récupérer l'objet 
        $data=$character->getOneCharacter(); //? récupérere un tableau
     
        if (is_array($data) && count($data) > 0) {

            $data = $data[0]; //? car fetchAll() retourne un tableau de tableaux

            //* set les valeurs du tableau pour qu'il y ai des valeurs
            $character->setLp($data["lp"]);
            $character->setMp($data["mp"]);

        }

        $lp=empty($_POST["lp"]) ? $character->getLp() : sanitize($_POST["lp"]);
        $mp=empty($_POST["mp"]) ? $character->getMp() : sanitize($_POST["mp"]);

        $this->getModelCharacterSheet()
        ->setLp($lp)
        ->setMp($mp);
        

        return $this->getModelCharacterSheet()->modify();
    }
  
    public function render(){

        $modify=$this->modify();
        $character=$this->displayCharacter();
       

        echo $this->getViewCharacterSheet()
        ->setModify($modify)
        ->setCharacter($character)
        ->displayView();
    }  
}

$CharacterSheet=new ControllerCharacterSheet(new ModelCharacterSheet(), new ViewCharacterSheet());

$CharacterSheet->render();

include "../view/view_footer.php";
?>






