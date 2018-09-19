<div class="sidenav">
    <h3>Költségek</h3>
    <button class="dropdown-btn">Kiadások kezelése
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="/costs/create">Új kiadás rögzítése</a>
        <a href="#">Listázás (Szűrő)</a>
        <a href="#">Szerkesztő/Törlő</a>
        <a href="#">Új kiadás típus hozzáadás</a>
        <a href="#">Kimutatások</a>
    </div>
    <button class="dropdown-btn">Telephely adatok
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
    <a href="#contact">Saját fiók kezelés</a>
</div>

<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>