    const regexName = new RegExp(/^([a-zA-Z ]+)$/);
    const regexPostal = new RegExp("^[0-9]{1,10}$");
    const regexEmail = new RegExp("[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+");
    const button = document.getElementById("myButton");
    const regexCity = new RegExp(/^([a-zA-Z ]+)$/);
    const regexPassword = new RegExp(/^([a-zA-Z ]+)$/); //a modifier
    let verifResponse = [0, 0, 0, 0, 0, 0, 0];


    //Partie concernant la création d'un compte


    function Verify(params) {
      if (!params.includes(0)) {
        button.disabled = false
        buttonInformation.hidden = true
      } else {
        button.disabled = true
        buttonInformation.hidden = false
      }
    }

    Verify(verifResponse);

    yourName.addEventListener("focusout", function () {
      if (regexName.test(yourName.value) && yourName.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosName.innerHTML = "Format valide"
        messageInfosName.className = "noerror"
        yourName.className = "form-control is-valid"
        verifResponse[0] = 1
        Verify(verifResponse);
      } else if (!regexName.test(yourName.value) && yourName.value != "") {
        messageInfosName.innerHTML = "Mauvais format"
        messageInfosName.className = "error"
        yourName.className = "form-control is-invalid"
        verifResponse[0] = 0
        Verify(verifResponse);
      } else {
        messageInfosName.innerHTML = ""
        yourName.className = "form-control"
        verifResponse[0] = 0
        Verify(verifResponse);
      }
    })

    yourFirstName.addEventListener("focusout", function () {
      if (regexName.test(yourFirstName.value) && yourFirstName.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosFirstName.innerHTML = "Format valide"
        messageInfosFirstName.className = "noerror"
        yourFirstName.className = "form-control is-valid"
        verifResponse[1] = 1
        Verify(verifResponse);
      } else if (!regexName.test(yourFirstName.value) && yourFirstName.value != "") {
        messageInfosFirstName.innerHTML = "Mauvais format"
        messageInfosFirstName.className = "error"
        yourFirstName.className = "form-control is-invalid"
        verifResponse[1] = 0
        Verify(verifResponse);
      } else {
        messageInfosFirstName.innerHTML = ""
        yourFirstName.className = "form-control"
        verifResponse[1] = 0
        Verify(verifResponse);
      }
    })


    yourEmail.addEventListener("focusout", function () {
      if (regexEmail.test(yourEmail.value) && yourEmail.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosEmail.innerHTML = "Format valide"
        messageInfosEmail.className = "noerror"
        yourEmail.className = "form-control is-valid"
        verifResponse[2] = 1
        Verify(verifResponse);
      } else if (!regexEmail.test(yourEmail.value) && yourEmail.value != "") {
        messageInfosEmail.innerHTML = "Mauvais format"
        messageInfosEmail.className = "error"
        yourEmail.className = "form-control is-invalid"
        verifResponse[2] = 0
        Verify(verifResponse);
      } else {
        messageInfosEmail.innerHTML = ""
        yourEmail.className = "form-control"
        verifResponse[2] = 0
        Verify(verifResponse);
      }
    })


    yourCity.addEventListener("focusout", function () {
      if (regexCity.test(yourCity.value) && yourCity.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosCity.innerHTML = "Format valide"
        messageInfosCity.className = "noerror"
        yourCity.className = "form-control is-valid"
        verifResponse[3] = 1
        Verify(verifResponse);
      } else if (!regexCity.test(yourCity.value) && yourCity.value != "") {
        messageInfosCity.innerHTML = "Mauvais format"
        messageInfosCity.className = "error"
        yourCity.className = "form-control is-invalid"
        verifResponse[3] = 0
        Verify(verifResponse);
      } else {
        messageInfosCity.innerHTML = ""
        yourCity.className = "form-control"
        verifResponse[3] = 0
        Verify(verifResponse);
      }
    })

    yourPostalCode.addEventListener("focusout", function () {
      if (regexPostal.test(yourPostalCode.value) && yourPostalCode.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosPostalCode.innerHTML = "Format valide"
        messageInfosPostalCode.className = "noerror"
        yourPostalCode.className = "form-control is-valid"
        verifResponse[4] = 1
        Verify(verifResponse);
      } else if (!regexPostal.test(yourPostalCode.value) && yourPostalCode.value != "") {
        messageInfosPostalCode.innerHTML = "Mauvais format"
        messageInfosPostalCode.className = "error"
        yourPostalCode.className = "form-control is-invalid"
        verifResponse[4] = 0
        Verify(verifResponse);
      } else {
        messageInfosPostalCode.innerHTML = ""
        yourPostalCode.className = "form-control"
        verifResponse[4] = 0
        Verify(verifResponse);
      }
    })

    yourPassword.addEventListener("focusout", function () {
      if (regexPassword.test(yourPassword.value) && yourPassword.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosPassword.innerHTML = "Format valide"
        messageInfosPassword.className = "noerror"
        yourPassword.className = "form-control is-valid"
        verifResponse[5] = 1
        Verify(verifResponse);
      } else if (!regexPassword.test(yourPassword.value) && yourPassword.value != "") {
        messageInfosPassword.innerHTML = "Mauvais format"
        messageInfosPassword.className = "error"
        yourPassword.className = "form-control is-invalid"
        verifResponse[5] = 0
        Verify(verifResponse);
      } else {
        messageInfosPassword.innerHTML = ""
        yourPassword.className = "form-control"
        verifResponse[5] = 0
        Verify(verifResponse);
      }
    })

    yourConfirmPassword.addEventListener("focusout", function () {
      if (regexPassword.test(yourConfirmPassword.value) && yourConfirmPassword.value == yourPassword.value && yourConfirmPassword.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosConfirmPassword.innerHTML = "Format valide"
        messageInfosConfirmPassword.className = "noerror"
        yourConfirmPassword.className = "form-control is-valid"
        verifResponse[6] = 1
        Verify(verifResponse);
      } else if (yourConfirmPassword.value != yourPassword.value && yourConfirmPassword.value != "") {
        messageInfosConfirmPassword.innerHTML = "Mot de passe différent du premier"
        messageInfosConfirmPassword.className = "error"
        yourConfirmPassword.className = "form-control is-invalid"
        verifResponse[6] = 0
        Verify(verifResponse);
      } else if (!regexPassword.test(yourConfirmPassword.value) && yourConfirmPassword.value != "") {
        messageInfosConfirmPassword.innerHTML = "Mauvais format"
        messageInfosConfirmPassword.className = "error"
        yourConfirmPassword.className = "form-control is-invalid"
        verifResponse[6] = 0
        Verify(verifResponse);
      } else {
        messageInfosConfirmPassword.innerHTML = ""
        yourConfirmPassword.className = "form-control"
        verifResponse[6] = 0
        Verify(verifResponse);
      }
    })



  
    function onSubmit(token) {
      document.getElementById("createcount").submit();
    }
 
