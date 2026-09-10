 const hambuger_nav = document.getElementById("hambuger_nav");
    const myLink = document.getElementById("mylink");
    hambuger_nav.addEventListener("click", function(){
        myLink.classList.toggle("d-block");
        myLink.classList.toggle("d-none");
});

function openBooking(doctorId, doctorName, specialty, photo) {

    document.getElementById("doctorId").value = doctorId;

    document.getElementById("modalDocName").textContent = doctorName;

    document.getElementById("modalDocspec").textContent = specialty;

    document.getElementById("doctorPhoto").src = photo;

    const modal = new bootstrap.Modal(
        document.getElementById("mod")
    );

    modal.show();
}

function  browseDoctor(){
    const targetSection = document.getElementById("card_section");
    targetSection.scrollIntoView({
        behavior : 'smooth',
        block : 'start'
    });
}

function help(){
    const helpSection = document.getElementById("help_section");
    helpSection.scrollIntoView({
        behavior : 'smooth',
        block : 'start'
    });
}
    
//---------------search for doctors-----------------
 function  searchDoctor(inputDoctor, tableId) {
      const filterValue = inputDoctor.value.toLowerCase();
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