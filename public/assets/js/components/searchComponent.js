export function initializeSearchComponent(
  searchId,
  placeholder,
  searchFunction
) {
  const searchInput = document.getElementById(searchId);

  searchInput.addEventListener("input", debounceSearchInput);

  function debounceSearchInput() {
    clearTimeout(debounceSearchInput.debounceTimer);
    debounceSearchInput.debounceTimer = setTimeout(() => {
      const searchText = searchInput.value;
      searchFunction(searchText);
    }, 300);
  }
}
