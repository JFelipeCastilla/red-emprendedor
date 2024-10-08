const url = "http://localhost/red-emprendedor/interactive-map/back/api/category/";

const categoryService = {
    getAllCategories: async () => {
        console.log(`${url}get_all_category.php`); 
        try {
            const response = await fetch(`${url}get_all_category.php`); 
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            if (!Array.isArray(data)) {
                throw new Error("La respuesta no es un array válido de categorías.");
            }
            return data;
        } catch (error) {
            console.error("API ERROR: OBTENER CATEGORIAS: " + error);
            throw error;
        }
    },

    createCategory: async (category, imageFile) => {
        try {
            const formData = new FormData();
            formData.append('category_name', category.category_name);
            formData.append('amount_entrepreneur', category.amount_entrepreneur); // Cambié 'category_entrepreneur' a 'amount_entrepreneur'
            formData.append('category_image', imageFile);
    
            const response = await fetch(`${url}create_category.php`, {
                method: 'POST',
                body: formData
            });
    
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("API ERROR: CREAR CATEGORIA: " + error);
            throw error;
        }
    },  
    

    updateCategory: async (id, category) => {
        try {
            const response = await fetch(`${url}update_category.php?id=${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(category)
            });
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("API ERROR: ACTUALIZAR CATEGIRIA: " + error);
            throw error;
        }
    },

    deleteCategory: async (id) => {
        try {
            const response = await fetch(`${url}delete_category.php?id=${id}`, {
                method: 'DELETE'
            });
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("API ERROR: ELIMINAR CATEGORIA: " + error);
            throw error;
        }
    },
};

export default categoryService;