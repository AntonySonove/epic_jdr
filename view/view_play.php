<?php
class ViewPlay{
    private ?string $character;

    public function getCharacter(): ?string { return $this->character; }
    public function setCharacter(?string $character): self { $this->character = $character; return $this; }

    public function displayView():string{

        return '
<main class="mainPlay">
    '.$this->getCharacter().'
</main>
<script src="/repository/epic_jdr/src/script/play.js"></script>
        ';
    }
}
