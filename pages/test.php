<!DOCTYPE html>
<html>
<head>
  <style>
    #dateTable {
      width: 100%;
      border-collapse: collapse;
    }

    #dateTable th, #dateTable td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }

    #dateTable th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <div class="table standard-padding px-3">
    <section class="table__body">
      <table class="table table-md-responsive" id="dateTable">
        <thead>
          <tr>
            <th>ရက်အလိုက်</th>
            <th>စုစုပေါင်းရောင်းရငွေ</th>
            <th>အသေးစိတ်ကြည့်ရန်</th>
          </tr>
        </thead>
        <tbody>
          <!-- Dates will be dynamically generated here -->
        </tbody>
      </table>
    </section>
  </div>

  <script>
    function generateDateTable() {
      const table = document.getElementById("dateTable").getElementsByTagName("tbody")[0];
      const startDate = new Date("2023-01-01"); // Start from January 1, 2023
      const endDate = new Date("2023-12-31"); // End on December 31, 2023

      while (startDate <= endDate) {
        const row = table.insertRow();
        const dayCell = row.insertCell(0);
        const dateCell = row.insertCell(1);
        const Cell = row.insertCell(2);

        // Format the date as "M/D/YYYY"
        const month = (startDate.getMonth() + 1).toString().padStart(2, '0');
        const day = startDate.getDate().toString().padStart(2, '0');
        const year = startDate.getFullYear();
        const formattedDate = `${month}/${day}/${year}`;

        dayCell.textContent = formattedDate;
        startDate.setDate(startDate.getDate() + 1); // Increment to the next day
      }
    }

    generateDateTable();
  </script>
</body>
</html>
