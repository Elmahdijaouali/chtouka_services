function fetchOrders() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "pages/fetch_data_orders_new.php", true);
  xhr.onload = function () {
    const containers = document.querySelectorAll(".orders-container_new");
    if (xhr.status === 200) {
      containers.forEach((item) => {
        item.innerHTML = xhr.responseText;
      });
    } else {
      containers.forEach((item) => {
        item.innerHTML = "<p>Error loading orders</p>";
      });
    }
  };
  xhr.send();
}

// Fetch data every 5 seconds
setInterval(fetchOrders, 5000);

// Initial fetch
fetchOrders();
