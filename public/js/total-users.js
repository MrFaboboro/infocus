// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Pie Chart Example
var ctx = document.getElementById("totalUsers");
var myPieChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["User", "Author", "Admin", "Super Admin"],
    datasets: [
      {
        label: "Label",
        data: [1, 0, 0, 1],
        backgroundColor: ["#007bff", "#dc3545", "#ffc107", "#28a745"]
      }
    ]
  },
  options: {
    responsive: true,
    legend: {
      position: "top"
    },
    title: {
      display: true,
      text: "Chart.js Bar Chart"
    }
  }
});
