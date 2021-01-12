
    <style>
            #Buscador {
                background: url(https://cdn0.iconfinder.com/data/icons/slim-square-icons-basics/100/basics-19-32.png) no-repeat 0px 5px;
                background-size: 24px;
                width: 500px;
                border: transparent;
                border-bottom: solid 1px #212121;
                padding: 10px 10px 10px 30px;
                outline: none;
            }
    </style>



         <input type="search"name="searchText" placeholder="Busqueda por estado,usuario o caracter" onkeyup="myFunction()" id="Buscador" />
         
            


    <script>
            function myFunction() {
                // Declare variables 
                var input, filter, table, tr, td, i, j, visible;
                input = document.getElementById("Buscador");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
            
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 1; i < tr.length; i++) {
                visible = false;
                /* Obtenemos todas las celdas de la fila, no sólo la primera */
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    visible = true;
                    }
                }
                if (visible === true) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
    </script>