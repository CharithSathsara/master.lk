document.addEventListener('DOMContentLoaded', () => {
    const main_containers = document.querySelectorAll('.main-container');
  
    main_containers.forEach(main_container => {
      const inner_cards = main_container.querySelectorAll('.card-inner');
      const show_answer_btn = main_container.querySelectorAll('.show-answer-btn');
  
      inner_cards.forEach(card => {
        card.addEventListener('click', () => {
          card.classList.toggle('is-flipped');
        });
      });
  
      show_answer_btn.forEach(btn => {
        btn.addEventListener('click', () => {
          inner_cards.forEach(card => {
            if (card.classList.contains('is-flipped')) {
              card.classList.remove('is-flipped');
            }
          });
          inner_cards.forEach(card => {
            card.classList.toggle('is-flipped');
          });
          btn.style.display = 'none';
          const btn_divs = main_container.querySelectorAll('.button-container');
          btn_divs.forEach(btn_div => {
            const hide_answers_btn = document.createElement('button');
            hide_answers_btn.innerHTML = 'Hide Answer';
            hide_answers_btn.className = 'hide-answer-btn';
            btn_div.appendChild(hide_answers_btn);
          });
        });
      });
  
      main_container.addEventListener('click', event => {
        if (event.target.classList.contains('hide-answer-btn')) {
          inner_cards.forEach(card => {
            if (card.classList.contains('is-flipped')) {
              card.classList.remove('is-flipped');
            }
          });
          const show_answer_btn = main_container.querySelector('.show-answer-btn');
          show_answer_btn.style.display = 'block';
          event.target.remove();
        }
      });
    });
  });
  