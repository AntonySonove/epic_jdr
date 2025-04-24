<?php
class ModelAccount{
    private ?PDO $bdd;

    public function __construct() {
        $this->bdd = dbConnect();
    }

    public function getBdd(): ?PDO { return $this->bdd; }
    public function setBdd(?PDO $bdd): self { $this->bdd = $bdd; return $this; }

    public function getUser():array | string{
        try{

            $req=$this->getBdd()->prepare("SELECT id_user, nickname, password_user, email
            FROM users
            WHERE id_user=? AND email=?");

            $req->bindParam(1, $_SESSION["id_user"], PDO::PARAM_INT);
            $req->bindParam(2, $_SESSION["email"], PDO::PARAM_INT);

            $req->execute();

            $data=$req->fetchAll(PDO::FETCH_ASSOC);

            return $data;

        }catch(PDOException $error){
            return $error->getMessage();
        }
    }
}