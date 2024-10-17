import entrepreneurService from '../../services/entrepreneurService.js';

const loadEmails = async () => {
    try {
        const entrepreneurs = await entrepreneurService.getAllEntrepreneurs();
        const emailRecipients = document.getElementById('emailRecipients');

        entrepreneurs.forEach(entrepreneur => {
            const option = document.createElement('option');
            option.value = entrepreneur.entrepreneur_email;
            option.textContent = `${entrepreneur.entrepreneur_name} ${entrepreneur.entrepreneur_lastname} (${entrepreneur.entrepreneur_email})`;
            emailRecipients.appendChild(option);
        });
    } catch (error) {
        console.error("Error al cargar los emails:", error);
    }
};

document.addEventListener('DOMContentLoaded', loadEmails);
