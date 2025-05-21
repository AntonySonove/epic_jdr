<?php
class ModelCharacterSheet{
    //!attributs
    private ?string $name;
    private ?int $lp;
    private ?int $mp;
    private ?int $atk;
    private ?int $def;
    private ?int $atkm;
    private ?int $defm;
    private ?int $speed;
    private ?int $id;
    private ?PDO $bdd;

    

    //!constructor
    public function __construct() {
        $this->bdd = dbConnect();

    }
    //! getter et setter
    public function getName(): ?string { return $this->name; }
    public function setName(?string $name): self { $this->name = $name; return $this; }

    public function getLp(): ?int { return $this->lp; }
    public function setLp(?int $lp): self { $this->lp = $lp; return $this; }

    public function getMp(): ?int { return $this->mp; }
    public function setMp(?int $mp): self { $this->mp = $mp; return $this; }

    public function getAtk(): ?int { return $this->atk; }
    public function setAtk(?int $atk): self { $this->atk = $atk; return $this; }

    public function getDef(): ?int { return $this->def; }
    public function setDef(?int $def): self { $this->def = $def; return $this; }

    public function getAtkm(): ?int { return $this->atkm; }
    public function setAtkm(?int $atkm): self { $this->atkm = $atkm; return $this; }

    public function getDefm(): ?int { return $this->defm; }
    public function setDefm(?int $defm): self { $this->defm = $defm; return $this; }

    public function getSpeed(): ?int { return $this->speed; }
    public function setSpeed(?int $speed): self { $this->speed = $speed; return $this; }

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getBdd(): ?PDO { return $this->bdd; }
    public function setBdd(?PDO $bdd): self { $this->bdd = $bdd; return $this; }

    public function getOneCharacter():array | string{

        try {
            
        $req=$this->getBdd()->prepare("SELECT id_character, name_character, lp, mp, atk, def, atkm, defm, speed, c.id_user 
        FROM characters as c
        INNER JOIN users AS u
        ON c.id_user = u.id_user
        WHERE name_character=? AND c.id_user=? AND id_character=? AND email=? AND nickname=?");

        $req->bindParam(1,$_GET["name_character"],PDO::PARAM_STR);
        $req->bindParam(2,$_SESSION["id_user"],PDO::PARAM_INT);
        $req->bindParam(3,$_GET["id_character"],PDO::PARAM_INT);
        $req->bindParam(4, $_SESSION["email"], PDO::PARAM_STR);
        $req->bindParam(5, $_SESSION["nickname"], PDO::PARAM_STR);

        $req->execute();

        $data=$req->fetchAll(PDO::FETCH_ASSOC);

        return $data;

        } catch (PDOException $error) {
            return $error->getMessage();
        }
    }

    public function modify():array | string{
        try{

            $lp=$this->getLp();
            $mp=$this->getMp();
            $atk=$this->getAtk();
            $def=$this->getDef();
            $atkm=$this->getAtkm();
            $defm=$this->getDefm();
            $speed=$this->getSpeed();

            $req=$this->getBdd()->prepare("UPDATE characters 
            SET lp=?, mp=?, atk=?, def=?, atkm=?, defm=?, speed=?
            WHERE name_character=? AND id_user=? AND id_character=?");

            $req->bindParam(1,$lp,PDO::PARAM_INT);
            $req->bindParam(2,$mp,PDO::PARAM_INT);
            $req->bindParam(3,$atk,PDO::PARAM_INT);
            $req->bindParam(4,$def,PDO::PARAM_INT);
            $req->bindParam(5,$atkm,PDO::PARAM_INT);
            $req->bindParam(6,$defm,PDO::PARAM_INT);
            $req->bindParam(7,$speed,PDO::PARAM_INT);
            $req->bindParam(8,$_GET["name_character"],PDO::PARAM_STR);
            $req->bindParam(9,$_SESSION["id_user"],PDO::PARAM_INT);
            $req->bindParam(10,$_GET["id_character"],PDO::PARAM_INT);
            $req->execute();

            return "<span style='color:green'>*Modification(s) enregistrée(s)</span>";

        }catch(PDOException $error){
            return $error->getMessage();
        }
    }
    
    public function delete():string{

        try{

            $req=$this->getBdd()->prepare("DELETE FROM characters
            WHERE id_character=? AND name_character=? AND id_user=?");

            $id=$this->getId();
            $name=$this->getName();

            $req->bindParam(1, $id, PDO::PARAM_INT);
            $req->bindParam(2, $name, PDO::PARAM_STR);
            $req->bindParam(3, $_SESSION["id_user"], PDO::PARAM_INT);

            $req->execute();

            return "<span style='color:green'>*Personnage supprimé</span>";

        }catch(PDOException $error){
            return $error->getMessage();
        }
    }
}

