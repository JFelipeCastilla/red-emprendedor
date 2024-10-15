const url = "http://localhost/red-emprendedor/interactive-map/back/api/entrepreneurship/";

const entrepreneurshipService = {
    // Obtener todos los emprendedores
    getAllEntrepreneurs: async () => {
        try {
            const response = await fetch(`${url}get_all_entrepreneurships.php`);
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            if (!Array.isArray(data)) {
                throw new Error("La respuesta no es un array válido de emprendedores.");
            }
            return data;
        } catch (error) {
            console.error("API ERROR: OBTENER EMPRENDEDORES: " + error);
            throw error;
        }
    },

    // Obtener emprendedores por departamento
    getEntrepreneurshipsByDepartment: async (departmentId) => {
        try {
            const response = await fetch(`${url}get_entrepreneurships_by_department.php?department_id=${departmentId}`);
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            if (!Array.isArray(data)) {
                throw new Error("La respuesta no es un array válido de emprendedores.");
            }
            return data;
        } catch (error) {
            console.error("API ERROR: OBTENER EMPRENDEDORES POR DEPARTAMENTO: " + error);
            throw error;
        }
    },

    // Crear un nuevo emprendedor
    createEntrepreneurship: async (entrepreneurship) => {
        try {
            const response = await fetch(`${url}create_entrepreneurship.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(entrepreneurship)
            });
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("API ERROR: CREAR EMPRENDEDOR: " + error);
            throw error;
        }
    },

    // Actualizar un emprendedor
    updateEntrepreneurship: async (id, entrepreneurship) => {
        try {
            const response = await fetch(`${url}update_entrepreneurship.php?id=${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(entrepreneurship)
            });
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("API ERROR: ACTUALIZAR EMPRENDEDOR: " + error);
            throw error;
        }
    },

    // Eliminar un emprendedor
    deleteEntrepreneur: async (id) => {
        try {
            const response = await fetch(`${url}delete_entrepreneurship.php?id=${id}`, {
                method: 'DELETE'
            });
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("API ERROR: ELIMINAR EMPRENDEDOR: " + error);
            throw error;
        }
    },
};

export default entrepreneurshipService;