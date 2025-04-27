document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("reservationForm");
    if (form) {
      form.addEventListener("submit", function (e) {
        e.preventDefault();
        const name = document.getElementById("name").value;
        const field = document.getElementById("field").value;
        const date = document.getElementById("date").value;
        const time = document.getElementById("time").value;
        
        const msg = `Thank you, ${name}! Reservation for the ${field} field on ${date} at ${time} has been confirmed.`;
        document.getElementById("confirmationMessage").textContent = msg;
  
        form.reset();
      });
    }
  });
  