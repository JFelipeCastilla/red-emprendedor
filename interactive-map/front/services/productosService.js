const url = "http://localhost/red-emprendedor/interactive-map/back/api/product/";

const productService = {
    // Obtener todos los productos
    getAllProducts: async () => {
        try {
            const response = await fetch(`${url}get_all_products.php`);
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            if (!Array.isArray(data)) {
                throw new Error("La respuesta no es un array válido de productos.");
            }
            return data;
        } catch (error) {
            console.error("API ERROR: OBTENER PRODUCTOS: " + error);
            throw error;
        }
    },

    // Crear un nuevo producto
    createProduct: async (product) => {
        try {
            const response = await fetch(`${url}create_product.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(product)
            });
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("API ERROR: CREAR PRODUCTO: " + error);
            throw error;
        }
    },

    // Actualizar un producto
    updateProduct: async (id, product) => {
        try {
            const response = await fetch(`${url}update_product.php?id=${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(product)
            });
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("API ERROR: ACTUALIZAR PRODUCTO: " + error);
            throw error;
        }
    },

    // Eliminar un producto
    deleteProduct: async (id) => {
        try {
            const response = await fetch(`${url}delete_product.php?id=${id}`, {
                method: 'DELETE'
            });
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("API ERROR: ELIMINAR PRODUCTO: " + error);
            throw error;
        }
    },
};

export default productService;
