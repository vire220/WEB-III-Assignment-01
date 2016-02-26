document.getElementById("brand-card__select").addEventListener("change", function () {
    document.getElementById("brand-card__info").innerText = this.value;
});

document.getElementById("continent-card__select").addEventListener("change", function(){
    var table = document.getElementById("continent-card__table");
    table.style.display = "none";
    var heading = document.getElementById("continent-card__h3");
    heading.style.display = "inline";
    heading.innerText = "Loading...";
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'continentData.php?id=' + this.value);
    xhr.send(null);
    
    xhr.onreadystatechange = function () {
        table.innerHTML = xhr.responseText;
        table.style.display = "table";
        heading.style.display = "none";
    };
    
    
    
});