document.addEventListener("DOMContentLoaded", function () {
    const tooltip = document.createElement("div");
    tooltip.classList.add("tooltip");
    document.body.appendChild(tooltip);

    const regions = document.querySelectorAll(".region");

    // Tooltip para mostrar el título de la región
    regions.forEach(region => {
        region.addEventListener("mouseover", function (event) {
            const title = this.getAttribute("title");
            tooltip.innerHTML = title;
            tooltip.classList.add("show");
        });

        region.addEventListener("mousemove", function (event) {
            tooltip.style.left = event.pageX + 15 + "px";
            tooltip.style.top = event.pageY + 15 + "px";
        });

        region.addEventListener("mouseout", function () {
            tooltip.classList.remove("show");
        });
    });

    

    // Mover el path y el texto al frente
    document.querySelectorAll('.map-container path').forEach(function (path) {
        path.addEventListener('mouseover', function () {
            this.parentNode.appendChild(this);

            const id = this.id;
            const text = document.querySelector(`.map-container text[data-path-id="${id}"]`);
            if (text) {
                this.parentNode.appendChild(text);
            }
        });

        path.addEventListener('mouseout', function () {
            this.parentNode.appendChild(this);

            const id = this.id;
            const text = document.querySelector(`.map-container text[data-path-id="${id}"]`);
            if (text) {
                this.parentNode.appendChild(text);
            }
        });
    });

    // Código botón celular
    document.getElementById("toggle-map").addEventListener("click", function () {
        const mapContainer = document.getElementById("map-container");
        if (mapContainer.style.display === "none" || mapContainer.style.display === "") {
            mapContainer.style.display = "block"; // Mostrar el mapa
        } else {
            mapContainer.style.display = "none"; // Ocultar el mapa
        }
    });

    // Inicialmente oculta el mapa en dispositivos móviles
    if (window.innerWidth < 768) {
        document.getElementById("map-container").style.display = "none";
    } else {
        document.getElementById("map-container").style.display = "block"; // Mostrar en pantallas grandes
    }


});