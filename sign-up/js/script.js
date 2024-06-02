const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});


/*SIGN UP*/

// Selecciona el formulario de registro
const registerForm = document.getElementById('login-form');

// Agrega un evento de escucha para la presentación del formulario
registerForm.addEventListener('submit', function (event) {
    // Obtiene los valores de los campos
    const nameInput = document.querySelector('input[placeholder="Name"]');
    const emailInput = document.querySelector('input[type="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    
    // Realiza la validación
    if (!isValidName(nameInput.value.trim())) {
        alert('Por favor, ingrese su nombre.');
        event.preventDefault();
    } else if (!isValidEmail(emailInput.value.trim())) {
        alert('Por favor, ingrese una dirección de correo electrónico válida.');
        event.preventDefault();
    } else if (passwordInput.value.length < 6) {
        alert('La contraseña debe tener al menos 6 caracteres.');
        event.preventDefault();
    }
});

// Funciones para validar el nombre y el correo electrónico
function isValidName(name) {
    return name.trim().length > 0;
}

function isValidEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(email);
}





/*LOG IN*/
const emailInput = document.getElementById('emailInput');
    const passwordInput = document.getElementById('passwordInput');
    const loginButton = document.getElementById('loginButton');

    loginButton.addEventListener('click', function() {
        const email = emailInput.value;
        const password = passwordInput.value;

        if (!email && !password) {
            alert('Por favor, complete todos los campos.');
        } else if (!email) {
            alert('Por favor, ingrese su dirección de correo electrónico.');
        } else if (!isValidEmailFormat(email)) {
            alert('Por favor, ingrese una dirección de correo electrónico válida como example@gmail.com.');
        } else if (!password) {
            alert('Por favor, ingrese su contraseña.');
        } else {
            // Continúa con tu proceso de inicio de sesión si los campos están llenos y el correo es válido.
        }
    });

    function isValidEmailFormat(email) {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        const containsAtAndDomain = email.includes('@') && email.split('@')[1].includes('.');
        return emailPattern.test(email) && containsAtAndDomain;
    }









