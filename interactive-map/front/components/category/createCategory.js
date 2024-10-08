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

    const entrepreneurValue = parseInt(categoryEntrepreneurInput.value, 10);

    // Validar que el valor de entrepreneurValue sea un número válido
    if (isNaN(entrepreneurValue) || entrepreneurValue < 0) {
        errorMessage.textContent = 'Por favor, introduce un número entero válido para la cantidad de emprendedores.';
        successMessage.textContent = '';
        return;
    }

    const category = {
        category_name: categoryNameInput.value,
        amount_entrepreneur: entrepreneurValue,
    };

    const imageFile = categoryImageInput.files[0];

    try {
        const result = await categoryService.createCategory(category, imageFile);

        // Verificar que el backend envió una respuesta JSON válida y que todo salió bien
        if (result && result.message && result.category_name) {
            successMessage.textContent = 'Categoría creada exitosamente: ' + result.category_name;
            errorMessage.textContent = '';
            categoryForm.reset();
        } else {
            throw new Error('Respuesta inesperada del servidor.');
        }
    } catch (error) {
        errorMessage.textContent = 'Error al crear la categoría: ' + error.message;
        successMessage.textContent = '';
        console.log('Datos de la categoría:', category);
        console.log('Archivo de imagen:', imageFile);
    }
});
