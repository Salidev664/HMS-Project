    function filterTable(inputElement, tableId) {
      const filterValue = inputElement.value.toLowerCase();
      const table = document.getElementById(tableId);
      const rows = table.getElementsByTagName('tr');

      for (let i = 1; i < rows.length; i++) {
        const firstCell = rows[i].getElementsByTagName('td')[0];
        if (firstCell) {
          const textValue = firstCell.textContent || firstCell.innerText;
          if (textValue.toLowerCase().indexOf(filterValue) > -1) {
            rows[i].style.display = "";
          } else {
            rows[i].style.display = "none";
          }
        }
      }
    }

    // Interave Button Click Actio
    