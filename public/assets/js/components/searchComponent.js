export function initializeSearchComponent(
  searchId,
  placeholder,
  searchFunction
) {
  const searchInput = document.getElementById(searchId);

  // Dodajte event listener za pretragu
  searchInput.addEventListener("input", debounceSearchInput);

  function debounceSearchInput() {
    clearTimeout(debounceSearchInput.debounceTimer);
    debounceSearchInput.debounceTimer = setTimeout(() => {
      const searchText = searchInput.value;
      if (searchText.length > 2) {
        searchFunction(searchText);
      } else if (searchText.length === 0) {
      }
    }, 300);
  }
}
