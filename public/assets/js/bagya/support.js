// Sample tickets data
const tickets = [
    { id: '#1234', category: 'System', user: 'John Doe', date: 'Sep 19, 2024', priority: 'High', status: 'Open', assignedTo: 'Agent A' },
    { id: '#1235', category: 'Billing', user: 'Jane Doe', date: 'Sep 20, 2024', priority: 'Medium', status: 'In-Progress', assignedTo: 'Agent B' },
    { id: '#1236', category: 'User Complaint', user: 'Mark Smith', date: 'Sep 21, 2024', priority: 'Low', status: 'Resolved', assignedTo: 'Agent C' }
];

// Populate ticket list
window.onload = () => {
    const ticketList = document.getElementById('ticket-list');
    tickets.forEach(ticket => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${ticket.id}</td>
            <td>${ticket.category}</td>
            <td>${ticket.user}</td>
            <td>${ticket.date}</td>
            <td>${ticket.priority}</td>
            <td>${ticket.status}</td>
            <td>${ticket.assignedTo}</td>
            <td><button onclick="viewTicket('${ticket.id}')">View</button></td>
        `;
        ticketList.appendChild(row);
    });
};

// Function to view ticket details (For now, it will log the ticket ID)
function viewTicket(ticketId) {
    console.log(`Viewing details for ticket: ${ticketId}`);
}
