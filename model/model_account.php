<?php
class ModelAccount{
    private ?PDO $bdd;
    private ?string $nickname;
    private ?string $email;
    private ?string $password;

    public function __construct() {
        $this->bdd = dbConnect();
    }

    public function getBdd(): ?PDO { return $this->bdd; }
    public function setBdd(?PDO $bdd): self { $this->bdd = $bdd; return $this; }

    public function getNickname(): ?string { return $this->nickname; }
    public function setNickname(?string $nickname): self { $this->nickname = $nickname; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?string $password): self { $this->password = $password; return $this; }

    public function getUser():array | string{
        try{

            $req=$this->getBdd()->prepare("SELECT id_user, nickname, password_user, email
            FROM users
            WHERE id_user=? AND email=? AND nickname=?");

            $req->bindParam(1, $_SESSION["id_user"], PDO::PARAM_INT);
            $req->bindParam(2, $_SESSION["email"], PDO::PARAM_INT);
            $req->bindParam(3, $_SESSION["nickname"], PDO::PARAM_STR);

            $req->execute();

            $data=$req->fetchAll(PDO::FETCH_ASSOC);

            return $data;

        }catch(PDOException $error){
            return $error->getMessage();
        }
    }

    public function changeNickname():string{
        try{

            $nickname=$this->getNickname();

            $req=$this->getBdd()->prepare("UPDATE users
            SET nickname=?
            WHERE id_user=? AND email=? AND nickname=?");

            $req->bindParam(1,$nickname, PDO::PARAM_STR);
            $req->bindParam(2, $_SESSION["id_user"], PDO::PARAM_INT);
            $req->bindParam(3, $_SESSION["email"], PDO::PARAM_STR);
            $req->bindParam(4, $_SESSION["nickname"], PDO::PARAM_STR);

            $req->execute();

            $_SESSION["nickname"]=$nickname;

            return "<p><span style='color:green'>*Modification(s) enregistrée(s)</span></p>";

        }catch(PDOException $error){
            return $error->getMessage();
        }
    }
    
    public function changeEmail():string{

        try{

            $email=$this->getEmail();

            $req=$this->getBdd()->prepare("UPDATE users
            SET email=?
            WHERE id_user=? AND email=? AND nickname=?");

            $req->bindParam(1, $email, PDO::PARAM_STR);
            $req->bindParam(2, $_SESSION["id_user"], PDO::PARAM_INT);
            $req->bindParam(3, $_SESSION["email"], PDO::PARAM_STR);
            $req->bindParam(4, $_SESSION["nickname"], PDO::PARAM_STR);

            $req->execute();

            $_SESSION["email"]=$email;

            return "<p><span style='color:green'>*Modification(s) enregistrée(s)</span></p>";

        }catch(PDOException $error){
            return $error->getMessage();
        }
    }

    public function changePassword():string{
        try{

            $password=$this->getPassword();

            $req=$this->getBdd()->prepare("UPDATE users
            SET password_user=?
            WHERE id_user=? AND email=? AND nickname=?");

            $req->bindParam(1, $password, PDO::PARAM_STR);
            $req->bindParam(2, $_SESSION["id_user"], PDO::PARAM_INT);
            $req->bindParam(3, $_SESSION["email"], PDO::PARAM_STR);
            $req->bindParam(4, $_SESSION["nickname"], PDO::PARAM_STR);

            $req->execute();

            return "<p><span style='color:green'>*Modification(s) enregistrée(s)</span></p>";

        }catch(PDOException $error){
            return $error->getMessage();
        }
    }

    public function deleteAccount():string{
        try{

            $req=$this->getBdd()->prepare("DELETE FROM characters
            WHERE id_user=?");

            $req->bindParam(1, $_SESSION["id_user"], PDO::PARAM_INT);

            $req->execute();

            $req=$this->getBdd()->prepare("DELETE FROM users
            WHERE id_user=? AND email=? AND nickname=?");

            $req->bindParam(1, $_SESSION["id_user"], PDO::PARAM_INT);
            $req->bindParam(2, $_SESSION["email"], PDO::PARAM_STR);
            $req->bindParam(3, $_SESSION["nickname"], PDO::PARAM_STR);

            $req->execute();
            header("location:/repository/epic_jdr/controller/controller_disconnect.php");

            return "<p><span style='color:green'>*Compte supprimé</span></p>";

        }catch(PDOException $error){
            return $error->getMessage();
        }
    }
}