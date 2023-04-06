const searchInput = document.querySelector('input[name="search"]');
const clearButton = document.querySelector('.clear-search');
const searchForm = document.querySelector('.search-form');

clearButton.addEventListener('click', () => {
    searchInput.value = '';
    searchForm.submit();
});

