let applyBtn = document.getElementById('apply_filters');
let clearBtn = document.getElementById('clear_filters');

let cards = document.querySelectorAll('.card');

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
        let match = cardMatches(card, filters);
        card.classList.toggle('hidden', !match)
    }
    console.log(matches);

}

function cardMatches(crd, fltrs){
    console.log(crd.dataset.title, fltrs.titleFilter);
    let title    = crd.dataset.title.toLowerCase();
    let genre    = crd.dataset.genre;
    let platform = crd.dataset.platform;

    let matchTitle    = fltrs.titleFilter ===    "" ||title.includes(fltrs.titleFilter)
    let matchGenre    = fltrs.genreFilter ===    "" ||genre === fltrs.genreFilter;
    let matchPlatform = fltrs.platformFilter === "" ||platform === fltrs.platformFilter;

    return matchTitle && matchGenre && matchPlatform;
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


function sortCards (cards, sortBy){
    const list = cards.slice()

    list.sort((a,b) => 
            let titleA = a.dataset.title.toLowerCase{};
            let titleB = b.dataset.title.toLowerCase{};
            let yearA = Number(a.dataset.year);
            let yearB = Number(b.dataset.year);

            if (sortBy == "year_desc") return yearB - yearA;
            if (sortBy == "year_asc") return yearA - yearB;

            return titleA.localeCompare(titleB));

        
    return list
}