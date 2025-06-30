function show_notification(msg) {
  let div = document.createElement("div");

  if (msg.includes("success")) {
    div.innerHTML =
      "<p><i class='fa-solid fa-check' style='color: #7FAD39;'></i> " +
      msg +
      "</p>";
    div.classList.add("success");
  } else if (msg.includes("error")) {
    div.innerHTML =
      "<p><i class='fa-solid fa-xmark' style='color: #f70202;'></i> " +
      msg +
      "</p>";
    div.classList.add("error");
  } else if (msg.includes("invalid")) {
    div.innerHTML =
      "<p><i class='fa-solid fa-circle-exclamation' style='color: #FFD43B;'></i> " +
      msg +
      "</p>";
    div.classList.add("invalid");
  }

  document.querySelector(".show_notifications").appendChild(div);
  setTimeout(() => {
    div.remove();
  }, 5000);
}
