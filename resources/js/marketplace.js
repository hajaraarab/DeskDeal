document.addEventListener('DOMContentLoaded', () => {
    const categoryLinks = document.querySelectorAll('.category-link');
    const productListing = document.getElementById('product-listing');
    
    if (categoryLinks.length === 0 || !productListing) return;

    const searchInput = document.getElementById('search-input');

    // helper: perform fetch and replace product listing
    async function fetchAndRender(url) {
        try {
            const response = await fetch(url);
            const html = await response.text();
            productListing.innerHTML = html;
        } catch (err) {
            console.error('Marketplace fetch error', err);
        }
    }

    // debounce utility
    function debounce(fn, wait) {
        let t;
        return (...args) => {
            clearTimeout(t);
            t = setTimeout(() => fn(...args), wait);
        };
    }

    // When clicking a category, load that category and keep/clear search as desired
    categoryLinks.forEach(link => {
        link.addEventListener('click', async (e) => {
            e.preventDefault();

            document.querySelectorAll('.category-link')
                .forEach(l => l.classList.remove('active-category'));

            link.classList.add('active-category');

            // build URL: use the link href (already contains category param if any)
            const url = link.href;

            // clear search input so category-only results show
            if (searchInput) searchInput.value = '';

            await fetchAndRender(url);
        });
    });

    if (searchInput) {
        const doSearch = debounce(async (e) => {
            const q = e.target.value.trim();

            // find active category link to preserve category filter
            const activeCat = document.querySelector('.category-link.active-category');
            let url;

            if (activeCat) {
                try {
                    url = new URL(activeCat.href, window.location.origin);
                } catch (err) {
                    url = new URL('/marketplace/filter', window.location.origin);
                }
            } else {
                url = new URL('/marketplace/filter', window.location.origin);
            }

            if (q.length > 0) {
                url.searchParams.set('q', q);
            } else {
                url.searchParams.delete('q');
            }

            await fetchAndRender(url.href);
        }, 300);

        searchInput.addEventListener('input', doSearch);
    }
});