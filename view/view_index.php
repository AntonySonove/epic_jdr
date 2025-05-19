<?php
class ViewIndex{

    //! attributs
   private ?string $message="";
   private ?string $messageConnexion= "";
//    private ?string $messageDelete;
   
   //! getter et setter
   public function getMessage(): ?string { return $this->message; }
   public function setMessage(?string $message): self { $this->message = $message; return $this; }

   public function getMessageConnexion(): ?string { return $this->messageConnexion; }
   public function setMessageConnexion(?string $messageConnexion): self { $this->messageConnexion = $messageConnexion; return $this; }
   
   //    public function getMessageDelete(): ?string { return $this->messageDelete; }
   //    public function setMessageDelete(?string $messageDelete): self { $this->messageDelete = $messageDelete; return $this; }
   
   //! method
   public function displayView(){
       
       return '
       
    <main class="mainIndex">
       
    '.$this->getMessageConnexion().'
    '.$this->getMessage().'

    <div class="welcome">
        <h1>Bienvenue sur EPIC JDR</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum eos omnis quaerat odit quam doloribus hic rem? Neque, nam tenetur doloremque nulla nostrum adipisci itaque. Commodi, esse temporibus tempora doloribus ipsam odit, molestiae unde nam officiis ut debitis doloremque iure porro fugiat quod corporis cupiditate itaque. Voluptate porro deserunt fuga explicabo iste consequatur minus soluta necessitatibus ab magni, nulla beatae. Maiores illum unde excepturi blanditiis ut iusto, dolore iste libero at ea ratione pariatur dolorem ducimus velit est atque non magni nihil laboriosam, aliquid autem? Tenetur reprehenderit dolorem at, odit libero dignissimos eaque aperiam quibusdam a sunt tempora! Natus, repellendus.</p>
    </div>
    
    <div class="signInSignUp">
        <form id="signIn" class="welcome connexion" method="post">
            <h2>Connexion</h2>
            
            <input class="inputFocus" type="email" name="emailConnexion" placeholder="E-mail">
        
            <input class="inputFocus" type="password" name="passwordConnexion" placeholder="Mot de passe">

            
            <input class="submitIndex" type="submit" name="submitConnexion" value="Continuer l\'aventure!"></input>     
        </form>


        <form id="signUp" class="welcome connexion" method="post">
            <h2>Inscription</h2>
        
            <input class="inputFocus" type="text" name="nickname" placeholder="Pseudo">

            <input class="inputFocus" type="email" name="email" placeholder="E-mail">

            <input class="inputFocus" type="password" name="password" placeholder="Mot de passe">

            <input class="inputFocus" type="password" name="password2" placeholder="Confirmer le mot de passe">

            
            <input class="submitIndex" type="submit" name="submit" value="Commencer l\'aventure!"></input>

        </form>
    </div>
    <div id="passwordError" style="color:red"></div>

</main>
        ';
    }
}