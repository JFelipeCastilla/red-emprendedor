document.addEventListener("DOMContentLoaded", function () {
    const tooltip = document.createElement("div");
    tooltip.classList.add("tooltip");
    document.body.appendChild(tooltip);

    const regions = document.querySelectorAll(".region");
    const regionName = document.getElementById("region-name");
    const regionInfo = document.getElementById("region-info");

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

    // Gráfico circular con los datos corregidos
    const regiones = ['Antioquia', 'Cundinamarca', 'Valle del Cauca', 'Atlántico', 'Bolívar', 'Santander', 'Nariño', 'Boyacá', 'Córdoba', 'Magdalena', 'La Guajira', 'Cesar', 'Sucre', 'Chocó', 'Caldas', 'Risaralda', 'Quindío', 'Norte de Santander', 'Huila', 'Tolima', 'Arauca', 'Casanare', 'Meta', 'Vichada', 'Caquetá', 'Putumayo', 'Guainía', 'Guaviare', 'Vaupés', 'Amazonas', 'San Andrés, Providencia y Santa Catalina'];
    const entrepreneurshipCounts = [20000, 30000, 15000, 12000, 8000, 14000, 7000, 10000, 9000, 5000, 4000, 5000, 4000, 2000, 8000, 7000, 6000, 6000, 5000, 7000, 2000, 3000, 4000, 1000, 2000, 2000, 500, 1000, 500, 500, 3000]; // Ajusta estos números según tus datos

    const ctx = document.getElementById('entrepreneurshipChart').getContext('2d');
    const entrepreneurshipChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: regiones,  // Oculta las etiquetas
            datasets: [{
                data: entrepreneurshipCounts,
                backgroundColor: [
                    '#1e90ff', '#00bfff', '#add8e6', '#87cefa', '#4682b4',
                    '#4169e1', '#6495ed', '#5f9ea0', '#00ced1', '#20b2aa',
                    '#008b8b', '#008080', '#2e8b57', '#3cb371', '#66cdaa',
                    '#9acd32', '#32cd32', '#98fb98', '#f0e68c', '#eee8aa',
                    '#ffdab9', '#f08080', '#ff6347', '#ff4500', '#ff1493',
                    '#ff69b4', '#ff7f50', '#db7093', '#c71585', '#b22222',
                    '#800000'
                ],
                borderColor: '#ffffff',
                borderWidth: 0,
                hoverOffset: 10  // Efecto hover
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,  // Desactiva para que se ajuste al contenedor
            plugins: {
                legend: {
                    display: false  // Ocultamos la leyenda
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function (tooltipItem) {
                            const region = regiones[tooltipItem.dataIndex];
                            const count = entrepreneurshipCounts[tooltipItem.dataIndex];
                            return `${region}: ${count} emprendimientos`;
                        }
                    }
                }
            },
            layout: {
                padding: 0  // Elimina el padding adicional del gráfico
            }
        }
    });

 // Llamada a la API para obtener la información de los departamentos
    fetch("http://localhost/red-emprendedor/interactive-map/back/apps/department/get_all_departments.php")
    .then(response => {
        // Verifica si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json(); // Convierte la respuesta a JSON
    })
    .then(departments => {
        if (Array.isArray(departments)) {
            // Asumiendo que "regions" es una lista de elementos que representan las regiones en el DOM
            regions.forEach(region => {
                region.addEventListener("click", function () {
                    const selectedRegionName = this.getAttribute("title");

                    // Muestra el nombre de la región seleccionada
                    regionName.textContent = `Región: ${selectedRegionName}`;

                    // Encuentra el departamento correspondiente
                    const department = departments.find(dep =>
                        dep.department_name.toLowerCase().trim() === selectedRegionName.toLowerCase().trim()
                    );

                    // Verifica si el departamento existe y muestra la información
                    if (department) {
                        regionInfo.innerHTML = `
                            <div class="data-field"><strong>ID:</strong> ${department.department_id}</div>
                            <div class="data-field"><strong>Descripción:</strong> ${department.description}</div>
                            <div class="extra-info">
                                <div class="data-field"><strong>Emprendimientos:</strong> ${department.department_entrepreneur}</div>                        
                            </div>
                        `;
                    } else {
                        regionInfo.innerHTML = `<p>Información no disponible para esta región.</p>`;
                    }
                });
            });
        } else {
            console.error("La respuesta no es un array válido de departamentos.");
        }
    })
    .catch(error => {
        console.error("Error al obtener la información de la API:", error);
    });

});
