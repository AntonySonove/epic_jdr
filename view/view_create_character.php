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
                <p>Nom</p>
                <p>Points de vie</p>
                <p >Points de magie</p>
                <p>Attaque</p>
                <p >Défense</p>
                <p >Attaque magique</p>
                <p >Défense magique</p>
                <p >Vitesse</p>
            </div>
            
            <div class="statInput">
                <input class="inputFocus" id="inputName" type="text" name="name" placeholder="Nom">
                <input class="inputFocus" type="number" name="lp" placeholder="0">
                <input class="inputFocus" type="number" name="mp" placeholder="0">
                <input class="inputFocus" type="number" name="atk" placeholder="0">
                <input class="inputFocus" type="number" name="def" placeholder="0">
                <input class="inputFocus" type="number" name="atkm" placeholder="0">
                <input class="inputFocus" type="number" name="defm" placeholder="0">
                <input class="inputFocus" type="number" name="speed" placeholder="0">
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
