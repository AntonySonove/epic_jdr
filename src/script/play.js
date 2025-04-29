const burgerMenuPlay= document.getElementById("burgerMenuPlay");
const dropdownPlay=document.getElementById("dropdownPlay");

burgerMenuPlay.addEventListener("click",(event)=>{
    dropdownPlay.classList.toggle("showDropdown")
    event.stopPropagation(); //? empêche de clique de se propager au document
});

document.addEventListener("click", (event)=>{
    if(!dropdownPlay.contains(event.target) && !burgerMenuPlay.contains(event.target)){
        dropdownPlay.classList.remove("showDropdown")
    }
})

function fetchCharacter(){

    fetch(`controller_play_data_character.php`)
        .then(response => response.json())
        .then(data => {
            console.log(data);

            let lp=data[0]["lp"];
            let mp=data[0]["mp"];
            let atk=data[0]["atk"];
            let def=data[0]["def"];
            let atkm=data[0]["atkm"];
            let defm=data[0]["defm"];
            let speed=data[0]["speed"];

            // let reset=[];
            // reset.push(lp, mp, atk, def, atkm, defm, speed);
            // console.log(reset);

            let currentLp=document.getElementById("currentLp");
            let currentMp=document.getElementById("currentMp");
            let currentAtk=document.getElementById("currentAtk");
            let currentDef=document.getElementById("currentDef");
            let currentAtkm=document.getElementById("currentAtkm");
            let currentDefm=document.getElementById("currentDefm");
            let currentSpeed=document.getElementById("currentSpeed");
            
            let upLp=document.getElementById("upLp");
            let upMp=document.getElementById("upMp");
            let upAtk=document.getElementById("upAtk");
            let upDef=document.getElementById("upDef");
            let upAtkm=document.getElementById("upAtkm");
            let upDefm=document.getElementById("upDefm");
            let upSpeed=document.getElementById("upSpeed");
            
            let downLp=document.getElementById("downLp");
            let downMp=document.getElementById("downMp");
            let downAtk=document.getElementById("downAtk");
            let downDef=document.getElementById("downDef");
            let downAtkm=document.getElementById("downAtkm");
            let downDefm=document.getElementById("downDefm");
            let downSpeed=document.getElementById("downSpeed");

            let inputLp=document.getElementById("inputLp");
            let inputMp=document.getElementById("inputMp");
            let inputAtk=document.getElementById("inputAtk");
            let inputDef=document.getElementById("inputDef");
            let inputAtkm=document.getElementById("inputAtkm");
            let inputDefm=document.getElementById("inputDefm");
            let inputSpeed=document.getElementById("inputSpeed");

            const resetLp=document.getElementById("resetLp");
            const resetMp=document.getElementById("resetMp");
            const resetAtk=document.getElementById("resetAtk");
            const resetDef=document.getElementById("resetDef");
            const resetAtkm=document.getElementById("resetAtkm");
            const resetDefm=document.getElementById("resetDefm");
            const resetSpeed=document.getElementById("resetSpeed");
            // const resetAll=document.getElementById("resetAll");
            
            let stats={
                lp:[upLp, lp, currentLp, downLp, inputLp, resetLp],
                mp:[upMp, mp, currentMp, downMp, inputMp, resetMp],
                atk:[upAtk, atk, currentAtk, downAtk, inputAtk, resetAtk],
                def:[upDef, def, currentDef, downDef, inputDef, resetDef],
                atkm:[upAtkm, atkm, currentAtkm, downAtkm, inputAtkm, resetAtkm],
                defm:[upDefm, defm, currentDefm, downDefm, inputDefm, resetDefm],
                speed:[upSpeed, speed, currentSpeed, downSpeed, inputSpeed, resetSpeed]
                
            };

            //! BOUCLE POUR LES OPERATIONS

            Object.values(stats).forEach((key) => { 
                //? Object.value permet de boucler sur un tableau d'objet (.value permet d'acceder uniquement au valeurs)
                
                key[0].addEventListener("click",()=>{

                    key[1]+=Number(key[4].value) || 1; 
                    
                    //? Number() permet de forcer la chaîne de caractère de l'input en nombre pour pouvoir faire l'opération
                    // || 1 permet de fixer la valeur de l'input a 1 si il est vide, ou à 0, et permet de ne rien afficher dans l'input

                    key[2].innerText=key[1]; //? affiche le résultat

                    key[4].value=""; //? vide la saisie de l'input

                    if (key[1]<0){
                        key[2].innerText=0;
                    }
                });

                key[3].addEventListener("click",()=>{

                    key[1]-=Number(key[4].value) || 1;
                    key[2].innerText=key[1];
                    key[4].value="";

                    if (key[1]<0){
                        key[2].innerText=0;
                    }
                });
                console.log(key[5])
                key[5].addEventListener("click",()=>{

                    key[1]=lp;
                    key[2].innerText=key[1];
                })
            });
        })
        .catch(error => {
            console.error("Erreur lors du fetch",error)
        }
    );
}
fetchCharacter();