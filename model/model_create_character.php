<?php
class ModelCreateCharacter{
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

    public function __construct(){
        $this->bdd=dbConnect();
    }

   
    //! getter et setter
    public function getBdd(): ?PDO{
        return $this->bdd;
    }
    public function setBdd(PDO $bdd): ModelCreateCharacter{
        $this->bdd=$bdd;
        return $this;
    }
    public function getName(): ?string{
        return $this->name;
    }
    public function setName(string $name): ModelCreateCharacter{
        $this->name=$name;
        return $this;
    }
    public function getLp(): ?int{
        return $this->lp;
    }
    public function setLp(int $lp): ModelCreateCharacter{
        $this->lp=$lp;
        return $this;
    }
    public function getMp(): ?int{
        return $this->mp;
    }
    public function setMp(int $mp): ModelCreateCharacter{
        $this->mp=$mp;
        return $this;
    }
    public function getAtk(): ?int{
        return $this->atk;
    }
    public function setAtk(int $atk): ModelCreateCharacter{
        $this->atk=$atk;
        return $this;
    }
    public function getDef(): ?int{
        return $this->def;
    }
    public function setDef(int $def): ModelCreateCharacter{
        $this->def=$def;
        return $this;
    }
    
    public function getAtkm(): ?int{
        return $this->atkm;
    }
    public function setAtkm(int $atkm): ModelCreateCharacter{
        $this->atkm=$atkm;
        return $this;
    }
    public function getDefm(): ?int{
        return $this->defm;
    }
    public function setDefm(int $defm): ModelCreateCharacter{
        $this->defm=$defm;
        return $this;
    }
    public function getSpeed(): ?int{
        return $this->speed;
    }
    public function setSpeed(int $speed): ModelCreateCharacter{
        $this->speed=$speed;
        return $this;
    }
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }

    //! method
    public function addCharacter():?string{
        try{

            $req=$this->getBdd()->prepare("INSERT INTO characters (name_character, lp, mp, atk, def, atkm, defm, speed, id_user) VALUES (?,?,?,?,?,?,?,?,?)");

            $name=$this->getName();
            $lp=$this->getLp();
            $mp=$this->getMp();
            $atk=$this->getAtk();
            $def=$this->getDef();
            $atkm=$this->getAtkm();
            $defm=$this->getDefm();
            $speed=$this->getSpeed();
            $id=$this->getId();
            
            $req->bindParam(1,$name,PDO::PARAM_STR);
            $req->bindParam(2,$lp,PDO::PARAM_INT);
            $req->bindParam(3,$mp,PDO::PARAM_INT);
            $req->bindParam(4,$atk,PDO::PARAM_INT);
            $req->bindParam(5,$def,PDO::PARAM_INT);
            $req->bindParam(6,$atkm,PDO::PARAM_INT);
            $req->bindParam(7,$defm,PDO::PARAM_INT);
            $req->bindParam(8,$speed,PDO::PARAM_INT);
            $req->bindParam(9,$id,PDO::PARAM_INT);

            $req->execute();
            
            return "<span style= 'color: green'>*Nouveau personnage enregistré</span>";

        }catch(Exception $error){
            return $error->getMessage();
        }
    }

    public function getByName():array | string{
        try{

            $req=$this->getBdd()->prepare("SELECT name_character, lp, mp, atk, def, atkm, defm, speed, id_character,id_user FROM characters WHERE name_character=?");

            $name=$this->getName();
            
            $req->bindParam(1,$name,PDO::PARAM_STR);

            $req->execute();

            $data=$req->fetchAll(PDO::FETCH_ASSOC);

            return $data;

        }catch(Exception $error){
            return $error->getMessage();
        }
    }
}
