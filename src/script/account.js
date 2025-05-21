const formPassword=document.querySelector("#formPassword");
const changePassword=document.querySelector("#changePassword");
const changePasswordError=document.querySelector("#changePasswordError");

const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])[A-Za-z\d\S]{8,}$/;

formPassword.addEventListener("submit",(e) => {

    const password = changePassword.value;
    
    if (!regexPassword.test(password)) {
        
        e.preventDefault();
        
        changePasswordError.textContent="*Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";

        return;
    }
});

const mdp="Kaibacorp1"
// console.log(regexPassword.test(mdp));