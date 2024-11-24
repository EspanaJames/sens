<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ESP32 Sensor Data</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <h1>ESP32 Sensor Data Dashboard</h1>
    <div class="data-display">
      <div class="data-item">
        <h2>Distance (cm)</h2>
        <p id="distance-cm">Loading...</p>
      </div>
      <div class="data-item">
        <h2>Distance (inches)</h2>
        <p id="distance-inches">Loading...</p>
      </div>
    </div>
  </div>

  <script>
    async function fetchData() {
      try {
        const response = await fetch("update_data.php");
        
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();

        if (data.distance_cm !== undefined && data.distance_inches !== undefined) {
          document.getElementById("distance-cm").textContent = data.distance_cm + " cm";
          document.getElementById("distance-inches").textContent = data.distance_inches + " inches";
        } else {
          throw new Error("Invalid data structure received from the server.");
        }
      } catch (error) {
        console.error("Error fetching data:", error);
        document.getElementById("distance-cm").textContent = "Error fetching data.";
        document.getElementById("distance-inches").textContent = "";
      }
    }

    setInterval(fetchData, 1000);

    fetchData();
  </script>

</body>
</html>
