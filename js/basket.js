const updateBasketIcon = () => {
  // Calculate number of items in basket
  totalItems = 0;

  for (let i = 0; i < window.localStorage.length; i++) {
    let key = parseInt(window.localStorage.key(i));
    if (key !== undefined && !isNaN(key)) {
      let quantity = parseInt(window.localStorage.getItem(key));
      if (quantity !== undefined && !isNaN(quantity)) totalItems += quantity;
      else console.log("ERROR: ", key, ", ", quantity);
    }
  }

  if (totalItems > 0) {
    document.getElementById("basket_count").classList.remove("hidden");
    document.getElementById("basket_count").innerHTML = totalItems;
  } else {
    document.getElementById("basket_count").classList.add("hidden");
    document.getElementById("basket_count").innerHTML = "";
  }
};

// Update basket icon when page loads
updateBasketIcon();

const addToBasket = (productID, quantity) => {
  // Get quantity from local storage if it exists
  let currentQuantity = parseInt(window.localStorage.getItem(productID));
  let newQuantity = parseInt(quantity);

  // If the quantities are not numbers, set them to 0
  if (isNaN(currentQuantity)) currentQuantity = 0;
  if (isNaN(newQuantity)) newQuantity = 0;

  if (newQuantity <= 0) {
    alert("Please enter a valid number above zero!");
    return;
  }
  // Add quantity and update local storage
  newQuantity = currentQuantity + newQuantity;
  window.localStorage.setItem(productID, newQuantity);

  // Update basket icon
  updateBasketIcon();
};
