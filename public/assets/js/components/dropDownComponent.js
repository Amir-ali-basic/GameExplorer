export function initializeDropdownComponent(dropdownId, options, onSelect) {
  const dropdown = document.getElementById(dropdownId);
  const selectElement = dropdown.querySelector("select");

  options.forEach((option) => {
    const optionElement = document.createElement("option");
    optionElement.value = option.value;
    optionElement.textContent = option.label;
    selectElement.appendChild(optionElement);
  });

  selectElement.addEventListener("change", function () {
    const selectedValue = selectElement.value;
    onSelect(selectedValue);
  });
}
