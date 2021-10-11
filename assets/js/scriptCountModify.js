    const regexName = new RegExp(/^([a-zA-Zéèàê ]+)$/);
    const regexPostal = new RegExp("^[0-9]{1,10}$");
    const regexEmail = new RegExp("[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+");
    const button = document.getElementById("myButton");
    const regexCity = new RegExp(/^([a-zA-Zéèàê ]+)$/);


    //Partie concernant la création d'un compte


    lastName.addEventListener("focusout", function () {
      if (regexName.test(lastName.value) && lastName.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosName.innerHTML = "Format valide"
        messageInfosName.className = "noerror"
        lastName.className = "form-control is-valid"
      } else if (!regexName.test(lastName.value) && lastName.value != "") {
        messageInfosName.innerHTML = "Mauvais format"
        messageInfosName.className = "error"
        lastName.className = "form-control is-invalid"
      } else {
        messageInfosName.innerHTML = ""
        lastName.className = "form-control"
      }
    })

    firstName.addEventListener("focusout", function () {
      if (regexName.test(firstName.value) && firstName.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosFirstName.innerHTML = "Format valide"
        messageInfosFirstName.className = "noerror"
        firstName.className = "form-control is-valid"
      } else if (!regexName.test(firstName.value) && firstName.value != "") {
        messageInfosFirstName.innerHTML = "Mauvais format"
        messageInfosFirstName.className = "error"
        firstName.className = "form-control is-invalid"
      } else {
        messageInfosFirstName.innerHTML = ""
        firstName.className = "form-control"
      }
    })


    mail.addEventListener("focusout", function () {
      if (regexEmail.test(mail.value) && mail.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosEmail.innerHTML = "Format valide"
        messageInfosEmail.className = "noerror"
        mail.className = "form-control is-valid"
      } else if (!regexEmail.test(mail.value) && mail.value != "") {
        messageInfosEmail.innerHTML = "Mauvais format"
        messageInfosEmail.className = "error"
        mail.className = "form-control is-invalid"
      } else {
        messageInfosEmail.innerHTML = ""
        mail.className = "form-control"
      }
    })


    city.addEventListener("focusout", function () {
      if (regexCity.test(city.value) && city.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosCity.innerHTML = "Format valide"
        messageInfosCity.className = "noerror"
        city.className = "form-control is-valid"
      } else if (!regexCity.test(city.value) && city.value != "") {
        messageInfosCity.innerHTML = "Mauvais format"
        messageInfosCity.className = "error"
        city.className = "form-control is-invalid"
      } else {
        messageInfosCity.innerHTML = ""
        city.className = "form-control"
      }
    })

    zipCode.addEventListener("focusout", function () {
      if (regexPostal.test(zipCode.value) && zipCode.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosPostalCode.innerHTML = "Format valide"
        messageInfosPostalCode.className = "noerror"
        zipCode.className = "form-control is-valid"
      } else if (!regexPostal.test(zipCode.value) && zipCode.value != "") {
        messageInfosPostalCode.innerHTML = "Mauvais format"
        messageInfosPostalCode.className = "error"
        zipCode.className = "form-control is-invalid"
      } else {
        messageInfosPostalCode.innerHTML = ""
        zipCode.className = "form-control"
      }
    })