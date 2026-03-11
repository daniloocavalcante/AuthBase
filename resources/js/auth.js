// auth.js
document.addEventListener('DOMContentLoaded', () => {
    
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    // Só executa se os elementos existirem na página
    if(passwordInput && eyeIcon) {

        document.getElementById('eyeButton').addEventListener('click', () => {

            if(passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
                document.getElementById('eyeButton').setAttribute('aria-label', 'Esconder senha');
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
                document.getElementById('eyeButton').setAttribute('aria-label', 'Esconder senha');
            }

        });

    }

    const passwordConfirmation = document.getElementById('passwordConfirmation');
    const eyeIconConfirmation = document.getElementById('eyeIconConfirmation');

    if(passwordInput && eyeIcon) {

        document.getElementById('eyeButtonConfirmation').addEventListener('click', () => {

            if(passwordConfirmation.type === "password") {
                passwordConfirmation.type = "text";
                eyeIconConfirmation.classList.remove("fa-eye");
                eyeIconConfirmation.classList.add("fa-eye-slash");
            } else {
                passwordConfirmation.type = "password";
                eyeIconConfirmation.classList.remove("fa-eye-slash");
                eyeIconConfirmation.classList.add("fa-eye");
            }

        });

    }


});