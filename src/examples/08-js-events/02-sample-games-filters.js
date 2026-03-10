const form = document.getElementById('filters');
const cardsContainer = document.getElementById('game_cards');
const cards = Array.from(cardsContainer.querySelectorAll('.card'));

function getFilters() {
    const titleEl = form.elements['title_filter'];
    const genreEl = form.elements['genre_filter'];
    const platformEl = form.elements['platform_filter'];
    const sortEl = form.elements['sort_by'];
    return {
        titleFilter: (titleEl.value || '').trim().toLowerCase(),
        genreFilter: genreEl.value || '',
        platformFilter: platformEl.value || '',
        sortBy: sortEl.value || 'title_asc'
    };
}

function cardMatches(card, filters) {
    const title = card.dataset.title.toLowerCase();
    const genre = card.dataset.genre;
    const platform = card.dataset.platform;
    const matchTitle =
        filters.titleFilter === '' || title.includes(filters.titleFilter);
    const matchGenre =
        filters.genreFilter === '' || genre === filters.genreFilter;
    const matchPlatform =
        filters.platformFilter === '' || platform === filters.platformFilter;
    return matchTitle && matchGenre && matchPlatform;
}

function sortCards(cards, sortBy) {
    const list = cards.slice();
    list.sort(function (a, b) {
        const titleA = a.dataset.title.toLowerCase();
        const titleB = b.dataset.title.toLowerCase();
        const yearA = Number(a.dataset.year);
        const yearB = Number(b.dataset.year);
        if (sortBy === 'year_desc') return yearB - yearA;
        if (sortBy === 'year_asc') return yearA - yearB;
        return titleA.localeCompare(titleB);
    });
    return list;
}

function applyFilters() {
    const filters = getFilters();
    cards.forEach(function (card) {
        card.classList.toggle('hidden', !cardMatches(card, filters));
    });
    const visible = cards.filter(function (card) {
        return !card.classList.contains('hidden');
    });
    const sorted = sortCards(visible, filters.sortBy);
    sorted.forEach(function (card) {
        cardsContainer.appendChild(card);
    });
}

function clearFilters() {
    form.reset();
    cards.forEach(function (card) {
        card.classList.remove('hidden');
    });
    const byYear = sortCards(cards.slice(), 'year_asc');
    byYear.forEach(function (card) {
        cardsContainer.appendChild(card);
    });
}

document.getElementById('apply_filters').addEventListener('click', (e) => {
    e.preventDefault();
    applyFilters();
});
document.getElementById('clear_filters').addEventListener('click', (e) => {
    e.preventDefault();
    clearFilters();
});
