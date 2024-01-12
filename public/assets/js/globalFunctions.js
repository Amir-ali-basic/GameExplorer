function showLoading() {
  const loaderContainer = document.getElementById("loader-container");
  if (loaderContainer) {
    loaderContainer.style.display = "flex";
  }
}

function hideLoading() {
  const loaderContainer = document.getElementById("loader-container");
  if (loaderContainer) {
    loaderContainer.style.display = "none";
  }
}

window.onload = function () {
  hideLoading();
};

export { showLoading, hideLoading };
