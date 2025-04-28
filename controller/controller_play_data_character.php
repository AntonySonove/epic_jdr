<?php
session_start();
include "../utils/utils.php";
include "../model/model_play.php";

class ControllerPlayDataCharacter{

    private ?ModelPlay $modelPlay;

    public function __construct(ModelPlay $modelPlay){
        $this->modelPlay=$modelPlay;
    }

    public function getModelPlay(): ?ModelPlay { return $this->modelPlay; }
    public function setModelPlay(?ModelPlay $modelPlay): self { $this->modelPlay = $modelPlay; return $this; }

    public function fetchStat(){
        $data=$this->modelPlay->getOneCharacter();

        header('Content-Type: application/json');

        echo json_encode($data);
    }
}
$dataCharacter=new ControllerPlayDataCharacter(new ModelPlay());

$dataCharacter->fetchStat();