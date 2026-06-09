document.addEventListener('DOMContentLoaded', () => {
    const categoryLinks = document.querySelectorAll('.category-link');
    const productListing = document.getElementById('product-listing');
    const searchInput = document.getElementById('search-input');
    const filterButton = document.getElementById('filter-button');
    const filterPopup = document.getElementById('province-filter-popup');
    const provinceSelect = document.getElementById('province-select');
    const applyProvinceFilterBtn = document.getElementById('apply-province-filter');

    if (categoryLinks.length === 0 || !productListing) return;

    async function fetchAndRender(url) {
        try {
            const response = await fetch(url);
            const html = await response.text();
            productListing.innerHTML = html;
        } catch (err) {
            console.error('Marketplace fetch error', err);
        }
    }

    function debounce(fn, wait) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => fn(...args), wait);
        };
    }

    function buildFilterUrl() {
        const activeCategoryLink = document.querySelector('.category-link.active-category');
        let url;

        if (activeCategoryLink) {
            try {
                url = new URL(activeCategoryLink.href, window.location.origin);
            } catch (err) {
                url = new URL('/marketplace/filter', window.location.origin);
            }
        } else {
            url = new URL('/marketplace/filter', window.location.origin);
        }

        if (searchInput) {
            const q = searchInput.value.trim();
            if (q.length > 0) {
                url.searchParams.set('q', q);
            } else {
                url.searchParams.delete('q');
            }
        }

        if (provinceSelect) {
            const province = provinceSelect.value;
            if (province.length > 0) {
                url.searchParams.set('province', province);
            } else {
                url.searchParams.delete('province');
            }
        }

        return url.href;
    }

    categoryLinks.forEach(link => {
        link.addEventListener('click', async (e) => {
            e.preventDefault();

            document.querySelectorAll('.category-link')
                .forEach(l => l.classList.remove('active-category'));

            link.classList.add('active-category');

            if (searchInput) searchInput.value = '';

            const url = new URL(link.href, window.location.origin);
            if (provinceSelect && provinceSelect.value) {
                url.searchParams.set('province', provinceSelect.value);
            }

            await fetchAndRender(url.href);
        });
    });

    function setFilterPopupState(isOpen) {
        if (!filterPopup) return;
        filterPopup.classList.toggle('open', isOpen);
        filterPopup.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
    }

    if (filterButton && filterPopup) {
        filterButton.addEventListener('click', () => {
            const isOpen = !filterPopup.classList.contains('open');
            setFilterPopupState(isOpen);
        });

        document.addEventListener('click', (event) => {
            if (!filterPopup.contains(event.target) && !filterButton.contains(event.target)) {
                setFilterPopupState(false);
            }
        });
    }

    if (applyProvinceFilterBtn) {
        applyProvinceFilterBtn.addEventListener('click', async () => {
            setFilterPopupState(false);
            await fetchAndRender(buildFilterUrl());
        });
    }

    if (searchInput) {
        const doSearch = debounce(async (e) => {
            await fetchAndRender(buildFilterUrl());
        }, 300);

        searchInput.addEventListener('input', doSearch);
    }
});