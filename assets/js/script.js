    const regexName = new RegExp(/^([a-zA-Z ]+)$/);
    const regexPostal = new RegExp("^[0-9]{1,10}$");
    const regexEmail = new RegExp("[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+");
    const button = document.getElementById("myButton");
    const regexCity = new RegExp(/^([a-zA-Z ]+)$/);
    const regexPassword = new RegExp(/^([a-zA-Z ]+)$/); //a modifier
    
    

    // button.addEventListener("click", function () {
    //   if (yourName.value == "") {
    //     console.log('popo')
    //     messageInfosProb.innerHTML = "Veuillez remplir tous les champs" 
    //   } else {
    //     renvoisurcpt.innerHTML = `<form action="moncompte.php" method="post">`
    //   }
    // })



    yourName.addEventListener("focusout", function () {
      if (!regexName.test(yourName.value) && yourName.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosName.innerHTML = "Mauvais format" 
        messageInfosName.className = "error"
        yourName.className = "form-control is-invalid"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosName.innerHTML = ""
        messageInfosName.classList.remove("error")
        yourName.className = "form-control"
        button.disabled = false
      }
    })
    
    yourFirstName.addEventListener("focusout", function () {
      if (!regexName.test(yourFirstName.value) && yourFirstName.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosFirstName.innerHTML = "Mauvais format"
        messageInfosFirstName.className = "error"
        yourFirstName.className = "form-control is-invalid"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosFirstName.innerHTML = ""
        messageInfosFirstName.classList.remove("error")
        yourFirstName.className = "form-control"
        button.disabled = false
      }
    })
    
    yourCity.addEventListener("focusout", function () {
      if (!regexCity.test(yourCity.value) && yourCity.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosCity.innerHTML = "Mauvais format"
        messageInfosCity.className = "error"
        yourCity.className = "form-control is-invalid"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosCity.innerHTML = ""
        messageInfosCity.classList.remove("error")
        yourCity.className = "form-control"
        button.disabled = false
      }
    })

    yourPostalCode.addEventListener("focusout", function () {
      if (!regexPostal.test(yourPostalCode.value) && yourPostalCode.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosPostalCode.innerHTML = "Mauvais format"
        messageInfosPostalCode.className = "error"
        yourPostalCode.className = "form-control is-invalid"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosPostalCode.innerHTML = ""
        messageInfosPostalCode.classList.remove("error")
        yourPostalCode.className = "form-control"
        button.disabled = false
      }
    })

    
    yourEmail.addEventListener("focusout", function () {
      if (!regexEmail.test(yourEmail.value) && yourEmail.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosEmail.innerHTML = "Mauvais format"
        messageInfosEmail.className = "error"
        yourEmail.className = "form-control is-invalid"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosEmail.innerHTML = ""
        messageInfosEmail.classList.remove("error")
        yourEmail.className = "form-control"
        button.disabled = false
      }
    })

    yourPassword.addEventListener("focusout", function () {
      if (!regexPassword.test(yourPassword.value) && yourPassword.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosPassword.innerHTML = "Mauvais format"
        messageInfosPassword.className = "error"
        yourPassword.className = "form-control is-invalid"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosPassword.innerHTML = ""
        messageInfosPassword.classList.remove("error")
        yourPassword.className = "form-control"
        button.disabled = false
      }
    })

    yourConfirmPassword.addEventListener("focusout", function () {
      if (!regexPassword.test(yourConfirmPassword.value) && yourConfirmPassword.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosConfirmPassword.innerHTML = "Mauvais format"
        messageInfosConfirmPassword.className = "error"
        yourConfirmPassword.className = "form-control is-invalid"
        button.disabled = true
      } if (yourConfirmPassword.value != yourPassword.value) {
        messageInfosConfirmPassword.innerHTML = "Mot de passe différent du premier"
        messageInfosConfirmPassword.className = "error"
        yourConfirmPassword.className = "form-control is-invalid"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosConfirmPassword.innerHTML = ""
        messageInfosConfirmPassword.classList.remove("error")
        yourConfirmPassword.className = "form-control"
        button.disabled = false
      }
    })