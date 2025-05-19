<?php
class ViewCharacterSheet {

    //! attributs
    private ?string $character;
    private ?string $modify;
    private ?string $delete;

    //! getter et setter

    public function getCharacter(): ?string { return $this->character; }
    public function setCharacter(?string $character): self { $this->character = $character; return $this; }
   
    public function getModify(): ?string { return $this->modify; }
    public function setModify(?string $modify): self { $this->modify = $modify; return $this; }

    public function getDelete(): ?string { return $this->delete; }
    public function setDelete(?string $delete): self { $this->delete = $delete; return $this; }

    //! method
    public function displayView():string{

        return'
<main class="mainCharacterSheet">
    '.$this->getDelete().'      
    '.$this->getModify().'      
    '.$this->getCharacter().'      
</main>
        ';
    }





}



