document.addEventListener('DOMContentLoaded', () => {
    const categoryLinks = document.querySelectorAll('.category-link');
    const productListing = document.getElementById('product-listing');
    
    if (categoryLinks.length === 0 || !productListing) return;
    
    categoryLinks.forEach(link => {
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
});