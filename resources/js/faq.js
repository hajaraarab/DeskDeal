

// Make the entire <details> clickable: clicking outside the <summary>
// toggles the details open/closed. Clicking the <summary> uses native behavior.
document.querySelectorAll('.faq-question details').forEach(detail => {
    detail.addEventListener('click', (e) => {
        const summary = detail.querySelector('summary');
        // If the click originated on the summary (or inside it), let the
        // browser handle the native toggle and do nothing here.
        if (summary && (summary === e.target || summary.contains(e.target))) {
            return;
        }
        // Toggle the open state when clicking anywhere else inside <details>
        detail.open = !detail.open;
    });
});