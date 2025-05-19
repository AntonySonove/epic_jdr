<?php
// session_start();
//     include "../model/model_character_sheet.php";
//     include "../model/model_play.php";
//     include "../utils/utils.php";
//     include "../controller/controller_header.php";
//     include "../view/view_play.php";

class ControllerPlay{
    private ViewPlay $viewPlay;
    private ModelPlay $modelPlay;
    private ModelCharacterSheet $modelCharacterSheet;

    public function __construct(ViewPlay $viewPlay, ModelPlay $modelPlay, ModelCharacterSheet $modelCharacterSheet){

        $this->viewPlay=$viewPlay;
        $this->modelPlay=$modelPlay;
        $this->modelCharacterSheet=$modelCharacterSheet;
    }

    public function getViewPlay(): ViewPlay { return $this->viewPlay; }
    public function setViewPlay(ViewPlay $viewPlay): self { $this->viewPlay = $viewPlay; return $this; }

    public function getModelPlay(): ModelPlay { return $this->modelPlay; }
    public function setModelPlay(ModelPlay $modelPlay): self { $this->modelPlay = $modelPlay; return $this; }

    public function getModelCharacterSheet(): ModelCharacterSheet { return $this->modelCharacterSheet; }
    public function setModelCharacterSheet(ModelCharacterSheet $modelCharacterSheet): self { $this->modelCharacterSheet = $modelCharacterSheet; return $this; }

    public function displayCharacter(): string{

        if (isset($_GET['name_character'])) {
            $_SESSION['name_character'] = $_GET['name_character'];
        }
        
        if (isset($_GET['id_character'])) {
            $_SESSION['id_character'] = $_GET['id_character'];
        }

        $character="";

        $data=$this->modelCharacterSheet->getOneCharacter();
        
        foreach($data as $row){

            $character=$character.'

            <div class="welcome characterSheetPlay">

                <div id="burgerMenuPlay">
                    <div class="burgerMenu"></div>
                    <div class="burgerMenu"></div>
                    <div class="burgerMenu"></div>
                </div>

                <div id="dropdownPlay" class="hideDropdown">
                    <div>
                        <button id="resetLp">↻</button>
                        <p>Points de vie</p>
                    </div>
                    <div>
                        <button id="resetMp">↻</button>
                        <p>Points de magie</p>
                    </div>
                    <div>
                        <button id="resetAtk">↻</button>
                        <p>Attaque</p>
                    </div>
                    <div>
                        <button id="resetDef">↻</button>
                        <p>Défense</p>
                    </div>
                    <div>
                        <p><button id="resetAtkm">↻</button></p>
                        <p>Attaque magique</p> 
                    </div>
                    <div>
                        <button id="resetDefm">↻</button>
                        <p>Défense magique</p>
                    </div>
                    <div>
                        <button id="resetSpeed">↻</button>
                        <p>Vitesse</p>
                    </div>
                </div>

                <h2 class="characterName">'.$row["name_character"].'</h2>

                <div class="gauge">
                    <div class="lpGauge"><div id="greenLp"><div id="yellowLp"></div></div></div>
                    <div class="mpGauge"><div></div></div>
                </div>

                <div class="playStat">

                    <div class="reset">
                        <p>Points de vie</p>
                        <button id="resetLp2">↻</button>
                    </div>

                    <div class=modifyStat>
                        <div>
                            <p id="currentLp">'.$row["lp"].'</p>
                            <p>/'.$row["lp"].'</p>
                        </div>
                        <div>
                            <button id="upLp">+</button>
                            <input id="inputLp" class="inputFocus" type="number" name="lp">
                            <button id="downLp">-</button>
                        </div> 
                    </div>
                </div>

                <div class="playStat">

                    <div class="reset">
                        <p>Points de magie</p>
                        <button id="resetMp2">↻</button>
                    </div>

                    <div class=modifyStat>
                        <div>
                            <p id="currentMp">'.$row["mp"].'</p>
                            <p>/'.$row["mp"].'</p>
                        </div>
                        <div>
                            <button id="upMp">+</button>
                            <input id="inputMp" class="inputFocus" type="number" name="mp">
                            <button id="downMp">-</button>
                        </div>  
                    </div>
                </div> 

                <div class="playStat">

                    <div class="reset">
                        <p>Attaque</p> 
                        <button id="resetAtk2">↻</button>
                    </div>

                    <div class=modifyStat>
                        <div>
                            <p id="currentAtk">'.$row["atk"].'</p>
                            <p>/'.$row["atk"].'</p>
                        </div>
                        <div>
                            <button id="upAtk">+</button>
                            <input id="inputAtk" class="inputFocus" type="number" name="atk">
                            <button id="downAtk">-</button>
                        </div>  
                    </div>
                </div>  

                <div class="playStat">

                    <div class="reset">
                        <p>Défense</p>
                        <button id="resetDef2">↻</button>
                    </div>

                    <div class=modifyStat>
                        <div>
                            <p id="currentDef">'.$row["def"].'</p>
                            <p>/'.$row["def"].'</p>
                        </div>
                        <div>
                            <button id="upDef">+</button>
                            <input id="inputDef" class="inputFocus" type="number" name="def">
                            <button id="downDef">-</button>
                        </div>  
                    </div>
                </div> 

                <div class="playStat">

                    <div class="reset">
                        <p>Attaque magique</p> 
                        <button id="resetAtkm2">↻</button>
                    </div>

                    <div class=modifyStat>
                        <div>
                            <p id="currentAtkm">'.$row["atkm"].'</p>
                            <p>/'.$row["atkm"].'</p>
                        </div>
                        <div>
                            <button id="upAtkm">+</button>
                            <input id="inputAtkm" class="inputFocus" type="number" name="atkm">
                            <button id="downAtkm">-</button>
                        </div>  
                    </div>
                </div>

                <div class="playStat">

                    <div class="reset">
                        <p>Défense magique</p>
                        <button id="resetDefm2">↻</button>
                    </div>

                    <div class=modifyStat>
                        <div>
                            <p id="currentDefm">'.$row["defm"].'</p>
                            <p>/'.$row["defm"].'</p>
                        </div>
                        <div>
                            <button id="upDefm">+</button>
                            <input id="inputDefm" class="inputFocus" type="number" name="defm">
                            <button id="downDefm">-</button>
                        </div>  
                    </div>
                </div>  

                <div class="playStat">

                    <div class="reset">
                        <p>Vitesse</p>
                        <button id="resetSpeed2">↻</button>
                    </div>

                    <div class=modifyStat>
                        <div>
                            <p id="currentSpeed">'.$row["speed"].'</p>
                            <p>/'.$row["speed"].'</p>
                        </div>
                        <div>
                            <button id="upSpeed">+</button>
                            <input id="inputSpeed" class="inputFocus" type="number" name="speed">
                            <button id="downSpeed">-</button>
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

// $play=new ControllerPlay(new ViewPlay, new ModelPlay(), new ModelCharacterSheet());

// $play->render();

// include "../view/view_footer.php";