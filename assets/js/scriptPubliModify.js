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

var slider = document.getElementById("yourQuantity");
var output = document.getElementById("resultRange");
output.innerHTML = slider.value;


slider.oninput = function () {
  output.innerHTML = this.value;
}