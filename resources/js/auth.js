// auth.js
document.addEventListener('DOMContentLoaded', () => {

    function togglePassword(inputId, buttonId, iconId) {

        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);
        const icon = document.getElementById(iconId);

        if(!input || !button || !icon) return;

        button.addEventListener('click', () => {

            const isPassword = input.type === "password";

            input.type = isPassword ? "text" : "password";

            icon.classList.toggle("fa-eye", !isPassword);
            icon.classList.toggle("fa-eye-slash", isPassword);

            button.setAttribute(
                "aria-label",
                isPassword ? "Esconder senha" : "Mostrar senha"
            );

        });

    }

    // senha principal
    togglePassword("password", "eyeButton", "eyeIcon");

    // confirmação de senha
    togglePassword("passwordConfirmation", "eyeButtonConfirmation", "eyeIconConfirmation");

    // confirmação de senha
    togglePassword("current_password", "eyeButtonCurrent", "eyeIconCurrent");

});