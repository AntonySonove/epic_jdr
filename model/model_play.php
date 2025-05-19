<?php
class ModelPlay{
    private ?PDO $bdd;

    public function __construct(){
        $this->bdd=dbConnect();
    }

    public function getBdd(): ?PDO { return $this->bdd; }
    public function setBdd(?PDO $bdd): self { $this->bdd = $bdd; return $this; }

    public function getOneCharacter():array | string{

        try {
            
        $req=$this->getBdd()->prepare("SELECT id_character, name_character, lp, mp, atk, def, atkm, defm, speed, c.id_user 
        FROM characters as c
        INNER JOIN users AS u
        ON c.id_user = u.id_user
        WHERE name_character=? AND c.id_user=? AND id_character=? AND email=? AND nickname=?");

        $req->bindParam(1,$_SESSION["name_character"],PDO::PARAM_STR);
        $req->bindParam(2,$_SESSION["id_user"],PDO::PARAM_INT);
        $req->bindParam(3,$_SESSION["id_character"],PDO::PARAM_INT);
        $req->bindParam(4, $_SESSION["email"], PDO::PARAM_STR);
        $req->bindParam(5, $_SESSION["nickname"], PDO::PARAM_STR);

        $req->execute();

        $data=$req->fetchAll(PDO::FETCH_ASSOC);

        return $data;

        } catch (PDOException $error) {
            return $error->getMessage();
        }
    }
}