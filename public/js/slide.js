const newElement = document.createElement("div");
let elt = document.getElementById("container");
elt.appendChild(newElement);

newElement.classList.add("text");
let interdiapoBis;

let arrayImages = [
  {
    source: "./public/images/kitten_img1.jpg",
    texte: "Elevage des Pompons: Bienvenue aux amoureux des Maine Coons"
  },
  { source: "./public/images/kitten_img2.jpg", texte: "" },
  { source: "./public/images/kitten_img3.jpg", texte: "" },
  { source: "./public/images/kitten_img4.jpg", texte: "" },
];

let i = 0; 
newElement.innerHTML = arrayImages[i].texte; 

let diapo = document.getElementById("diapo");
let time = 5000;
let playing = false;
// Creation Objet Diaporama

let diaporama = {
  launchAuto: function launchAuto() {
    var interdiapo = setInterval(diaporama.imageRight, time);
    interdiapoBis = interdiapo;
  },

  callRightClick: function rightClick() {
    let right = document.getElementsByClassName("semicircleright")[0];

    right.addEventListener("click", function () {
      diaporama.imageRight();
    });
  },

  imageRight: function changeImagesRight() {
    if (i < arrayImages.length - 1) {
      i++;
      diapo.src = arrayImages[i].source;
      newElement.innerHTML = arrayImages[i].texte; 
    } else {
      i = 0;
      diapo.src = arrayImages[i].source;
      newElement.innerHTML = arrayImages[i].texte;
    }
  },

  callLeftClick: function leftClick() {
    let left = document.getElementsByClassName("semicircleleft")[0];

    left.addEventListener("click", function () {
      diaporama.imageLeft();
    });
  },

  imageLeft: function changeImagesLeft() {
    if (i > 0) {
      i--;
      diapo.src = arrayImages[i].source;
      newElement.innerHTML = arrayImages[i].texte;
    } else {
      i = 3;
      diapo.src = arrayImages[i].source;
      newElement.innerHTML = arrayImages[i].texte;
    }
  },


  callPause: function makeAPause() {
    buttonPause = document.getElementById("pause_inside");
    buttonPlay = document.getElementById("play_inside");

    buttonPause.addEventListener("click", function () {
      if (playing === false) {
        clearInterval(interdiapoBis);
        interdiapoBis = 0;
        playing = true;
        buttonPause.style.visibility = "hidden";
        buttonPlay.style.visibility = "visible";
      } else {
        diaporama.launchAuto();
        playing = false;
        buttonPlay.style.visibility = "hidden";
        buttonPause.style.visibility = "visible";
      }
    });
    buttonPlay.addEventListener("click", function () {
      if (playing === false) {
        clearInterval(interdiapoBis);
        interdiapoBis = 0;
        playing = true;
        buttonPause.style.visibility = "hidden";
        buttonPlay.style.visibility = "visible";
      } else {
        playing = false;
        diaporama.launchAuto();

        buttonPlay.style.visibility = "hidden";
        buttonPause.style.visibility = "visible";
      }
    });
  },

  rightArrowKeyboard: function rightArrow() {
    window.addEventListener("keydown", function (clef) {
      if (clef.keyCode == "39") {
        clearInterval(interdiapoBis);
        diaporama.imageRight();
      }
    });
  },
  leftArrowKeyboard: function leftArrow() {
    window.addEventListener("keydown", function (clef) {
      if (clef.keyCode == "37") {
        clearInterval(interdiapoBis);
        diaporama.imageLeft();
      }
    });
  },
}; 
