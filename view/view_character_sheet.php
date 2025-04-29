<?php
class ViewCharacterSheet {

    //! attributs
    private ?string $character;
    private ?string $modify;

    //! getter et setter
   
    public function getModify(): ?string { return $this->modify; }
    public function setModify(?string $modify): self { $this->modify = $modify; return $this; }

    //! method
    public function displayView():string{

        return'
<main class="mainCharacterSheet">
    '.$this->getCharacter().'      
    '.$this->getModify().'
       
</main>
        ';
    }


    public function getCharacter(): ?string { return $this->character; }
    public function setCharacter(?string $character): self { $this->character = $character; return $this; }
}
?>


