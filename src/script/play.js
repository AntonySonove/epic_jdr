
fetch(`controller_play_data_character.php`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error("Erreur lors du fetch",error)
    });