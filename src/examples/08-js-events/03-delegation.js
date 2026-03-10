// 08-3: Event delegation on cards
const cardsContainer = document.getElementById('cards');

function toggleCardHighlight(card) {
    card.classList.toggle('selected');
}

function logCardTitle(card) {
    console.log('Card title:', card.dataset.title);
}

function handleCardsClick(event) {
    const card = event.target.closest('.card');
    if (!card) {
        return;
    }

    const action = event.target.dataset.action;
    if (action === 'select') {
        toggleCardHighlight(card);
    } else if (action === 'log') {
        logCardTitle(card);
    }
}

cardsContainer.addEventListener('click', handleCardsClick);
