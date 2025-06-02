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

    fetch(`/repository/epic_jdr/controller/controller_play_data_character.php`)
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

            const resetLp2=document.getElementById("resetLp2");
            const resetMp2=document.getElementById("resetMp2");
            const resetAtk2=document.getElementById("resetAtk2");
            const resetDef2=document.getElementById("resetDef2");
            const resetAtkm2=document.getElementById("resetAtkm2");
            const resetDefm2=document.getElementById("resetDefm2");
            const resetSpeed2=document.getElementById("resetSpeed2");
            
            // let stats={
            //     lp:[upLp, lp, currentLp, downLp, inputLp, resetLp, resetLp2],
            //     mp:[upMp, mp, currentMp, downMp, inputMp, resetMp, resetMp2],
            //     atk:[upAtk, atk, currentAtk, downAtk, inputAtk, resetAtk, resetAtk2],
            //     def:[upDef, def, currentDef, downDef, inputDef, resetDef, resetDef2],
            //     atkm:[upAtkm, atkm, currentAtkm, downAtkm, inputAtkm, resetAtkm, resetAtkm2],
            //     defm:[upDefm, defm, currentDefm, downDefm, inputDefm, resetDefm, resetDefm2],
            //     speed:[upSpeed, speed, currentSpeed, downSpeed, inputSpeed, resetSpeed, resetSpeed2]
            // };
            let stats={
                lp:[upLp, lp, currentLp, downLp, inputLp, resetLp, resetLp2, lp],
                mp:[upMp, mp, currentMp, downMp, inputMp, resetMp, resetMp2, mp],
                atk:[upAtk, atk, currentAtk, downAtk, inputAtk, resetAtk, resetAtk2, atk],
                def:[upDef, def, currentDef, downDef, inputDef, resetDef, resetDef2, def],
                atkm:[upAtkm, atkm, currentAtkm, downAtkm, inputAtkm, resetAtkm, resetAtkm2, atkm],
                defm:[upDefm, defm, currentDefm, downDefm, inputDefm, resetDefm, resetDefm2, defm],
                speed:[upSpeed, speed, currentSpeed, downSpeed, inputSpeed, resetSpeed, resetSpeed2, speed]
            };

            let maxLpGauge=lp;
            let maxMpGauge=mp;

            //! BOUCLE POUR LES OPERATIONS

            Object.values(stats).forEach((key) => { 
                //? Object.value permet de boucler sur un tableau d'objet (.value permet d'acceder uniquement au valeurs)
                
                //* Boutons +
                key[0].addEventListener("click",()=>{

                    key[1]+=Number(key[4].value) || 1; 
                    
                    //? Number() permet de forcer la chaîne de caractère de l'input en nombre pour pouvoir faire l'opération
                    // || 1 permet de fixer la valeur de l'input a 1 si il est vide, ou à 0, et permet de ne rien afficher dans l'input

                    key[2].innerText=key[1]; //? affiche le résultat

                    key[4].value=""; //? vide la saisie de l'input

                    if (key[1]<0){
                        key[2].innerText=0; //? bloque le texte 0 lorsque les points d'une statistique devient inférieur a 0
                    }
                    console.log(stats);
                });

                //* Boutons -
                key[3].addEventListener("click",()=>{

                    key[1]-=Number(key[4].value) || 1;
                    key[2].innerText=key[1];
                    key[4].value="";

                    if (key[1]<0){
                        key[2].innerText=0;
                    }
                });
                
                //* Reset (menu dropdown)
                key[5].addEventListener("click",()=>{

                    key[1]=key[7];
                    key[2].innerText=key[1];
                })

                //* Reset
                key[6].addEventListener("click",()=>{

                    key[1]=key[7];
                    key[2].innerText=key[1];
                })
            });

            //! ANNIMATION DES JAUGES DE PV ET PM
            
            //* JAUGE PV
            // Augmentation
            upLp.addEventListener("click", () => {

                let currentLp=stats["lp"][1];
                let pourcent=(currentLp/maxLpGauge)*100;

                if(currentLp>maxLpGauge){
                    pourcent=100;
                }
             
                document.querySelector('#greenLp').style.width = pourcent + "%";
            });

            // Diminution
            downLp.addEventListener("click", () => {

                let currentLp=stats["lp"][1];
                let pourcent=(currentLp/maxLpGauge)*100;

                if(currentLp<0){
                    pourcent=0;
                }
                if(currentLp>maxLpGauge){
                    pourcent=100;
                }

                document.querySelector('.lpGauge div').style.width = pourcent + "%";
            });

            // Boutons reset (menu dropdown)
            resetLp.addEventListener("click",()=>{
                let pourcent=100;

                document.querySelector('.lpGauge div').style.width = pourcent + "%";
            })

            // Boutons reset
            resetLp2.addEventListener("click",()=>{
                let pourcent=100;
                
                document.querySelector('.lpGauge div').style.width = pourcent + "%";
            })

            //* JAUGE MP
            // Augmentation
            upMp.addEventListener("click", () => {

                let currentMp=stats["mp"][1];
                let pourcent=(currentMp/maxMpGauge)*100;

                if(currentMp>maxMpGauge){
                    pourcent=100;
                }

                document.querySelector('.mpGauge div').style.width = pourcent + "%";
            });

            // Diminution
            downMp.addEventListener("click", () => {

                let currentMp=stats["mp"][1];
                let pourcent=(currentMp/maxMpGauge)*100;

                if(currentMp<0){
                    pourcent=0;
                }
                if(currentMp>maxMpGauge){
                    pourcent=100;
                }

                document.querySelector('.mpGauge div').style.width = pourcent + "%";
            });

            // Boutons reset (menu dropdown)
            resetMp.addEventListener("click",()=>{
                let pourcent=100;
                document.querySelector('.mpGauge div').style.width = pourcent + "%";
            })

            // Boutons reset
            resetMp2.addEventListener("click",()=>{
                let pourcent=100;
                document.querySelector('.mpGauge div').style.width = pourcent + "%";
            })
        })
        .catch(error => {
            console.error("Erreur lors du fetch",error)
        }
    );
}
fetchCharacter();

