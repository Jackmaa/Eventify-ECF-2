// Wait for the DOM to be fully loaded before running the script
document.addEventListener("DOMContentLoaded", (event) => {
  // Get the date input element by its ID
  const dateInputStart = document.getElementById("date-start");
  const dateInputEnd = document.getElementById("date-end");

  // Create a new Date object for today's date
  const today = new Date();

  // Get the current year
  const year = today.getFullYear();

  // Get the current month and pad it with a leading zero if necessary
  const month = String(today.getMonth() + 1).padStart(2, "0");

  // Get the current day and pad it with a leading zero if necessary
  const day = String(today.getDate()).padStart(2, "0");

  // Format today's date as YYYY-MM-DD
  const todayDate = `${year}-${month}-${day}`;

  // Set the min attribute of the date input to today's date
  dateInputStart.setAttribute("min", todayDate);
  dateInputEnd.setAttribute("min", todayDate);
});
