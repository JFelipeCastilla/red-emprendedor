const url = "http://localhost/red-emprendedor/interactive-map/back/api/entrepreneur/";

const entrepreneurService = {
    // Obtener todos los emprendedores
    getAllEntrepreneurs: async () => {
        try {
            const response = await fetch(`${url}get_all_entrepreneurs.php`);
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
    getEntrepreneursByDepartment: async (departmentId) => {
        try {
            const response = await fetch(`${url}get_entrepreneurs_by_department.php?department_id=${departmentId}`);
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
    createEntrepreneur: async (entrepreneur) => {
        try {
            const response = await fetch(`${url}create_entrepreneur.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(entrepreneur)
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
    updateEntrepreneur: async (id, entrepreneur) => {
        try {
            const response = await fetch(`${url}update_entrepreneur.php?id=${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(entrepreneur)
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
            const response = await fetch(`${url}delete_entrepreneur.php?id=${id}`, {
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

export default entrepreneurService;