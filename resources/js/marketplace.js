document.querySelectorAll('.category-link').forEach(link => {
    link.addEventListener('click', async (e) => {
        e.preventDefault();

        document.querySelectorAll('.category-link')
            .forEach(l => l.classList.remove('active-category'));

        link.classList.add('active-category');

        const response = await fetch(link.href);
        const html = await response.text();

        document.getElementById('product-listing').innerHTML = html;
    });
});