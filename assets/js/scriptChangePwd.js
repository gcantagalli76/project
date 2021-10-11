    const regexPassword = new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z]).{5,}$/);
    let verifResponse = [0, 0, 0];


    //Partie concernant le changement de mdp


    function Verify(params) {
      if (!params.includes(0)) {
        changeMyPwd.disabled = false
        buttonInformation.hidden = true
      } else {
        changeMyPwd.disabled = true
        buttonInformation.hidden = false
      }
    }

    Verify(verifResponse);

    yourExPassword.addEventListener("focusout", function () {
      if (regexPassword.test(yourExPassword.value) && yourExPassword.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosExPassword.innerHTML = "Format valide"
        messageInfosExPassword.className = "noerror"
        yourExPassword.className = "form-control is-valid"
        verifResponse[0] = 1
        Verify(verifResponse);
      } else if (!regexPassword.test(yourExPassword.value) && yourExPassword.value != "") {
        messageInfosExPassword.innerHTML = "Mauvais format"
        messageInfosExPassword.className = "error"
        yourExPassword.className = "form-control is-invalid"
        verifResponse[0] = 0
        Verify(verifResponse);
      } else {
        messageInfosExPassword.innerHTML = ""
        yourExPassword.className = "form-control"
        verifResponse[0] = 0
        Verify(verifResponse);
      }
    })

    yourNewPassword.addEventListener("focusout", function () {
      if (regexPassword.test(yourNewPassword.value) && yourNewPassword.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosPassword.innerHTML = "Format valide"
        messageInfosPassword.className = "noerror"
        yourNewPassword.className = "form-control is-valid"
        verifResponse[1] = 1
        Verify(verifResponse);
      } else if (!regexPassword.test(yourNewPassword.value) && yourNewPassword.value != "") {
        messageInfosPassword.innerHTML = "Mauvais format"
        messageInfosPassword.className = "error"
        yourNewPassword.className = "form-control is-invalid"
        verifResponse[1] = 0
        Verify(verifResponse);
      } else {
        messageInfosPassword.innerHTML = ""
        yourNewPassword.className = "form-control"
        verifResponse[1] = 0
        Verify(verifResponse);
      }
    })

    yourConfirmNewPassword.addEventListener("focusout", function () {
      if (regexPassword.test(yourConfirmNewPassword.value) && yourConfirmNewPassword.value == yourNewPassword.value && yourConfirmNewPassword.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosConfirmPassword.innerHTML = "Format valide"
        messageInfosConfirmPassword.className = "noerror"
        yourConfirmNewPassword.className = "form-control is-valid"
        verifResponse[2] = 1
        Verify(verifResponse);
      } else if (yourConfirmNewPassword.value != yourNewPassword.value && yourConfirmNewPassword.value != "") {
        messageInfosConfirmPassword.innerHTML = "Mot de passe différent du premier"
        messageInfosConfirmPassword.className = "error"
        yourConfirmNewPassword.className = "form-control is-invalid"
        verifResponse[2] = 0
        Verify(verifResponse);
      } else if (!regexPassword.test(yourConfirmNewPassword.value) && yourConfirmNewPassword.value != "") {
        messageInfosConfirmPassword.innerHTML = "Mauvais format"
        messageInfosConfirmPassword.className = "error"
        yourConfirmNewPassword.className = "form-control is-invalid"
        verifResponse[2] = 0
        Verify(verifResponse);
      } else {
        messageInfosConfirmPassword.innerHTML = ""
        yourConfirmNewPassword.className = "form-control"
        verifResponse[2] = 0
        Verify(verifResponse);
      }
    })