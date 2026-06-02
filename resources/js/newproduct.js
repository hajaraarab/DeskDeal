document.addEventListener('DOMContentLoaded', function() {
    const freeProductCheckbox = document.getElementById('free_product');
    const priceInput = document.getElementById('price');
    const priceFormField = priceInput?.closest('.form-field');

    if (freeProductCheckbox && priceInput && priceFormField) {
        // Set initial state: disable price input if checkbox is already checked
        if (freeProductCheckbox.checked) {
            priceInput.disabled = true;
            priceFormField.classList.add('disabled');
            priceInput.value = '';
        }

        // Listen for checkbox changes
        freeProductCheckbox.addEventListener('change', function() {
            priceInput.disabled = this.checked;
            
            if (this.checked) {
                priceFormField.classList.add('disabled');
                priceInput.value = '';
            } else {
                priceFormField.classList.remove('disabled');
            }
        });
    }
});
