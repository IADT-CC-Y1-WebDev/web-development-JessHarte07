let applyBtn = document.getElementById('apply_filters');
let clearBtn = document.getElementById('clear_filters');

let cards = document.querySelectorAll(".card");

let form = document.getElementById("filters");

applyBtn.addEventListener('click', (event)=> {
    event.preventDefault();
    applyFilters();
});

clearBtn.addEventListener('click', (event)=> {
    event.preventDefault();
    clearFilters();
})


function applyFilters(){
    // console.log ("applying filters");]
    let filters = getFilters();
    let matches = [];

    for(let i = 0; i != cards.length; i++){
        let card = cards[i];
        matches[i] = cardMatches(card, filters);
    }

}

function cardMatches(crd, fltrs){
    // console.log(crd.dataset.title, fltrs.titleFilter);
    let title = crd.dataset.title.toLowercase();
    return title.includes(fltrs.titleFilters)
}

function getFilters (){
    const titleEl = form.elements['title_filter'];
    const genreEl = form.elements['genre_filter'];
    const platformEl = form.elements['platform_filter'];
    const sortEl = form.elements['sort_by'];

    let titleFilter = (titleEl.value || '').trim().toLowerCase();
    let genreFilter = genreEl.value || '';
    let platformFilter = platformEl.value || '';
    let sortBy = sortEl.value || 'title_asc';

    return {
        "titleFilter" : titleFilter,
        "genreFilter" : genreFilter,
        "platformFilter" : platformFilter,
        "sortBy" : sortBy
    }
}

function clearFilters (){
    console.log("clearing filters");
}