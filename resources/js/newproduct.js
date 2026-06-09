document.addEventListener('DOMContentLoaded', function() {
    // Price field disable logic
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

    // Image preview logic
    const imageUploadInput = document.getElementById('image-upload');
    const imagePreviewContainer = document.getElementById('image-preview');

    if (imageUploadInput && imagePreviewContainer) {
        imageUploadInput.addEventListener('change', function(e) {
            imagePreviewContainer.innerHTML = ''; // Clear previous previews

            const files = e.target.files;
            
            if (files.length > 0) {
                Array.from(files).forEach((file, index) => {
                    const reader = new FileReader();
                    
                    reader.onload = function(event) {
                        const previewWrapper = document.createElement('div');
                        previewWrapper.classList.add('preview-image-wrapper');
                        
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.classList.add('preview-image');
                        
                        const deleteBtn = document.createElement('button');
                        deleteBtn.type = 'button';
                        deleteBtn.classList.add('delete-preview-btn');
                        deleteBtn.innerHTML = '&times;';
                        deleteBtn.setAttribute('data-index', index);
                        
                        deleteBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            previewWrapper.remove();
                            
                            // Update the file input to remove the deleted file
                            const dataTransfer = new DataTransfer();
                            const remainingFiles = Array.from(imageUploadInput.files).filter((_, i) => i !== index);
                            
                            remainingFiles.forEach(file => {
                                dataTransfer.items.add(file);
                            });
                            
                            imageUploadInput.files = dataTransfer.files;
                        });
                        
                        previewWrapper.appendChild(img);
                        previewWrapper.appendChild(deleteBtn);
                        imagePreviewContainer.appendChild(previewWrapper);
                    };
                    
                    reader.readAsDataURL(file);
                });
            }
        });
    }

    const companyLocationCheckbox = document.getElementById('use_company_location');
    const locationInput = document.getElementById('location');

    if (companyLocationCheckbox && locationInput) {

        companyLocationCheckbox.addEventListener('change', function() {

            if (this.checked) {
                locationInput.value = locationInput.dataset.companyCity;
            } else {
                locationInput.value = '';
            }

        });

    }
});

const deleteImagesInput = document.getElementById('delete-images-input');

let imagesToDelete = [];

document.addEventListener('click', function(e) {

    if (e.target.classList.contains('delete-existing-btn')) {

        const wrapper = e.target.closest('.existing-image');
        const imageId = wrapper.dataset.imageId;

        imagesToDelete.push(imageId);

        deleteImagesInput.value = imagesToDelete.join(',');

        wrapper.remove();
    }

});

