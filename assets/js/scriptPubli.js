
let verifPublication = [0,0,0,0,0,0];
const validPublication = document.getElementById("validPublication");


    //Partie concernant la publication

    function VerifyPubli(params) {
        if (!params.includes(0)) {
          validPublication.disabled = false
        } else {validPublication.disabled = true}
      }
       
      VerifyPubli(verifPublication);
  
      yourTitle.addEventListener("focusout", function () {
        if (yourTitle.value != "") {
            verifPublication [0] = 1
          VerifyPubli(verifPublication);
        }else {verifPublication [0] = 0
            VerifyPubli(verifPublication);}
      }) 

      yourCategory.addEventListener("focusout", function () {
        if (yourCategory.value != "") {
            verifPublication [1] = 1
          VerifyPubli(verifPublication);
        }else {verifPublication [1] = 0
            VerifyPubli(verifPublication);}
      }) 

      yourState.addEventListener("focusout", function () {
        if (yourState.value != "") {
            verifPublication [2] = 1
          VerifyPubli(verifPublication);
        }else {verifPublication [2] = 0
            VerifyPubli(verifPublication);}
      }) 


      yourBuyDate.addEventListener("focusout", function () {
        if (yourBuyDate.value != "") {
            verifPublication [3] = 1
          VerifyPubli(verifPublication);
        }else {verifPublication [3] = 0
            VerifyPubli(verifPublication);}
      }) 

      yourPrice.addEventListener("focusout", function () {
        if (yourPrice.value != "") {
            verifPublication [4] = 1
          VerifyPubli(verifPublication);
        }else {verifPublication [4] = 0
            VerifyPubli(verifPublication);}
      }) 

      youGive.addEventListener("focusout", function () {
        if (youGive.value != "") {
            verifPublication [4] = 1
          VerifyPubli(verifPublication);
        }else {verifPublication [4] = 0
            VerifyPubli(verifPublication);}
      }) 

      yourDescription.addEventListener("focusout", function () {
        if (yourDescription.value != "") {
            verifPublication [5] = 1
          VerifyPubli(verifPublication);
        }else {verifPublication [5] = 0
            VerifyPubli(verifPublication);}
      }) 


      var slider = document.getElementById("yourQuantity");
      var output = document.getElementById("resultRange");
      output.innerHTML = slider.value; 


      slider.oninput = function() {
        output.innerHTML = this.value;
      } 


//preview de l'upload de l'image 1
    fileToUpload.addEventListener("change", function () {
      let input = this;
      let oFReader = new FileReader(); // on créé un nouvel objet FileReader
      oFReader.readAsDataURL(this.files[0]);
      oFReader.onload = function (oFREvent) {
        imgPreview.setAttribute('src', oFREvent.target.result);
      };
    })

    //preview de l'upload de l'image 2
    fileToUpload2.addEventListener("change", function () {
      let input = this;
      let oFReader = new FileReader(); // on créé un nouvel objet FileReader
      oFReader.readAsDataURL(this.files[0]);
      oFReader.onload = function (oFREvent) {
        imgPreview2.setAttribute('src', oFREvent.target.result);
      };
    })

    //preview de l'upload de l'image 3
    fileToUpload3.addEventListener("change", function () {
      let input = this;
      let oFReader = new FileReader(); // on créé un nouvel objet FileReader
      oFReader.readAsDataURL(this.files[0]);
      oFReader.onload = function (oFREvent) {
        imgPreview3.setAttribute('src', oFREvent.target.result);
      };
    })