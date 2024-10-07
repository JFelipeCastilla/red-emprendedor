import departmentService from '../../services/departmentService.js';
import townshipService from '../../services/townshipService.js';

const departmentSelect = document.getElementById('departmentSelect');
const townshipSelect = document.getElementById('townshipSelect');
const loadingMessage = document.getElementById('loadingMessage');
const errorMessage = document.getElementById('errorMessage');

async function loadDepartments() {
    try {
        const departments = await departmentService.getAllDepartments();
        departments.forEach(department => {
            const option = document.createElement('option');
            option.value = department.department_id;
            option.textContent = department.department_name;
            departmentSelect.appendChild(option);
        });
    } catch (error) {
        errorMessage.textContent = 'Error al cargar los departamentos: ' + error.message;
    }
}

departmentSelect.addEventListener('change', async () => {
    const departmentId = departmentSelect.value;
    townshipSelect.innerHTML = '<option value="">Selecciona un municipio</option>';
    townshipSelect.style.display = 'none';
    document.getElementById('fetchButton').style.display = 'none';

    if (departmentId) {
        loadingMessage.style.display = 'block';

        try {
            const townships = await townshipService.getTownshipsByDepartment(departmentId);
            townships.forEach(township => {
                const option = document.createElement('option');
                option.value = township.township_id;
                option.textContent = township.township_name;
                townshipSelect.appendChild(option);
            });
            townshipSelect.style.display = 'block';
            document.getElementById('fetchButton').style.display = 'block'; 
        } catch (error) {
            errorMessage.textContent = 'Error al cargar los municipios: ' + error.message;
        } finally {
            loadingMessage.style.display = 'none';
        }
    }
});

loadDepartments();
