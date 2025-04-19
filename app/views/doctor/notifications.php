<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        
        
        <link rel="stylesheet" href="<?php echo URLROOT?>public/assets/css/noti.css">

        <title>Suwa-Connect</title>
    </head>

    <body> 

    <?php include  "navbarbhagya.php";?>

    <div class="main-content">
    <div class="main-container">
    <h1>Notifications</h1>
    <div class="notifications-section">
        <?php if (!empty($data['notifications'])): ?>
            <?php foreach ($data['notifications'] as $notification): ?>
                <div class="notification-card">
                    <h2 class="notification-title"><?= htmlspecialchars($notification->notification_type) ?></h2>
                    <p class="notification-message">
                        <?= htmlspecialchars($notification->message) ?>
                    </p>
                    <span class="notification-timestamp"><?= htmlspecialchars($notification->created_at) ?></span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-notifications">No notifications.</p>
        <?php endif; ?>
    </div>
</div>
  
</div>

        
        <script src="assets/js/appoimt.js"></script>
        <script src="<?php echo URLROOT;?>public/js/doctor/js/navbar.js"></script>

        <script>
                document.addEventListener('DOMContentLoaded', function() {
    // Mark single notification as read
    document.querySelectorAll('.mark-read-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const notificationCard = this.closest('.notification-card');
            const id = notificationCard.getAttribute('data-id');
            markAsRead(id);
        });
    });
    
    // Mark all notifications as read
    document.getElementById('mark-all-read-btn').addEventListener('click', function() {
        markAllAsRead();
    });
    
    // Delete notification
    document.querySelectorAll('.delete-notification-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const notificationCard = this.closest('.notification-card');
            const id = notificationCard.getAttribute('data-id');
            deleteNotification(id);
        });
    });
    
    function markAsRead(id) {
        fetch(`${URLROOT}/notifications/markAsRead/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const notificationCard = document.querySelector(`.notification-card[data-id="${id}"]`);
                notificationCard.classList.remove('unread');
                const markReadBtn = notificationCard.querySelector('.mark-read-btn');
                if (markReadBtn) markReadBtn.remove();
                updateNotificationCounter();
            }
        })
        .catch(error => {
            console.error('Error marking notification as read:', error);
        });
    }
    
    function markAllAsRead() {
        fetch(`${URLROOT}/notifications/markAsRead`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.notification-card.unread').forEach(function(card) {
                    card.classList.remove('unread');
                });
                document.querySelectorAll('.mark-read-btn').forEach(function(btn) {
                    btn.remove();
                });
                updateNotificationCounter();
            }
        })
        .catch(error => {
            console.error('Error marking all notifications as read:', error);
        });
    }
    
    function deleteNotification(id) {
        if (confirm('Are you sure you want to delete this notification?')) {
            fetch(`${URLROOT}/notifications/delete/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const notificationCard = document.querySelector(`.notification-card[data-id="${id}"]`);
                    notificationCard.remove();
                    
                    // Check if no notifications remain
                    const remainingNotifications = document.querySelectorAll('.notification-card');
                    if (remainingNotifications.length === 0) {
                        const notificationsSection = document.querySelector('.notifications-section');
                        notificationsSection.innerHTML = '<div class="empty-notification-message">You have no notifications.</div>';
                    }
                    
                    updateNotificationCounter();
                }
            })
            .catch(error => {
                console.error('Error deleting notification:', error);
            });
        }
    }
    
    function updateNotificationCounter() {
        fetch(`${URLROOT}/notifications/getUnread`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const counter = document.getElementById('notification-counter');
                if (counter) {
                    counter.textContent = data.count;
                    if (data.count === 0) {
                        counter.classList.add('hidden');
                    } else {
                        counter.classList.remove('hidden');
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error updating notification counter:', error);
        });
    }
    
    // For notification links if you have any
    document.querySelectorAll('.notification-action-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            const notificationCard = this.closest('.notification-card');
            const id = notificationCard.getAttribute('data-id');
            
            // If the notification is unread, mark it as read when clicking on action link
            if (notificationCard.classList.contains('unread')) {
                markAsRead(id);
            }
        });
    });
});
</script>

    </body>

    </html>

    