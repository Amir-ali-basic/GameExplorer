document.addEventListener("DOMContentLoaded", function () {
  const categoryDropdown = document.getElementById("category-dropdown");
  const searchInput = document.getElementById("casino-search-input");
  const gamesContainer = document.getElementById("games-container");
  const providerElements = document.querySelectorAll(".casino-games-providers");

  // Event listener for category changes
  categoryDropdown.addEventListener("change", function () {
    fetchGamesByCategory(categoryDropdown.value);
  });

  // Event listener for search
  searchInput.addEventListener("input", debounceSearchInput);

  // Event listener for provideer
  providerElements.forEach((element) => {
    element.addEventListener("click", function () {
      fetchGamesByProvider(element.getAttribute("data-provider"));
    });
  });

  function fetchGamesByCategory(categoryId) {
    performFetch(`/games/casino/loadGamesByCategory/${categoryId}`);
  }

  function fetchGamesByProvider(providerName) {
    performFetch(
      `/games/casino/loadGamesByProvider/${encodeURIComponent(providerName)}`
    );
  }

  function fetchAllGames() {
    performFetch(`/games/casino/all`);
  }

  function performFetch(url) {
    showLoading();
    fetch(url).then(handleResponse).then(updateGamesList).catch(handleError);
  }

  function handleResponse(response) {
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    return response.json();
  }

  function updateGamesList(games) {
    gamesContainer.innerHTML = "";
    games.forEach((game) => {
      gamesContainer.appendChild(createGameCard(game));
    });
    hideLoading();
  }

  function createGameCard(game) {
    const gameCardDiv = document.createElement("div");
    gameCardDiv.className = "game-card";
    gameCardDiv.innerHTML = `<div class="game-wrapper">
            <div class="game-image">
                <img src="${
                  game.icon2 ? game.icon2 : "assets/images/no-image.png"
                }" alt="${game.name}">
            </div>
        </div>`;
    return gameCardDiv;
  }

  function debounceSearchInput() {
    clearTimeout(debounceSearchInput.debounceTimer);
    debounceSearchInput.debounceTimer = setTimeout(() => {
      const searchText = searchInput.value;
      if (searchText.length > 2) {
        performFetch(
          `/games/casino/search?name=${encodeURIComponent(searchText)}`
        );
      } else if (searchText.length === 0) {
        fetchAllGames();
      }
    }, 300);
  }

  function showLoading() {
    // Kod za prikazivanje indikatora učitavanja
  }

  function hideLoading() {
    // Kod za skrivanje indikatora učitavanja
  }

  function handleError(error) {
    console.error("Error:", error);
    hideLoading();
    // Dodatni kod za prikaz greške korisniku
  }
});
