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
  "Bienvenido a nuestra página ...",
  "Secundaria Tecnica n°3 de Padua ...",
  "Proyecto Reducar ...",
];

let i = 0;
let j = 0;
let escribiendo = true;
const velocidadEscritura = 200;
const velocidadBorrado = 100;
const pausaEntreFrases = 500;  

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

//NUEVO HEADER AL SCROLLEAR
window.addEventListener('scroll', function() {
    const header = document.querySelector('header');
    const scrollPosition = window.scrollY;
    
    
    if (scrollPosition > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

//EFECTO SCROLL SUAVE
document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetSection = document.querySelector(targetId);
        
        if (targetSection) {
            targetSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
})