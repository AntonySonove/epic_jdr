const signUp = document.querySelector("#signUp");
const passwordSignUp = document.querySelector("input[name='password']");
const passwordError=document.querySelector("#passwordError");



const regexPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])[A-Za-z\d\S]{8,}$/;

signUp.addEventListener("submit",(e) => {

    const password = passwordSignUp.value;
    
    if (!regexPassword.test(password)) {
        
        e.preventDefault(); //? Empêche l'envoi du formulaire
        
        passwordError.textContent="*Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";

        return;
    }
});
