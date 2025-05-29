<?php
class ViewCreateCharacter{
    private ?string $message="";

    public function getMessage(): ?string{
        return $this->message;
    }
    public function setMessage(?string $message): ViewCreateCharacter{
        $this->message = $message;
        return $this;
    }
    

    public function displayView(){
        
        return '     
<main class="mainCreateCharacter">
    <h2>Créer un nouveau personnage</h2>

    '.$this->getMessage().'

    <form class="welcome" action="" method="post">
        <div class="formCreateCharacter">
            <div class="statName">
                <label for="inputName">Nom</label>
                <label for="createLp">Points de vie</label>
                <label for="createMp" >Points de magie</label>
                <label for="createAtk">Attaque</label>
                <label for="createDef" >Défense</label>
                <label for="createAtkm" >Attaque magique</label>
                <label for="createDefM" >Défense magique</label>
                <label for="createSpeed" >Vitesse</label>
            </div>
            
            <div class="statInput">
                <input class="inputFocus" id="inputName" type="text" name="name" placeholder="Nom">
                <input class="inputFocus" type="number" name="lp" id="createLp" placeholder="0">
                <input class="inputFocus" type="number" name="mp" id="createMp" placeholder="0">
                <input class="inputFocus" type="number" name="atk" id="createAtk" placeholder="0">
                <input class="inputFocus" type="number" name="def" id="createDef" placeholder="0">
                <input class="inputFocus" type="number" name="atkm" id="createAtkm" placeholder="0">
                <input class="inputFocus" type="number" name="defm" id="createDefm" placeholder="0">
                <input class="inputFocus" type="number" name="speed" id="createSpeed" placeholder="0">
            </div>
        </div>

        <div class="submitCreateCharacter">
            <input type="submit" name="submit" value="Créer un nouveau personnage">
        </div>  
    </form>

    <div class="return">
        <a href="/repository/epic_jdr/account">Retour</a>
    </div>
</main>';
    }
}
