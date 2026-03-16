<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>08 – JS Events (Exercises)</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>

<body>
    <div class="back-link">
        <a href="/index.php">&larr; Back to Module Index</a>
        <a href="/examples/08-js-events/">View Examples &rarr;</a>
    </div>

    <h1>08 – JavaScript Events (Exercises)</h1>

    <p>
        Create a filter/sorting system for your books project, using the same pattern as Example 08-2 (games: title, genre, platform, sort; Apply Filters / Clear Filters).
    </p>

    <ul class="exercise-list">
        <li><a href="#exercise-1">Exercise 08-1: Books filter form</a></li>
        <li><a href="#exercise-2">Exercise 08-2: Integrate filters into the books project</a></li>
    </ul>

    <h2 id="exercise-1">Exercise 08-1: Books filter form</h2>
    <p>Follow the same pattern as Example 08-2 (<b>games</b>: title, genre, platform, sort; <b>books</b>: title and year):</p>
    <p>Create a new page in the <code>exercises/08-js-events/</code> folder, for example:</p>
    <pre><code>exercises/08-js-events/books-filters.php</code></pre>
    <p>On that page:</p>
    <ul>
        <li>Display an array of books in PHP as <code>.book-card</code> elements with <code>data-title</code>, <code>data-author</code> and <code>data-year</code>.</li>
        <li>Add a filter form above the list with:
            <ul>
                <li>Text input <code>title_filter</code></li>
                <li>Select <code>year_filter</code> (e.g. "All years", "Before 2000", "2000 and later")</li>
                <li>Apply Filters and Clear Filters buttons</li>
            </ul>
        </li>
        <li>Create a new file <code>books-filters.js</code> in the <code>exercises/08-js-events/</code> folder, following the pattern in <code>02-sample-games-filters.js</code>:
            <ul>
                <li>Write <code>getFilters()</code> that uses <code>form.elements['field_name']</code> to read the form and returns an object with the current filter values (e.g. <code>titleFilter</code>, <code>yearFilter</code>).</li>
                <li>Write <code>cardMatches(card, filters)</code> that returns <code>true</code> or <code>false</code> for one card based on the filters.</li>
                <li>Write <code>sortCards(cards, sortBy)</code> that returns a new sorted array (use <code>cards.slice()</code> then <code>.sort()</code>).</li>
                <li>Write <code>applyFilters()</code> (get filters, toggle <code>hidden</code> on cards, then reorder visible cards with <code>sortCards</code> and <code>appendChild</code>) and <code>clearFilters()</code> (reset form, remove <code>hidden</code>, re-sort and append).</li>
                <li>Attach <code>addEventListener('click', ...)</code> to the Apply Filters and Clear Filters buttons, calling <code>applyFilters()</code> and <code>clearFilters()</code>.</li>
            </ul>
        </li>
    </ul>

    <h2 id="exercise-2">Exercise 08-2: Integrate filters into the books project</h2>
    <p>Now add filters to your actual <code>books</code> application, using the same pattern as <code>02-sample-games-filters.js</code> (<code>getFilters()</code>, <code>cardMatches()</code>, <code>sortCards()</code>, <code>applyFilters()</code>, <code>clearFilters()</code>):</p>
    <ul>
        <li>In <code>book_list.php</code>:
            <ul>
                <li>Add a small filter form above the list (title text input, publisher or year filter, optional sort select, Apply Filters and Clear Filters buttons).</li>
                <li>Render each book as a <code>.book-card</code> (or table row) with useful <code>data-*</code> attributes.</li>
            </ul>
        </li>
        <li>Create <code>js/books-filters.js</code>:
            <ul>
                <li>Implement <code>getFilters()</code> (using <code>form.elements</code>), <code>cardMatches(card, filters)</code>, <code>sortCards(cards, sortBy)</code>, <code>applyFilters()</code>, and <code>clearFilters()</code> following the pattern in the sample games filters.</li>
                <li>Attach event listeners to the Apply Filters and Clear Filters buttons and call <code>applyFilters()</code> and <code>clearFilters()</code>.</li>
            </ul>
        </li>
        <li>Include <code>books-filters.js</code> from <code>book_list.php</code> so it runs on that page.</li>
    </ul>

    <p>
        Test your filters by combining different title and publisher/year filters.
        Remember: PHP still renders all of the books – JavaScript only decides which
        ones are visible and in what order.
    </p>
</body>

</html>