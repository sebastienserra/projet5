var coatsSelect = document.getElementById("coats");

window.addEventListener("DOMContentLoaded", function (event) {
  displayCats(coatsSelect.value);
  console.log(coatsSelect.value);
});

coatsSelect.addEventListener("change", function (event) {
  displayCats(event.target.value);
});

function displayCats(coat) {
  var results = document.querySelector("#results");
  results.innerHTML = "";
  getCatByCoat(coat).then(
    // Resolve
    function (data) {
      data.forEach(function (cat) {
        var catElement = document.createElement("div");
        var path = "./uploads/" + cat.image;
        catElement.innerHTML =
          '<div id="contain_cat"><div id="cat_presentation">' +
          '<div id="cat_display"><div id="cat_picture"><img src="' +
          path +
          '"/>' +
          "</div>" +
          '<div id="cat_info">' +
          "<div> Name:" +
          cat.name +
          "</div>" +
          "<div> Couleur:" +
          cat.coat_color +
          "</div>" +
          "<div> Sexe:" +
          cat.gender +
          "</div>" +
          "<div> Naissance:" +
          cat.dob +
          "</div>" +
          "<div> Description:" +
          cat.description +
          "</div></div>" +
          "</div>" +
          "</div></div></div>";
        results.appendChild(catElement);
      });
    },
    // Reject
    function () {
      alert("ERROR");
    }
  );
}

function getCatByCoat(coat) {
  return new Promise(function (resolve, reject) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "?action=getCatByCoat&coat=" + coat);
    xhr.send(null);

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          console.log(xhr.response);
          resolve(JSON.parse(xhr.response)); // Par défault une DOMString
        } else {
          reject();
        }
      }
    };
  });
}
