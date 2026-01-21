function navigateToOpeningTimes() {
  //console.log("test");

  const element = document.getElementById("opening_times_normal");
  element.id = "opening_times_selected";

  window.setTimeout(resetOpeningTimes, 500);
}

function resetOpeningTimes() {
  const element = document.getElementById("opening_times_selected");
  element.id = "opening_times_normal";
}
