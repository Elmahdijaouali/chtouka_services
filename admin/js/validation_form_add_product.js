document
  .querySelector(".form_add_product")
  .addEventListener("submit", function (e) {
    let valid = true;

    // Check Price
    const price = document.getElementById("price");
    if (price.value <= 0) {
      alert("Price must be greater than 0.");
      valid = false;
    }

    // Check Quantity
    const quantity = document.getElementById("quantity");
    if (quantity.value <= 0) {
      alert("Quantity must be greater than 0.");
      valid = false;
    }

    // Check Image Upload
    const images = document.getElementById("images").files;
    if (images.length === 0) {
      alert("At least one image must be uploaded.");
      valid = false;
    }

    // Check French Product Name
    const productNameFr = document.getElementById("product_name_fr");
    if (productNameFr.value.trim() === "") {
      alert("Product Name in French is required.");
      valid = false;
    }

    // Check French Description
    const descriptionFr = document.getElementById("description_fr");
    if (descriptionFr.value.trim() === "") {
      alert("Description in French is required.");
      valid = false;
    }

    // Check Arabic Product Name
    const productNameAr = document.getElementById("product_name_ar");
    if (productNameAr.value.trim() === "") {
      alert("اسم المنتج (Product Name in Arabic) is required.");
      valid = false;
    }

    // Check Arabic Description
    const descriptionAr = document.getElementById("description_ar");
    if (descriptionAr.value.trim() === "") {
      alert("وصف (Description in Arabic) is required.");
      valid = false;
    }

    // Prevent form submission if validation fails
    if (!valid) {
      e.preventDefault();
    }
  });
