const stepOne = document.querySelector('.step-one');
const stepTwo = document.querySelector('.step-two');

// Volgende knop
document.getElementById('next-step').addEventListener('click', () => {

    let valid = true;

    document
        .querySelectorAll('.step-one input')
        .forEach(input => {

            const field = input.closest('.form-field');

            if (!input.checkValidity()) {
                field.classList.add('error');
                valid = false;
            } else {
                field.classList.remove('error');
            }

        });

    if (!valid) {
        document
            .querySelector('.step-one input:not(:valid)')
            ?.reportValidity();

        return;
    }

    stepOne.style.display = 'none';
    stepTwo.style.display = 'block';

});

// Vorige knop
document.getElementById('prev-step').addEventListener('click', () => {
    stepTwo.style.display = 'none';
    stepOne.style.display = 'block';
});

// Live validatie
document.querySelectorAll('.form-field input').forEach(input => {

    // Bij verlaten van het veld
    input.addEventListener('blur', () => {

        const field = input.closest('.form-field');

        if (!input.checkValidity()) {
            field.classList.add('error');
        } else {
            field.classList.remove('error');
        }

    });

    // Terwijl gebruiker typt
    input.addEventListener('input', () => {

        const field = input.closest('.form-field');

        if (input.checkValidity()) {
            field.classList.remove('error');
        }

    });

});