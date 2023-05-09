setTimeout(() => {

  if (document.getElementById('popup-container') !== null) {
    const box1 = document.getElementById('popup-container');
    box1.style.display = 'none';
  }
  if (document.getElementById('error-popup-container') !== null) {
    const box2 = document.getElementById('error-popup-container');
    box2.style.display = 'none';
  }
  }, 2500);

