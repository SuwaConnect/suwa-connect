document.addEventListener("DOMContentLoaded", () => {
    const doctorSearch = document.getElementById("doctor-search");
    const dropdownOptions = document.querySelector(".dropdown-options");
    const dropdown = document.querySelector(".dropdown");

    // Toggle dropdown
    doctorSearch.addEventListener("focus", () => {
        dropdown.classList.add("open");
    });

    doctorSearch.addEventListener("input", (e) => {
        const searchValue = e.target.value.toLowerCase();
        const items = dropdownOptions.querySelectorAll(".dropdown-item");
        items.forEach((item) => {
            if (item.textContent.toLowerCase().includes(searchValue)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", (e) => {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove("open");
        }
    });

    // Select dropdown item
    dropdownOptions.addEventListener("click", (e) => {
        if (e.target.classList.contains("dropdown-item")) {
            doctorSearch.value = e.target.textContent;
            dropdown.classList.remove("open");
        }
    });

    
});
