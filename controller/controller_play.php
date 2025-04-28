<?php
session_start();
    include "../model/model_character_sheet.php";
    include "../model/model_play.php";
    include "../utils/utils.php";
    include "../controller/controller_header.php";
    include "../view/view_play.php";

class ControllerPlay{
    private ViewPlay $viewPlay;
    private ModelPlay $ModelPlay;
    private ModelCharacterSheet $modelCharacterSheet;

    public function __construct(ViewPlay $viewPlay, ModelPlay $modelPlay, ModelCharacterSheet $modelCharacterSheet){

        $this->viewPlay=$viewPlay;
        $this->modelPlay=$modelPlay;
        $this->modelCharacterSheet=$modelCharacterSheet;
    }

    public function getViewPlay(): ViewPlay { return $this->viewPlay; }
    public function setViewPlay(ViewPlay $viewPlay): self { $this->viewPlay = $viewPlay; return $this; }

    public function getModelPlay(): ModelPlay { return $this->ModelPlay; }
    public function setModelPlay(ModelPlay $ModelPlay): self { $this->ModelPlay = $ModelPlay; return $this; }

    public function getModelCharacterSheet(): ModelCharacterSheet { return $this->modelCharacterSheet; }
    public function setModelCharacterSheet(ModelCharacterSheet $modelCharacterSheet): self { $this->modelCharacterSheet = $modelCharacterSheet; return $this; }

    public function displayCharacter(): string{

        $character="";

        $data=$this->modelCharacterSheet->getOneCharacter();
        
        foreach($data as $row){

            $character=$character.'

            <div class="welcome characterSheet">
                <h2 class="characterName">'.$row["name_character"].'</h2>

                <div class="playStat">
                    <p>Points de vie</p> 
                    <div class=modifyStat>
                        <p class="currentStatJS">'.$row["lp"].'</p>
                        <div>
                            <button>+</button>
                            <input class="inputFocus" type="number" name="lp">
                            <button>-</button>
                        </div> 
                    </div>
                </div>

                <div class="playStat">
                    <p>Points de magie</p> 
                    <div class=modifyStat>
                        <p>'.$row["mp"].'</p>
                        <div>
                            <button>+</button>
                            <input class="inputFocus" type="number" name="lp">
                            <button>-</button>
                        </div>  
                    </div>
                </div> 

                <div class="playStat">
                    <p>Attaque</p> 
                    <div class=modifyStat>
                        <p>'.$row["atk"].'</p>
                        <div>
                            <button>+</button>
                            <input class="inputFocus" type="number" name="lp">
                            <button>-</button>
                        </div>  
                    </div>
                </div>  

                <div class="playStat">
                    <p>Défense</p> 
                    <div class=modifyStat>
                        <p>'.$row["def"].'</p>
                        <div>
                            <button>+</button>
                            <input class="inputFocus" type="number" name="lp">
                            <button>-</button>
                        </div>  
                    </div>
                </div> 

                <div class="playStat">
                    <p>Attaque magique</p> 
                    <div class=modifyStat>
                        <p>'.$row["atkm"].'</p>
                        <div>
                            <button>+</button>
                            <input class="inputFocus" type="number" name="lp">
                            <button>-</button>
                        </div>  
                    </div>
                </div>

                <div class="playStat">
                    <p>Défense magique</p> 
                    <div class=modifyStat>
                        <p>'.$row["defm"].'</p>
                        <div>
                            <button>+</button>
                            <input class="inputFocus" type="number" name="lp">
                            <button>-</button>
                        </div>  
                    </div>
                </div>  

                <div class="playStat">
                    <p>Vitesse</p> 
                    <div class=modifyStat>
                        <p>'.$row["speed"].'</p>
                        <div>
                            <button>+</button>
                            <input class="inputFocus" type="number" name="lp">
                            <button>-</button>
                        </div>  
                    </div>
                </div>  
            </div>  
            ';
        }
        return $character;
    }

    public function render(){

        $character=$this->displayCharacter();

        echo $this->getViewPlay()
        ->setCharacter($character)
        ->displayView();
    }
}

$play=new ControllerPlay(new ViewPlay, new ModelPlay(), new ModelCharacterSheet());

$play->render();

include "../view/view_footer.php";