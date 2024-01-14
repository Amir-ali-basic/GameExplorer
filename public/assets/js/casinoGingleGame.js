import { showLoading, hideLoading } from "./globalFunctions.js";

document.addEventListener("DOMContentLoaded", function () {
  showLoading();
});

window.onload = function () {
  hideLoading();
};
