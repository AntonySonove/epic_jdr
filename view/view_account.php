<?php
class ViewAccount{
    private ?string $message;
    private ?string $user;

    public function getMessage(): ?string { return $this->message; }
    public function setMessage(?string $message): self { $this->message = $message; return $this; }

    public function getUser(): ?string { return $this->user; }
    public function setUser(?string $user): self { $this->user = $user; return $this; }

    public function displayView():string{
        return'

<main class="mainIndex">
    <h2>Mon compte</h2>
    '.$this->getUser().'

    <form action="" method="post" class="welcome">
    <h2>Modifier les information du compte</h2>
        <input type="text" name="nickname" placeholder="Nouveau pseudo">
        <input type="email" name="email" placeholder="Nouvel email">
        <input type="password" name="oldPassword" placeholder="Mot de passe actuel">
        <input type="password" name="newPassword" placeholder="Nouveau Mot de passe">
        <input type="password" name="newPassword2" placeholder="Confirmer le nouveau Mot de passe">
        <input type="submit" name="submitAccount" value="Valider">
    </form>

    <form action="" method="post" class="welcome">
        <input type="submit" name="submitDeleteAccount" value="Supprimer mon compte">
    </form>

</main>

        ';
    } 
}
?>
