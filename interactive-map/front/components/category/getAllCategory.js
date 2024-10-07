import categoryService from '../../services/categoryService.js';

const renderCategories = async () => {
    try {
        const categories = await categoryService.getAllCategories();
        
        const categoryContainer = document.getElementById('category-container');
        categoryContainer.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevas categorías

        categories.forEach(category => {
            const categoryElement = document.createElement('div');
            categoryElement.classList.add('category-item');

            // Crear el elemento de imagen
            const imgElement = document.createElement('img');
            imgElement.src = `http://localhost/red-emprendedor/interactive-map/back/api/uploads/${category.category_image}`;
            imgElement.alt = category.category_name;

            // Crear el elemento de nombre
            const nameElement = document.createElement('h3');
            nameElement.textContent = category.category_name;

            // Agregar elementos al contenedor
            categoryElement.appendChild(imgElement);
            categoryElement.appendChild(nameElement);
            categoryContainer.appendChild(categoryElement);
        });
    } catch (error) {
        console.error("Error al mostrar las categorías:", error);
    }
};

renderCategories();
