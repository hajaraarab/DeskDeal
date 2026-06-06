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