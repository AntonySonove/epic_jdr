<?php
// session_start();
class ModelCharacterList{
    //! attributs
    private ?PDO $bdd;

    //! constructor
    public function __construct() {
        $this->bdd = dbConnect();
    }

    //! getter et setter
    public function getBdd(): ?PDO { return $this->bdd; }
    public function setBdd(?PDO $bdd): self { $this->bdd = $bdd; return $this; }

    //! method
    public function getAll(): array | string{

        try {

            $req=$this->getBdd()->prepare("SELECT name_character,id_character,c.id_user 
            FROM characters AS c INNER JOIN users AS u ON c.id_user= u.id_user
            WHERE c.id_user=? AND email=? AND nickname=?");
    
            $req->bindParam(1,$_SESSION['id_user'],PDO::PARAM_INT);
            $req->bindParam(2, $_SESSION["email"], PDO::PARAM_STR);
            $req->bindParam(3, $_SESSION["nickname"], PDO::PARAM_STR);
    
            $req->execute();
    
            $data= $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $data;
            
        }catch(PDOException $error){
            return $error->getMessage();
        }
    }
}





