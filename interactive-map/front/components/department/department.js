import productService from '../../services/departmentService.js';

// Función para comprimir imágenes antes de mostrarlas
const compressImage = (imgSrc, callback) => {
    const img = new Image();
    img.src = imgSrc;

    img.onload = function () {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Tamaño máximo (ajustable según sea necesario)
        const maxWidth = 1000;
        const scaleSize = maxWidth / img.width;
        canvas.width = maxWidth;
        canvas.height = img.height * scaleSize;

        // Dibujar la imagen en el canvas y comprimirla
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        // Comprimir la imagen a un 80% de calidad
        canvas.toBlob(function (blob) {
            const compressedImgUrl = URL.createObjectURL(blob);
            callback(compressedImgUrl); // Devolver la URL de la imagen comprimida
        }, 'image/jpeg', 0.8);
    };
};

// Función para mostrar/ocultar el indicador de carga
const toggleLoadingIndicator = (isLoading) => {
    const loadingIndicator = document.getElementById('loading-indicator');
    if (isLoading) {
        loadingIndicator.style.display = 'block'; // Mostrar "Cargando..."
    } else {
        loadingIndicator.style.display = 'none'; // Ocultar "Cargando..."
    }
};

// Función para renderizar productos (todos o por departamento)
const renderProducts = (departmentName = null) => {
    toggleLoadingIndicator(true); // Mostrar el indicador de carga

    productService.getEntrepreneursWithDepartmentsAndProducts()
    .then(products => {
        const productContainer = document.getElementById('product-container');
        productContainer.innerHTML = ''; // Limpiar el contenedor

        let filteredProducts;

        // Si no se ha pasado un departamento, mostrar todos los productos
        if (departmentName) {
            filteredProducts = products.filter(product => product.department_name === departmentName);
        } else {
            filteredProducts = products; // Mostrar todos los productos
        }

        if (filteredProducts.length > 0) {
            const totalProducts = filteredProducts.length;
            let loadedProducts = 0;

            filteredProducts.forEach(product => {
                const productElement = document.createElement('div');
                productElement.classList.add('product-item');

                // Crear elementos de texto
                const nameElement = document.createElement('h3');
                nameElement.textContent = product.product_name;

                const innovationElement = document.createElement('p');
                innovationElement.textContent = `Innovación: ${product.product_innovation}`;

                const entrepreneurElement = document.createElement('p');
                entrepreneurElement.textContent = `Emprendimiento: ${product.entrepreneurship_name}`;

                const departmentElement = document.createElement('p');
                departmentElement.textContent = `Departamento: ${product.department_name}`;

                // Comprimir y agregar imagen
                const imgSrc = `http://localhost/red-emprendedor/interactive-map/back/api/uploads/${product.product_image}`;
                compressImage(imgSrc, (compressedImgUrl) => {
                    const imgElement = document.createElement('img');
                    imgElement.src = compressedImgUrl;
                    imgElement.alt = product.product_name;

                    // Añadir imagen y texto al contenedor del producto
                    productElement.appendChild(imgElement);
                    productElement.appendChild(nameElement);
                    productElement.appendChild(innovationElement);
                    productElement.appendChild(entrepreneurElement);
                    productElement.appendChild(departmentElement);

                    productContainer.appendChild(productElement);

                    // Aumentar el contador de productos cargados
                    loadedProducts++;

                    // Si todos los productos se han cargado, ocultar el indicador
                    if (loadedProducts === totalProducts) {
                        toggleLoadingIndicator(false); // Ocultar el indicador de carga
                    }
                });
            });
        } else {
            productContainer.innerHTML = '<p>No hay productos disponibles para este departamento.</p>';
            toggleLoadingIndicator(false); // Ocultar el indicador de carga
        }
    })
    .catch(error => {
        console.error("Error al obtener los productos:", error);
        toggleLoadingIndicator(false); // Ocultar el indicador de carga en caso de error
    });
};

// Agregar eventos de clic a cada path en el mapa
const paths = document.querySelectorAll('#map-container path');
paths.forEach(path => {
    path.addEventListener('click', (event) => {
        const departmentName = event.target.getAttribute('title');
        renderProducts(departmentName); // Mostrar productos filtrados por departamento
    });
});

// Renderizar todos los productos al cargar la página
renderProducts(); // Mostrar todos los productos inicialmente
