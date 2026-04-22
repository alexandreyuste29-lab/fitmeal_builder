document.addEventListener("DOMContentLoaded", function() {

    const carrito = document.getElementById("carrito");

    function actualizarCarrito() {

        const seleccionados = document.querySelectorAll("input[name='alimentos[]']:checked");

        carrito.innerHTML = "";

        if (seleccionados.length === 0) {
            carrito.innerHTML = "<p>No has seleccionado alimentos</p>";
            return;
        }

        seleccionados.forEach(input => {

            const nombre = input.parentElement.querySelector(".nombre-alimento").textContent;

            const item = document.createElement("div");
            item.textContent = "✔ " + nombre;

            carrito.appendChild(item);
        });
    }

    //  Detectar cambios en el checkbox
    document.addEventListener("change", function(e) {
        if (e.target.name === "alimentos[]") {
            actualizarCarrito();
        }
    });

});