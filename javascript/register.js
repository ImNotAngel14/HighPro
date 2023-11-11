function validate()
{
    let element_password = document.getElementById('id_password');
    let element_email = document.getElementById('id_email');
    let password = element_password.value;
    let email = element_email.value;
    if(!validatePassword(password))
    {
        element_password.classList.add("is-invalid");
        document.getElementById('id_pass_req').hidden = false;
        return false;
    }
    document.getElementById('id_pass_req').hidden = true;
    element_password.classList.remove("is-invalid");
    if(!validateEmail(email))
    {
        element_email.classList.add("is-invalid");
        document.getElementById('id_email_validation').hidden = false;
        return false;
    }
    element_email.classList.remove("is-invalid");
    document.getElementById('id_email_validation').hidden = true;

    var saved = registerUser();
    return saved;
}

function validatePassword(pPassword) {
    let validPassword = true;
    document.getElementById("id_req_length").style.color = "green";
    document.getElementById("id_req_upper").style.color = "green";
    document.getElementById("id_req_lower").style.color = "green";
    document.getElementById("id_req_number").style.color = "green";
    document.getElementById("id_req_special").style.color = "green";
    // Verificar si la contraseña tiene al menos 8 caracteres
    if (pPassword.length < 8)
    {
        validPassword = false;
        document.getElementById("id_req_length").style.color = "red";
    }

    // Verificar si hay al menos una letra mayúscula
    if (!/[A-Z]/.test(pPassword)) {
        validPassword = false;
        document.getElementById("id_req_upper").style.color = "red";
    }

    // Verificar si hay al menos una letra minúscula
    if (!/[a-z]/.test(pPassword)) {
        validPassword = false;
        document.getElementById("id_req_lower").style.color = "red";
    }

    // Verificar si hay al menos un número
    if (!/[0-9]/.test(pPassword)) {
        validPassword = false;
        document.getElementById("id_req_number").style.color = "red";
    }

    // Verificar si hay al menos un carácter especial
    if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(pPassword)) {
        validPassword = false;
        document.getElementById("id_req_special").style.color = "red";
    }
    // Si pasa todas las validaciones, la contraseña es válida
    return validPassword;
}

function validateEmail(pEmail)
{
    // Expresión regular para validar un correo electrónico
    var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    // Utilizamos el método test de la expresión regular para verificar si la cadena coincide con el patrón
    return pattern.test(pEmail);
}


function registerUser()
{
    const cPassword = document.getElementById("id_password");
    const cEmail = document.getElementById("id_email");
    const cName = document.getElementById("id_name");
    const cLastName = document.getElementById("id_lastname");
    const cBirthdate = document.getElementById("id_birthdate").value;
    const cGenre = document.getElementById("id_genre").value;
    var authResult = false;
    let xhr = new XMLHttpRequest();
    const user = 
    {
        password: cPassword.value,
        email: cEmail.value,
        name: cName.value,
        lastname: cLastName.value,
        birthdate: cBirthdate,
        genre: cGenre
    };
    xhr.open("POST", "./controller/signup.php", true);
    xhr.onreadystatechange = function () 
    {
        try
        {
            if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)
            {
                let res = JSON.parse(xhr.response);
                if(res.success != true)
                {
                    authResult = false;
                    return;
                }
                alert("Para finalizar tu registro completo es necesario que ingreses a tu cuenta, seccion de direcciones y agregues una dirección");
                window.location.replace("./login.html");
                authResult = true;
            }
        }catch(error)
        {
            console.error(xhr.response);
        }
    }
    xhr.send(JSON.stringify(user));
    return authResult;
}