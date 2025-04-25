// Toggle the details of the report card
function toggleDetails(id) {
    const details = document.getElementById(id);
    const button = details.previousElementSibling.querySelector('.expand-btn');

    if (details.style.display === "none") {
        details.style.display = "block";
        button.textContent = "−"; // Change button to collapse
    } else {
        details.style.display = "none";
        button.textContent = "+"; // Change button to expand
    }
}

// Filter reports based on search input
function filterCards() {
    const searchInput = document.getElementById("searchInput").value.toLowerCase();
    const cards = document.querySelectorAll(".report-card");

    cards.forEach(card => {
        const searchText = card.getAttribute("data-search").toLowerCase();
        if (searchText.includes(searchInput)) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}
