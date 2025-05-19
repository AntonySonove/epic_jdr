<?php
class ViewCharacterList{

    //! attributs
    private ?string $characterList="";

    //! getter et setter
    public function getCharacterList(): ?string { return $this->characterList; }
    public function setCharacterList(?string $characterList): self { $this->characterList = $characterList; return $this; }

    //! method
    public function displayView(): array | string{

        return '
<main class="mainCharacterList">
    <h2>Mes personnages</h2>
    <div class= gridCharacterList>
        '.$this->getCharacterList().'
    </div>
</main>
        ';
    } 
}


?>

