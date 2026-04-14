/* =====================================================
   DELICIAS NATURALES
   SCRIPT PRINCIPAL DEL SISTEMA WEB
   Autor: Equipo de Desarrollo
=====================================================*/


/* =====================================================
   VARIABLES GLOBALES
=====================================================*/

/* Carrito almacenado en navegador */
let carrito =
JSON.parse(localStorage.getItem("carrito")) || [];

/* Historial de pedidos */
let historial =
JSON.parse(localStorage.getItem("historial")) || [];

/* Categoría activa */
let categoriaActual="todos";


/* =====================================================
   BASE DE DATOS DE PRODUCTOS (FRONTEND)
=====================================================*/
const productos=[

{nombre:"Yogur de Fresa",precio:8000,
img:"img/yogur-fresa.jpeg"},

{nombre:"Yogur de Mora",precio:8000,
img:"img/yogur-mora2.jpeg"},

{nombre:"Yogur de Piña",precio:8000,
img:"img/yogur-piña.jpeg"},

{nombre:"Yogur de melocoton",precio:8000,
img:"img/yogur-melocoton.jpeg"},

{nombre:"Bolis de Fresa",precio:2000,
img:"img/bolis-fresa.jpeg"},

{nombre:"Bolis de durazno",precio:2000,
img:"img/bolis-durazno.jpeg"},

{nombre:"Bolis de piña",precio:2000,
img:"img/bolis-piña.jpeg"},

{nombre:"Bolis de Mora",precio:2000,
img:"img/bolis-mora.jpeg"},

{nombre:"Bolis de Maracuyá",precio:2000,
img:"img/bolis-maracuya2.jpeg"}

];


/* =====================================================
   NAVEGACIÓN ENTRE SECCIONES
=====================================================*/
function mostrar(id){

document
.querySelectorAll('.page')
.forEach(p=>p.style.display='none');

document
.getElementById(id)
.style.display='block';
}

/* Página inicial */
mostrar("inicio");


/* =====================================================
   CARGAR PRODUCTOS DINÁMICAMENTE
=====================================================*/
function cargarProductos(){

let cont =
document.getElementById("contenedorProductos");

cont.innerHTML="";

productos.forEach(p=>{

cont.innerHTML+=`
<div class="card">

<img src="${p.img}">

<div class="card-body">

<h4>${p.nombre}</h4>

<p>$${p.precio}</p>

<button onclick="agregar('${p.nombre}',${p.precio})">
Agregar
</button>

</div>
</div>`;
});
}


/* =====================================================
   CARRITO DE COMPRAS
=====================================================*/

function agregar(nombre,precio){

let item=
carrito.find(p=>p.nombre===nombre);

item
? item.cantidad++
: carrito.push({
nombre,
precio,
cantidad:1
});

guardar();
notificar("Producto agregado");
}


/* Actualiza vista carrito */
function actualizar(){

let lista=
document.getElementById("listaCarrito");

let contador=
document.getElementById("contador");

let total=0;
let items=0;

lista.innerHTML="";

carrito.forEach((p,i)=>{

let sub=p.precio*p.cantidad;

total+=sub;
items+=p.cantidad;

lista.innerHTML+=`
<li>

<b>${p.nombre}</b><br>

$${p.precio} x ${p.cantidad}<br>
Subtotal: $${sub}<br>

<button onclick="restar(${i})">➖</button>
<button onclick="sumar(${i})">➕</button>
<button onclick="eliminar(${i})">❌</button>

<hr>
</li>`;
});

/* Total */
document.getElementById("total")
.textContent="Total: $"+total;

/* Contador visual */
contador.textContent=items;
contador.style.display=
items?"inline-block":"none";

/* Animación */
contador.classList.add("animar");

setTimeout(()=>{
contador.classList.remove("animar");
},300);

}


/* =====================================================
   OPERACIONES DEL CARRITO
=====================================================*/

function sumar(i){
carrito[i].cantidad++;
guardar();
}

function restar(i){

carrito[i].cantidad--;

if(carrito[i].cantidad<=0)
carrito.splice(i,1);

guardar();
}

function eliminar(i){
carrito.splice(i,1);
guardar();
}

function vaciarCarrito(){

if(confirm("¿Vaciar carrito?")){
carrito=[];
guardar();
}
}


/* =====================================================
   GUARDADO LOCAL
=====================================================*/
function guardar(){

localStorage.setItem(
"carrito",
JSON.stringify(carrito)
);

actualizar();
}


/* =====================================================
   ENVÍO PEDIDO WHATSAPP
=====================================================*/
function enviarPedido(){

if(!confirm("¿Confirmar pedido?"))
return;

if(!carrito.length)
return alert("Carrito vacío");

let total=0;

let msg=
"Hola quiero pedir:%0A";

carrito.forEach(p=>{

total+=p.precio*p.cantidad;

msg+=
`- ${p.nombre} x${p.cantidad}%0A`;

});

msg+=`%0ATotal: $${total}`;


/* Guardar historial */
historial.push({
fecha:new Date().toLocaleString(),
pedido:[...carrito],
total
});

localStorage.setItem(
"historial",
JSON.stringify(historial)
);

/* Reiniciar carrito */
carrito=[];
guardar();
cargarHistorial();

/* Abrir WhatsApp */
window.open(
"https://wa.me/573234635361?text="+msg
);
}


/* =====================================================
   HISTORIAL
=====================================================*/
function cargarHistorial(){

let lista=
document.getElementById("listaHistorial");

lista.innerHTML="";

historial.forEach(h=>{

lista.innerHTML+=`
<li>
Pedido ${h.fecha}<br>
Total: $${h.total}
<hr>
</li>`;
});
}


/* =====================================================
   NOTIFICACIONES VISUALES
=====================================================*/
function notificar(texto){

let n=
document.getElementById("notificacion");

n.textContent=texto;
n.style.opacity=1;

setTimeout(()=>{
n.style.opacity=0;
},2000);
}


/* =====================================================
   BUSCADOR
=====================================================*/
function filtrarProductos(){

let texto=
document
.getElementById("buscador")
.value.toLowerCase();

document
.querySelectorAll(".card")
.forEach(card=>{

let nombre=
card.querySelector("h4")
.textContent
.toLowerCase();

card.style.display=
nombre.includes(texto)
?"block":"none";

});
}


/* =====================================================
   FILTRO POR CATEGORÍA
=====================================================*/
function filtrarCategoria(cat){

categoriaActual=cat;

document
.querySelectorAll(".card")
.forEach(card=>{

let nombre=
card.querySelector("h4")
.textContent;

if(
cat==="todos"
|| nombre.includes(cat)
)
card.style.display="block";
else
card.style.display="none";

});
}


/* =====================================================
   🌙 MODO NOCTURNO
=====================================================*/

function toggleDarkMode(){

document.body
.classList.toggle("dark");

/* Guardar preferencia */
localStorage.setItem(
"modoOscuro",
document.body.classList.contains("dark")
);
}


/* Cargar modo guardado */
if(
localStorage.getItem("modoOscuro")==="true"
){
document.body.classList.add("dark");
}


/* =====================================================
   INICIALIZACIÓN DEL SISTEMA
=====================================================*/
cargarProductos();
actualizar();
cargarHistorial();