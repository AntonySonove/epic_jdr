<?php
class ViewHeader{
    private ?string $header;

    public function getHeader(): ?string { return $this->header; }
    public function setHeader(?string $header): self { $this->header = $header; return $this; }

    public function displayView():string{

        return '

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPIC JDR - accueil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/repository/epic_jdr/src/style/header.css">
    <link rel="stylesheet" href="/repository/epic_jdr/src/style/footer.css">
    <link rel="stylesheet" href="/repository/epic_jdr/src/style/index.css">
    <link rel="stylesheet" href="/repository/epic_jdr/src/style/account.css">
    <link rel="stylesheet" href="/repository/epic_jdr/src/style/create_character.css">
    <link rel="stylesheet" href="/repository/epic_jdr/src/style/character_list.css">
    <link rel="stylesheet" href="/repository/epic_jdr/src/style/character_sheet.css"> 
    <link rel="stylesheet" href="/repository/epic_jdr/src/style/play.css"> 
</head>
<body>

'.$this->getHeader().'
        ';
    }
}
