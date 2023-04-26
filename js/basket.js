const addToBasket = (productID, quantity) => {
  // Get quantity from local storage if it exists
  let currentQuantity = parseInt(window.localStorage.getItem(productID));
  let newQuantity = parseInt(quantity);

  // If the quantities are not numbers, set them to 0
  if (isNaN(currentQuantity)) currentQuantity = 0;
  if (isNaN(newQuantity)) newQuantity = 0;

  // Add quantity and update local storage
  newQuantity = currentQuantity + newQuantity;
  window.localStorage.setItem(productID, newQuantity);
};
