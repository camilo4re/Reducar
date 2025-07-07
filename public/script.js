//ANIMACION DE SECCIONES
const sections = document.querySelectorAll(".fade-in-section");
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("visible");
    }
  });
}, {
  threshold: 0.9
});

sections.forEach(section => {
  observer.observe(section);
});

//TITULO ANIMADO
 const frases = [
  "Bienvenido a nuestra página",
  "Secundaria Tecnica n°3 de Padua",
  "Proyecto Reducar",
];

let i = 0;
let j = 0;
let escribiendo = true;
const velocidadEscritura = 100;
const velocidadBorrado = 50;
const pausaEntreFrases = 2000;

const titulo = document.getElementById("tituloAnimado");

function animarTexto() {
  if (escribiendo) {
    if (j < frases[i].length) {
      titulo.textContent += frases[i][j];
      j++;
      setTimeout(animarTexto, velocidadEscritura);
    } else {
      escribiendo = false;
      setTimeout(animarTexto, pausaEntreFrases);
    }
  } else {
    if (j > 0) {
      titulo.textContent = frases[i].substring(0, j - 1);
      j--;
      setTimeout(animarTexto, velocidadBorrado);
    } else {
      escribiendo = true;
      i = (i + 1) % frases.length;
      setTimeout(animarTexto, 500);
    }
  }
}

document.addEventListener("DOMContentLoaded", animarTexto);