import { showLoading, hideLoading } from "./globalFunctions.js";
import { initializeSearchComponent } from "./components/searchComponent.js";

document.addEventListener("DOMContentLoaded", function () {
  const categoryDropdown = document.getElementById("category-dropdown");
  const gamesContainer = document.getElementById("games-container");
  const providerElements = document.querySelectorAll(".casino-games-providers");
  const clearFiltersBtn = document.getElementById("clear-filters-btn");

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

  // Event listener for clear filters button
  clearFiltersBtn.addEventListener("click", function () {
    fetchAllGames();
  });

  // Event listener for search
  function searchGames(searchText) {
    console.log("searchText", searchText);
    if (searchText.trim() === "") {
      fetchAllGames();
    } else {
      const url = `/games/casino/search?name=${encodeURIComponent(searchText)}`;
      performFetch(url);
    }
  }

  function fetchGamesByCategory(categoryId) {
    if (categoryId === "all") {
      fetchAllGames();
    } else {
      performFetch(`/games/casino/loadGamesByCategory/${categoryId}`);
    }
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
    const gameCardLink = document.createElement("a");
    gameCardLink.className = "game-card";
    gameCardLink.href = `/games/casino/${game.id}`;

    const gameWrapperDiv = document.createElement("div");
    gameWrapperDiv.className = "game-wrapper";

    const gameImageDiv = document.createElement("div");
    gameImageDiv.className = "game-image";

    const gameImage = document.createElement("img");
    gameImage.alt = game.name;
    gameImage.src = game.icon2 ? game.icon2 : "assets/images/no-image.png";

    gameImageDiv.appendChild(gameImage);
    gameWrapperDiv.appendChild(gameImageDiv);
    gameCardLink.appendChild(gameWrapperDiv);

    return gameCardLink;
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
