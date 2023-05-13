// Get the maximum window width
const maxWidth = window.screen.availWidth;

// Calculate the width of the navigation bar
const navWidth = Math.round(maxWidth * 0.15);

// Set the width of the navigation bar
const nav = document.querySelector('.nav');
nav.style.width = `${navWidth}px`;