let pro_qty = document.querySelector(".pro-qty");
let price_value = document.getElementById("price_value").value;

pro_qty.onclick = () => {
  let qte = document.querySelector("#qte").value;

  let qte_product = document.querySelector(".qte_product");
  qte_product.value = qte;

  price_product = price_value * qte;
  document.getElementById("price_product").textContent = price_product;
};
