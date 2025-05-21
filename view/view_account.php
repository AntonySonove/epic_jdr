<?php
class ViewAccount{
    private ?string $message;
    private ?string $user;
    private ?string $nickname;
    private ?string $email;
    private ?string $password;
    private ?string $delete;

    public function getMessage(): ?string { return $this->message; }
    public function setMessage(?string $message): self { $this->message = $message; return $this; }

    public function getUser(): ?string { return $this->user; }
    public function setUser(?string $user): self { $this->user = $user; return $this; }
    
    public function getNickname(): ?string { return $this->nickname; }
    public function setNickname(?string $nickname): self { $this->nickname = $nickname; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?string $password): self { $this->password = $password; return $this; }

    public function getDelete(): ?string { return $this->delete; }
    public function setDelete(?string $delete): self { $this->delete = $delete; return $this; }

    public function displayView():string{
        return'

<main class="mainAccount">

    <h2>Mon compte</h2>
    
    '.$this->getNickname().'
    '.$this->getEmail().'
    '.$this->getPassword().'
    '.$this->getDelete().'

        '.$this->getUser().'
        
        <div class="welcome">
            <h2>Modifier les information du compte</h2>

            <form class="formAccount" action="" method="post" >

                <input class="inputFocus" type="text" name="nickname" placeholder="Nouveau pseudo">

                <input class="submitIndex" type="submit" name="submitNickname" Value="Changer le pseudo">
            </form>

            <form class="formAccount" action="" method="post" >

                <input class="inputFocus" type="email" name="email" placeholder="Nouvel email">

                <input class="submitIndex" type="submit" name="submitEmail" Value="Changer l\'email">
            </form>

            <form id="formPassword" class="formAccount" action="" method="post">
                
                <input class="inputFocus" type="password" name="oldPassword" placeholder="Mot de passe actuel">

                <input id="changePassword" class="inputFocus" type="password" name="newPassword" placeholder="Nouveau Mot de passe">
                <input class="inputFocus" type="password" name="newPassword2" placeholder="Confirmer le nouveau Mot de passe">


                <input class="submitIndex" type="submit" name="submitPassword" value="Changer le mot de passe">
                
            </form>

        </div>
            
        <div id="changePasswordError" style="color:red"></div>

    <div class="welcome">
        <h2>Supprimer mon compte</h2>

        <form action="" method="post" class="formAccount">

            <input class="inputFocus" type="password" name="password" placeholder="Mot de passe">

            <input class="submitIndex" style="color: red" type="submit" name="submitDeleteAccount" value="Supprimer mon compte">
        </form>
    </div>

</main>
<script src="/repository/epic_jdr/src/script/account.js"></script>
        ';
    } 
}
?>
