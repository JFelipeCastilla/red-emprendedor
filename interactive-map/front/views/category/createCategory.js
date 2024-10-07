// createCategory.js
import categoryService from '../../services/categoryService.js';

const categoryForm = document.getElementById('category-form');
const categoryNameInput = document.getElementById('category-name');
const categoryEntrepreneurInput = document.getElementById('category-entrepreneur');
const categoryImageInput = document.getElementById('category-image');
const successMessage = document.getElementById('success-message');
const errorMessage = document.getElementById('error-message');

categoryForm.addEventListener('submit', async (event) => {
    event.preventDefault(); 

    const category = {
        category_name: categoryNameInput.value,
        category_entrepreneur: categoryEntrepreneurInput.value,
    };

    const imageFile = categoryImageInput.files[0];

    try {
        const result = await categoryService.createCategory(category, imageFile);
        successMessage.textContent = 'Categoría creada exitosamente: ' + result.category_name;
        errorMessage.textContent = '';
        categoryForm.reset(); 
    } catch (error) {
        errorMessage.textContent = 'Error al crear la categoría: ' + error.message;
        successMessage.textContent = '';
        console.log('Datos de la categoría:', category);
console.log('Archivo de imagen:', imageFile);

    }
});
