export function initializeNavigationComponent(navId, callback) {
  const navigation = document.getElementById(navId);
  if (!navigation) return;

  navigation.addEventListener("click", function (event) {
    if (event.target.tagName === "A") {
      event.preventDefault();
      const clickedItem = event.target
        .closest(".nav-item")
        .getAttribute("data-nav-item");
      navigation.querySelectorAll(".nav-item").forEach((div) => {
        div.classList.remove("active");
      });
      event.target.closest(".nav-item").classList.add("active");
      if (callback && typeof callback === "function") {
        callback(clickedItem);
      }
    }
  });

  // Initialize first item as active
  const firstNavItem = navigation.querySelector(".nav-item");
  if (firstNavItem) {
    firstNavItem.classList.add("active");
  }
}
