const inner_cards = document.querySelectorAll('.card-inner');
const show_answer_btn = document.querySelectorAll('.show-answer-btn');

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
      
    });
    
});







