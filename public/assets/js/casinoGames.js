import { showLoading, hideLoading } from "./globalFunctions.js";
import { initializeSearchComponent } from "./components/searchComponent.js";
import { initializeDropdownComponent } from "./components/dropDownComponent.js";
import { initializeNavigationComponent } from "./components/gamesNavigationComponent.js";

document.addEventListener("DOMContentLoaded", function () {
  const categoryDropdown = document.getElementById("category-dropdown");
  const gamesContainer = document.getElementById("games-container");
  const providerElements = document.querySelectorAll(".casino-games-providers");
  const test = document.querySelector(".csaino-games-content");

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
    console.log("searchText", searchText);
    if (searchText.trim() === "") {
      fetchAllGames();
    } else {
      const url = `/games/casino/search?name=${encodeURIComponent(searchText)}`;
      performFetch(url);
    }
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

  initializeNavigationComponent("games-nav", function (clickedItem) {
    // Hide all content sections
    document.querySelectorAll(".content-section").forEach((section) => {
      section.style.display = "none";
    });

    // Show the selected content section based on clickedItem
    if (clickedItem === "Explore games") {
      document.getElementById("explore-games-content").style.display = "block";
    } else if (clickedItem === "Casino games") {
      document.getElementById("casino-games-content").style.display = "block";
    } else if (clickedItem === "Favorite games") {
      document.getElementById("favorite-games-content").style.display = "block";
    }
  });

  // Initially display the first tab's content and set the first link as active
  const firstNavItem = document.querySelector(".nav-item");
  if (firstNavItem) {
    firstNavItem.classList.add("active");
    document.getElementById("explore-games-content").style.display = "block";
  }

  function handleError(error) {
    console.error("Error:", error);
    hideLoading();
  }
});
