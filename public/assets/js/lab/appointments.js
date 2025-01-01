document.addEventListener('DOMContentLoaded', function () {
    const appointmentsBody = document.getElementById('appointmentsBody');

    const appointments = [
        {
            patientName: "Amar Amarasinghe",
            doctorName: "Dr. Anil Perera",
            appointmentDateTime: "2024-09-22 10:00 AM",
            status: "Scheduled",
            consultationType: "In-person"
        },
        {
            patientName: "Kumari Silva",
            doctorName: "Dr. Nimal Samara",
            appointmentDateTime: "2024-09-23 2:00 PM",
            status: "Completed",
            consultationType: "Online"
        }
    ];

    function renderAppointments() {
        appointmentsBody.innerHTML = '';
        appointments.forEach(appointment => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${appointment.patientName}</td>
                <td>${appointment.doctorName}</td>
                <td>${appointment.appointmentDateTime}</td>
                <td>${appointment.status}</td>
                <td>${appointment.consultationType}</td>
                <td class="actions">
                    <button id="view" ${appointment.status === 'Completed' ? 'disabled' : ''}>View Details</button>
                    <button id="reschedule" ${appointment.status !== 'Scheduled' ? 'disabled' : ''}>Reschedule</button>
                    <button id="cancel" ${appointment.status !== 'Scheduled' ? 'disabled' : ''}>Cancel</button>
                </td>
            `;
            appointmentsBody.appendChild(row);
        });
    }

    renderAppointments();
});