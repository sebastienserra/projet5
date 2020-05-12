var coatsSelect = document.getElementById("coats");

window.addEventListener("DOMContentLoaded", function (event) {
    displayCats(coatsSelect.value)
});

coatsSelect.addEventListener('change', function (event) {
    displayCats(event.target.value)
})

function displayCats(coat) {
    var results = document.querySelector('#results');
    results.innerHTML = '';
    getCatByCoat(coat).then(
        // Resolve
        function (data) {
            data.forEach(function (cat) {
                var catElement = document.createElement("div");
                catElement.innerHTML = '<div>' +
                    '<div>Nom: </div> <div>' + cat.name + '</div>' +
                    '</div>'
                results.appendChild(catElement)
            })
        },
        // Reject
        function(){
            alert('ERROR')
        })
}

function getCatByCoat(coat) {
    return new Promise(function (resolve, reject) {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "?action=getCatByCoat&coat=" + coat);
        xhr.send(null);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if(xhr.status === 200){
                    resolve(JSON.parse(xhr.response)); // Par défault une DOMString
                } else {
                    reject()
                }
            }
        }
    })
}
