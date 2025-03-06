const URLROOT = 'http://localhost/newFramework';

document.addEventListener('DOMContentLoaded', function() {
    let selectedMedicines = new Set();
    const searchInput = document.getElementById('prescription-search');
    const searchResults = document.getElementById('search-results');
    const selectedItems = document.getElementById('selected-items');
    const hiddenInput = document.getElementById('selected-medicines-input');
    
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            searchResults.innerHTML = '';
            return;
        }
        
        // Debounce search to avoid too many requests
        searchTimeout = setTimeout(() => {
            fetch(`${URLROOT}/visitRecordController/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    data.forEach(medicine => {
                        if (!selectedMedicines.has(medicine.id)) {
                            const div = document.createElement('div');
                            div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                            div.textContent = `${medicine.name} - ${medicine.dosage}`;
                            div.onclick = () => selectMedicine(medicine);
                            searchResults.appendChild(div);
                        }
                    });
                });
        }, 300);
    });
    
    function selectMedicine(medicine) {
        if (!selectedMedicines.has(medicine.id)) {
            selectedMedicines.add(medicine.id);
            
            const div = document.createElement('div');
            div.className = 'selected-medicine p-2 mb-2 bg-gray-100 flex justify-between items-center';
            div.innerHTML = `
                <span>${medicine.name} - ${medicine.dosage}</span>
                <button type="button" class="text-red-500" onclick="removeMedicine(${medicine.id})">×</button>
            `;
            selectedItems.appendChild(div);
            
            updateHiddenInput();
            searchInput.value = '';
            searchResults.innerHTML = '';
        }
    }
    
    window.removeMedicine = function(id) {
        selectedMedicines.delete(id);
        updateHiddenInput();
        const items = selectedItems.getElementsByClassName('selected-medicine');
        for (let item of items) {
            if (item.querySelector('button').getAttribute('onclick') === `removeMedicine(${id})`) {
                item.remove();
                break;
            }
        }
    };
    
    function updateHiddenInput() {
        hiddenInput.value = Array.from(selectedMedicines).join(',');
    }
});