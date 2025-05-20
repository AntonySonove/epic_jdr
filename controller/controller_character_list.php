a
<?php
    // session_start();
    // include "../utils/utils.php";
    // include "../model/model_character_list.php";
    // include "../controller/controller_header.php";
    // include "../view/view_character_list.php";

class ControllerCharacterList{

    //! attributs
    private ?ModelCharacterList $modelCharacterList;
    private ?ViewCharacterList $viewCharacterList;

    //! constructor
    public function __construct(ModelCharacterList $modelCharacterList,ViewCharacterList $viewCharacterList) {
        $this->modelCharacterList = $modelCharacterList;
        $this->viewCharacterList = $viewCharacterList;
    }

    //! getter et setter


    public function getModelCharacterList(): ?ModelCharacterList { return $this->modelCharacterList; }
    public function setModelCharacterList(?ModelCharacterList $modelCharacterList): self { $this->modelCharacterList = $modelCharacterList; return $this; }

    public function getViewCharacterList(): ?ViewCharacterList { return $this->viewCharacterList; }
    public function setViewCharacterList(?ViewCharacterList $viewCharacterList): self { $this->viewCharacterList = $viewCharacterList; return $this; }

    public function readCharacter():array | string{

        $characterList="";
        
        $data=$this->modelCharacterList->getAll();

        foreach($data as $row){

            $characterList=$characterList.'
            <article>
                <p>'.$row["name_character"].'</p>

                <div>
                    <a href="/repository/epic_jdr/sheet?name_character='.$row["name_character"].'&id_user='.$_SESSION["id_user"].'&id_character='.$row["id_character"].'">Fiche</a>

                    <a href="/repository/epic_jdr/play?name_character='.$row["name_character"].'&id_user='.$_SESSION["id_user"].'&id_character='.$row["id_character"].'">Jouer</a>
                </div>
            </article>
            ';
        }
        
        return $characterList;
    }
  


    public function render(){

        $characterList=$this->readCharacter();

        echo $this->getViewCharacterList()
        ->setCharacterList($characterList)
        ->displayView();
    }
}

// $characterList=new ControllerCharacterList(new ModelCharacterList,new ViewCharacterList);

// $characterList->render();
    

// include "../view/view_footer.php";
?> 