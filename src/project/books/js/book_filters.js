let applyBtn = document.getElementById('apply_filters');
let clearBtn = document.getElementById('clear_filters');

let cardContainer = document.getElementById("book_cards")

let cards = document.querySelectorAll('.card');

let form = document.getElementById("filters");

applyBtn.addEventListener('click', (event)=> {
    event.preventDefault();
    applyFilters();
});

clearBtn.addEventListener('click', (event)=> {
    event.preventDefault();
    clearFilters();
});

document.querySelector("form").addEventListener("submit", (event)=>{
    event.preventDefault();
    applyFilters();
});

function applyFilters(){
    let filters = getFilters();

    let cardsArray = Array.from(cards);

    // filter first
    let filtered = cardsArray.filter(card => cardMatches(card, filters));

    // sort filtered results
    let sorted = sortCards(filtered, filters.sortBy);

    // clear container BEFORE re-adding
    cardContainer.innerHTML = "";

    // add sorted + visible cards
    sorted.forEach(card => {
        card.classList.remove('hidden');
        cardContainer.appendChild(card);
    });

    // hide non-matching cards (optional safety)
    cardsArray.forEach(card => {
        if (!filtered.includes(card)) {
            card.classList.add('hidden');
        }
    });
}

function cardMatches(crd, fltrs){
    

    let title = (crd.dataset.title || '').toLowerCase();
    let publisher = crd.dataset.publisher || '';

    let formatsRaw = crd.dataset.format || '';
    let formats = formatsRaw ? formatsRaw.split(',').map(f => f.trim()): [];

    let matchTitle =fltrs.titleFilter === "" ||title.includes(fltrs.titleFilter);

    let matchPublisher =fltrs.publisherFilter === "" ||publisher === fltrs.publisherFilter;

    let matchFormat =fltrs.formatFilter === "" ||formats.includes(fltrs.formatFilter);
        console.log('Card:', crd.dataset.title);
console.log('format_ids on card:', crd.dataset.format);
console.log('filter value:', fltrs.formatFilter);


    return matchTitle && matchPublisher && matchFormat;


}

function getFilters (){
    const titleEl = form.elements['title_filter'];
    const publisherEl = form.elements['publisher_filter'];
    const formatEl = form.elements['format_filter'];
    const sortEl = form.elements['sort_by'];

    let titleFilter = (titleEl.value || '').trim().toLowerCase();
    let publisherFilter = publisherEl.value || '';
    let formatFilter = (formatEl.value || '').trim();
    let sortBy = sortEl.value || 'title_asc';

    return {
        "titleFilter" : titleFilter,
        "publisherFilter" : publisherFilter,
        "formatFilter" : formatFilter,
        "sortBy" : sortBy
    }
}

function clearFilters (){
    form.reset();
    cards.forEach(function(card){
    card.classList.remove('hidden');
});
        
    let cardsArray = Array.from(cards);
    const sorted = sortCards(cardsArray, "title_asc");
    sorted.forEach(card => {
        cardContainer.appendChild(card);
    });
    
}


function sortCards (cards, sortBy){
    const list = [...cards];

    list.sort((a,b) => {
            let titleA = a.dataset.title.toLowerCase();
            let titleB = b.dataset.title.toLowerCase();
            let yearA = Number(a.dataset.year);
            let yearB = Number(b.dataset.year);

            if (sortBy == "year_desc") return yearB - yearA;
            if (sortBy == "year_asc") return yearA - yearB;

            return titleA.localeCompare(titleB);
        });
  return list;
}
