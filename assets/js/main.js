const calendar = document.querySelector(".calendar");
const date = document.querySelector(".date");
const daysContainer = document.querySelector(".days");
const prev = document.querySelector(".prev"); // button previous month
const next = document.querySelector(".next"); // button next month
const eventDay = document.querySelector(".event-day");
const eventDate = document.querySelector(".event-date");
const eventsContainer = document.querySelector(".events");

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "January",
  "Februrary",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

let eventsArr = [];

// Initialize the calendar
initCalendar();

// Function to add days to the calendar
function initCalendar() {
  // we get the previous month's days that were in the same week as the current month
  // the days of the current month
  // and the remaining days as the beginning of the next month
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const nextDays = 7 - lastDay.getDay() - 1;

  // Update the date at the top of the calendar
  date.innerHTML = months[month] + " " + year;

  // Adding days in DOM
  let days = "";

  // Previous month's days
  for (let x = day; x > 0; x--) {
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  // Current month's days
  for (let i = 1; i <= lastDate; i++) {
    // Check if there is an event on the current day
    let event = false;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
      }
    });

    // If the day is today, add the 'today' class
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      getActiveDay(i);
      updateEvents(i);
      if (event) {
        days += `<div class="day today active event">${i}</div>`;
      } else {
        days += `<div class="day today active">${i}</div>`;
      }
    } else {
      if (event) {
        days += `<div class="day event">${i}</div>`;
      } else {
        days += `<div class="day">${i}</div>`;
      }
    }
  }

  // Next month's days
  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date">${j}</div>`;
  }

  daysContainer.innerHTML = days;
  // Adding the listener after the calendar is initialized
  addListner();
}

// Function to go to the previous month
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

// Function to go to the next month
function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

// Adding event listeners on prev and next buttons
prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

// Function to add the active class on the clicked day
function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      // Set the current day as the active day
      activeDay = Number(e.target.innerHTML);
      // Display the date after the click
      getActiveDay(e.target.innerHTML);
      updateEvents(Number(e.target.innerHTML));

      // Remove active from already active day
      days.forEach((day) => {
        day.classList.remove("active");
      });
      e.target.classList.add("active");
    });
  });
}

// Function to display the active date
function getActiveDay(date) {
  const day = new Date(year, month, date);
  const dayName = day.toString().split(" ")[0];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}

// Function to show events on the active day
function updateEvents(date) {
  let events = "";
  eventsArr.forEach((event) => {
    if (
      date === event.day &&
      month + 1 === event.month &&
      year === event.year
    ) {
      event.events.forEach((event) => {
        events += `<div class="event d-grid">
            <div class="title d-flex justify-content-between">
              <h3 class="event-title">${event.title}</h3>
              <a href="delete-event.php?id=${event.id_event}&redirect=index.php" class="btn-close p-0" aria-label="Delete"></a>
            </div>
            <div class="event-time">
              <span class="event-time">${event.time}</span>
            </div>
        </div>`;
      });
    }
  });
  if (events === "") {
    events = `<div class="no-event">
            <h3>No Events</h3>
        </div>`;
  }
  eventsContainer.innerHTML = events;
}

// Fetch events from the server when the window loads
window.addEventListener("load", () => {
  fetchEvents();
  async function fetchEvents() {
    try {
      const response = await fetch("get-events.php");
      const data = await response.json();

      if (data.error) {
        console.error("Error fetching events:", data.error);
        // Handle the case where no user is logged in
        document.querySelector(".events").innerHTML =
          "<h3>Please Log in or Sign up to start eventifying your days</h3>";
        return;
      }

      eventsArr = data.map((event) => ({
        day: new Date(event.date_start).getDate(),
        month: new Date(event.date_start).getMonth() + 1,
        year: new Date(event.date_start).getFullYear(),
        events: [
          {
            id_event: event.id_event,
            title: event.title,
            time: `${event.hour_start} - ${event.hour_end}`,
          },
        ],
      }));
      initCalendar();
    } catch (error) {
      document.querySelector(".events").innerHTML =
        "<div><h3>Please Log in or Sign up to start eventifying your days</h3></div>";
    }
  }
});
