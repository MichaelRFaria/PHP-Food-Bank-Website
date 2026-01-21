document.addEventListener("DOMContentLoaded", highlightOpeningTime());

function highlightOpeningTime() {
  const timeNow = new Date();

  // we do all of this here now, so that if a browser does not have javascript the opening times still appear properly
  const message = document.getElementById("opening_message");
  message.textContent = "We are open!";

  const d1 = document.getElementById("weekdays");
  const d2 = document.getElementById("saturday");
  const d3 = document.getElementById("sunday");
  d1.className = "striked_through";
  d2.className = "striked_through";
  d3.className = "striked_through";

  const today = timeNow.getDay();
  //console.log(timeNow.getDay());

  const currHour = timeNow.getHours();
  //console.log(timeNow.getHours());

  switch (today) {
    case (1, 2, 3, 4, 5):
      if (currHour >= 10 && currHour < 20) {
        const todaysOpenTime = document.getElementById("weekday");
        todaysOpenTime.className = "not_striked_through";
      } else {
        const message = document.getElementById("opening_message");
        message.textContent = "Closed for today! Next open tomorrow";
      }
      break;
    case 6:
      if (currHour >= 10 && currHour < 18) {
        const todaysOpenTime = document.getElementById("saturday");
        todaysOpenTime.className = "not_striked_through";
        //console.log("test");
      } else {
        const message = document.getElementById("opening_message");
        message.textContent = "Closed for today! Next open on Monday";
      }
      break;
    case 0:
      const message = document.getElementById("opening_message");
      message.textContent = "Closed for today! Next open on Monday";
  }

  //console.log(document.getElementById("saturday").className);
}
