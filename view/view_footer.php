    <footer>
        <a href="#">Mentions légales</a>
        <a href="#">Politique de confidentialité</a>
        <a href="#">Paramètre des cookies</a>
        <a href="#">Contact</a>
    </footer>
    
    <?php
    if($_SESSION){
        $script='
    <script src="/repository/epic_jdr/src/script/header.js"></script>';
    }else{
        $script='';
    }
    ?>
    <?= $script ?>
</body>
</html>