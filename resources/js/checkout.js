// Hide all transport outputs by default
document.querySelectorAll('.transport-output').forEach(output => {
    output.style.display = 'none';
});

document.querySelectorAll('.transport-option').forEach(option => {

    option.addEventListener('click', () => {

        document.querySelectorAll('.transport-option').forEach(el => {
            el.classList.remove('selected');
        });

        option.classList.add('selected');

        // Hide all transport outputs
        document.querySelectorAll('.transport-output').forEach(output => {
            output.style.display = 'none';
        });

        // Show the corresponding transport output
        if (option.classList.contains('deliveryservice')) {
            document.querySelector('.transport-output.deliveryservice').style.display = 'flex';
        } else if (option.classList.contains('selfpickup')) {
            document.querySelector('.transport-output.selfpickup').style.display = 'flex';
        }
    });

});


// DELIVERY FORM
document.getElementById('delivery-form').addEventListener('submit', function(e) {

    const address = this.querySelector('input[name="deliveryadres"]');

    const field = address.closest('.form-field');
    const label = field.querySelector('label');
    const errorMessage = field.querySelector('.error-message');

    // reset errors
    field.classList.remove('error');
    label.classList.remove('error');
    errorMessage.textContent = '';

    if (address.value.trim() === '') {

        field.classList.add('error');
        label.classList.add('error');

        errorMessage.textContent = 'Vul een leveringsadres in.';

        return;
    }

    showConfirmation();
});


// PICKUP FORM
document.getElementById('pickup-form').addEventListener('submit', function(e) {


    const date = this.querySelector('input[name="pickup-date"]');
    const time = this.querySelector('input[name="pickup_time"]');

    const dateField = date.closest('.form-field');
    const timeField = time.closest('.form-field');

    const dateLabel = dateField.querySelector('label');
    const timeLabel = timeField.querySelector('label');

    const dateError = dateField.querySelector('.error-message');
    const timeError = timeField.querySelector('.error-message');

    let hasError = false;

    // reset
    dateField.classList.remove('error');
    timeField.classList.remove('error');

    dateLabel.classList.remove('error');
    timeLabel.classList.remove('error');

    dateError.textContent = '';
    timeError.textContent = '';

    // datum leeg
    if (date.value.trim() === '') {

        dateField.classList.add('error');
        dateLabel.classList.add('error');

        dateError.textContent = 'Kies een datum.';

        hasError = true;
    }

    // tijd leeg
    if (time.value.trim() === '') {

        timeField.classList.add('error');
        timeLabel.classList.add('error');

        timeError.textContent = 'Kies een tijdstip.';

        hasError = true;
    }

    // datum in verleden
    if (date.value !== '') {

        const selectedDate = new Date(date.value);
        const today = new Date();

        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {

            dateField.classList.add('error');
            dateLabel.classList.add('error');

            dateError.textContent =
                'De gekozen datum ligt in het verleden.';

            hasError = true;
        }
    }

    if (hasError) {
        return;
    }

    showConfirmation();
});


// Verwijder errors zodra gebruiker begint te typen
document.querySelectorAll('.form-field input').forEach(input => {

    input.addEventListener('input', function() {

        const field = this.closest('.form-field');

        if (!field) return;

        const label = field.querySelector('label');
        const errorMessage = field.querySelector('.error-message');

        field.classList.remove('error');

        if (label) {
            label.classList.remove('error');
        }

        if (errorMessage) {
            errorMessage.textContent = '';
        }

    });

});

document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.transport-output').forEach(output => {
        output.style.display = 'none';
    });

    const selectedRadio = document.querySelector(
        'input[name="delivery_method"]:checked'
    );

    if (selectedRadio) {

        const option = selectedRadio.closest('.transport-option');

        option.classList.add('selected');

        if (selectedRadio.value === 'delivery') {

            document.querySelector(
                '.transport-output.deliveryservice'
            ).style.display = 'flex';

        } else {

            document.querySelector(
                '.transport-output.selfpickup'
            ).style.display = 'flex';
        }
    }

});