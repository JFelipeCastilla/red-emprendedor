import productService from '../../services/departmentService.js';

// Función para renderizar productos por departamento
const renderProductsByDepartment = (departmentName) => {
    productService.getEntrepreneursWithDepartmentsAndProducts()
    .then(products => {
        // Filtrar productos por el nombre del departamento
        const filteredProducts = products.filter(product => product.department_name === departmentName);

        const productContainer = document.getElementById('product-container');
        productContainer.innerHTML = ''; // Limpiar el contenedor

        if (filteredProducts.length > 0) {
            filteredProducts.forEach(product => {
                const productElement = document.createElement('div');
                productElement.classList.add('product-item');

                const imgElement = document.createElement('img');
                imgElement.src = `http://localhost/red-emprendedor/interactive-map/back/api/uploads/${product.product_image}`;
                imgElement.alt = product.product_name;

                const nameElement = document.createElement('h3');
                nameElement.textContent = product.product_name;

                const descriptionElement = document.createElement('p');
                descriptionElement.textContent = `Descripción: ${product.product_description}`;

                const innovationElement = document.createElement('p');
                innovationElement.textContent = `Innovación: ${product.product_innovation}`;

                const entrepreneurElement = document.createElement('p');
                entrepreneurElement.textContent = `Emprendedor: ${product.entrepreneur_name}`;

                const departmentElement = document.createElement('p');
                departmentElement.textContent = `Departamento: ${product.department_name}`;

                productElement.appendChild(imgElement);
                productElement.appendChild(nameElement);
                productElement.appendChild(descriptionElement);
                productElement.appendChild(innovationElement);
                productElement.appendChild(entrepreneurElement);
                productElement.appendChild(departmentElement);

                productContainer.appendChild(productElement);
            });
        } else {
            productContainer.innerHTML = '<p>No hay productos disponibles para este departamento.</p>';
        }
    })
    .catch(error => {
        console.error("Error al obtener los productos:", error);
    });
};

// Agregar eventos de clic a cada path en el mapa
const paths = document.querySelectorAll('#map-container path');
paths.forEach(path => {
    path.addEventListener('click', (event) => {
        const departmentName = event.target.getAttribute('title');
        renderProductsByDepartment(departmentName);
    });
});
