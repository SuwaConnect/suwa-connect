document.getElementById('applyFilters').addEventListener('click', () => {
    const dateRange = document.getElementById('dateRange').value;
    const notificationType = document.getElementById('notificationType').value;
    const priority = document.getElementById('priority').value;
    const status = document.getElementById('status').value;

    console.log(`Filters applied: 
        Date Range: ${dateRange}, 
        Type: ${notificationType}, 
        Priority: ${priority}, 
        Status: ${status}`
    );
});

document.querySelectorAll('.mark-read').forEach(button => {
    button.addEventListener('click', (e) => {
        const notification = e.target.closest('li');
        notification.style.backgroundColor = '#e0ffe0';
        e.target.disabled = true;
        e.target.innerText = 'Read';
    });
});

document.querySelectorAll('.archive').forEach(button => {
    button.addEventListener('click', (e) => {
        const notification = e.target.closest('li');
        document.getElementById('archivedList').appendChild(notification);
        e.target.remove();
    });
});

document.querySelectorAll('.delete').forEach(button => {
    button.addEventListener('click', (e) => {
        const notification = e.target.closest('li');
        notification.remove();
    });
});
