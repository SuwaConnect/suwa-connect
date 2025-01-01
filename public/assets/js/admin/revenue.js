// Example JavaScript for handling dynamic data

// Simulating transaction data (this would usually come from an API)
const transactions = [
    {id: 'TX1234', service: 'Consultation', amount: 'LKR 10,000', user: 'John Doe', provider: 'Dr. Silva', date: '2024-09-12 10:00 AM', status: 'Successful'},
    {id: 'TX1235', service: 'Lab Test', amount: 'LKR 5,000', user: 'Jane Doe', provider: 'Asiri Labs', date: '2024-09-11 11:00 AM', status: 'Pending'},
    {id: 'TX1236', service: 'Prescription Purchase', amount: 'LKR 3,000', user: 'Amara Perera', provider: 'XYZ Pharmacy', date: '2024-09-10 9:30 AM', status: 'Failed'},
];

// Function to populate transactions table
function populateTransactions() {
    const transactionTableBody = document.getElementById('transactionTableBody');
    transactions.forEach(transaction => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${transaction.id}</td>
            <td>${transaction.service}</td>
            <td>${transaction.amount}</td>
            <td>${transaction.user}</td>
            <td>${transaction.provider}</td>
            <td>${transaction.date}</td>
            <td>${transaction.status}</td>
        `;
        transactionTableBody.appendChild(row);
    });
}

// Call function to populate table on page load
window.onload = populateTransactions;
