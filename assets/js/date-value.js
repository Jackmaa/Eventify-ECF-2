document.addEventListener("DOMContentLoaded", (event) => {
  const schedule = document.getElementById("schedule");
  const dateInputStart = document.getElementById("date-start");
  const dateInputEnd = document.getElementById("date-end");

  // Function to update the date inputs
  function updateDateInputs() {
    const activeDate = schedule.querySelector(".active");
    if (activeDate) {
      const dateInputValue = activeDate.getAttribute("data-active-day");
      console.log(dateInputValue);
      dateInputStart.setAttribute("value", dateInputValue);
      dateInputEnd.setAttribute("value", dateInputValue);
    }
  }

  // Initial update of the date inputs
  updateDateInputs();

  // Update the date inputs whenever a day is clicked
  schedule.addEventListener("click", (e) => {
    if (e.target.classList.contains("day")) {
      updateDateInputs();
    }
  });
});
