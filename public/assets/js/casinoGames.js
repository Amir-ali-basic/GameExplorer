import { showLoading, hideLoading } from "./globalFunctions.js";
import { initializeSearchComponent } from "./components/searchComponent.js";
import { initializeDropdownComponent } from "./components/dropDownComponent.js";

document.addEventListener("DOMContentLoaded", function () {
  const categoryDropdown = document.getElementById("category-dropdown");
  const gamesContainer = document.getElementById("games-container");
  const providerElements = document.querySelectorAll(".casino-games-providers");

  // Event listener for category changes
  categoryDropdown.addEventListener("change", function () {
    fetchGamesByCategory(categoryDropdown.value);
  });

  // Event listener for provideer
  providerElements.forEach((element) => {
    element.addEventListener("click", function () {
      fetchGamesByProvider(element.getAttribute("data-provider"));
    });
  });

  // Event listener for search
  function searchGames(searchText) {
    const url = `/games/casino/search?name=${encodeURIComponent(searchText)}`;
    performFetch(url);
  }

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

  initializeSearchComponent(
    "casino-search-input",
    "Search games...",
    searchGames
  );

  function handleError(error) {
    console.error("Error:", error);
    hideLoading();
  }
});
