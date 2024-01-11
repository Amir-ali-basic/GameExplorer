document.addEventListener("DOMContentLoaded", function () {
  const categoryLinks = document.querySelectorAll(".category-link");
  const gamesContainer = document.getElementById("games-container");

  categoryLinks.forEach(function (link) {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const categoryId = link.getAttribute("data-category-id");

      fetch(`/games/casino/loadGamesByCategory/${categoryId}`)
        .then((response) => response.json())
        .then((data) => {
          gamesContainer.innerHTML = "";

          data.forEach(function (game) {
            const gameCardDiv = document.createElement("div");
            gameCardDiv.className = "game-card";
            gameCardDiv.innerHTML = `
                    <div class="game-wrapper">
                        <div class="game-image">
                            <img src="${
                              game.icon2
                                ? game.icon2
                                : "assets/images/no-image.png"
                            }" alt="${game.name}">
                        </div>
                    </div>
              `;
            gamesContainer.appendChild(gameCardDiv);
          });
        })
        .catch((error) => {
          console.error("Error fetching new games:", error);
        });
    });
  });
});
