// Fetch appointment data and populate the table
function loadAppointments() {
    // Fetch appointment data from a server or API
    const appointments = [
      {
        patientName: 'Amar Amarasinghe',
        doctorName: 'Dr. Anil Perera',
        appointmentDate: '2024-09-22 10:00 AM',
        status: 'Scheduled',
        typeOfConsultation: 'In-person'
      },
      {
        patientName: 'Nicole Pereira',
        doctorName: 'Dr. Nikhil Fernandez',
        appointmentDate: '2024-09-23 11:30 AM',
        status: 'Completed',
        typeOfConsultation: 'Virtual'
      },
      // Add more appointment data as needed
    ];
  
    const tableBody = document.querySelector('.appointments-table tbody');
    tableBody.innerHTML = '';
  
    appointments.forEach(appointment => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${appointment.patientName}</td>
        <td>${appointment.doctorName}</td>
        <td>${appointment.appointmentDate}</td>
        <td>${appointment.status}</td>
        <td>${appointment.typeOfConsultation}</td>
        <td>
          <button class="view-details">View Details</button>
          <button class="reschedule">Reschedule</button>
          <button class="cancel">Cancel</button>
        </td>
      `;
      tableBody.appendChild(row);
    });
  }
  
  // Filter and sort appointments
  document.querySelectorAll('.filters select, .filters input').forEach(element => {
    element.addEventListener('change', () => {
      // Add your filter and sort logic here
      loadAppointments();
    });
  });
  
  // Handle create new appointment, export appointments, and other actions
  document.querySelector('.create-appointment').addEventListener('click', () => {
    // Add your create new appointment logic here
  });
  
  document.querySelector('.export-appointments').addEventListener('click', () => {
    // Add your export appointments logic here
  });
  
  // Initial load of appointments
  loadAppointments();