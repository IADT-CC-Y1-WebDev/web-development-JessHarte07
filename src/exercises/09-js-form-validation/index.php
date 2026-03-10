<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>09 – JS Form Validation (Exercises)</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>

<body>
    <div class="back-link">
        <a href="/index.php">&larr; Back to Module Index</a>
        <a href="/examples/09-js-form-validation/">View Examples &rarr;</a>
    </div>

    <h1>09 – JavaScript Form Validation (Exercises)</h1>

    <p>
        These exercises mirror the examples in <code>src/examples/09-js-form-validation</code>.
        You will add client-side validation to the book forms in your project, while keeping
        the server-side PHP validation as the final authority.
    </p>

    <ul class="exercise-list">
        <li><a href="#exercise-1">Exercise 09-1: Standalone books form validation</a></li>
        <li><a href="#exercise-2">Exercise 09-2: Integrate validation into the books project</a></li>
    </ul>

    <h2 id="exercise-1">Exercise 09-1: Standalone books form validation</h2>
    <p>Create a page in the <code>exercises/09-js-form-validation/</code> folder, for example:</p>
    <pre><code>exercises/09-js-form-validation/books-form.php</code></pre>
    <p>On that page, build a form that matches the book create fields from your Books project. Use the same form-handling pattern as the <a href="/examples/09-js-form-validation/01-contact.php">contact example</a> and <a href="/examples/09-js-form-validation/02-games-form.php">games form example</a>.</p>
    <ul>
        <li>Build an HTML form for a book with fields:
            <code>title</code>, <code>author</code>, <code>year</code>, <code>isbn</code>, and <code>description</code>.
        </li>
        <li>At the top of the form, add an error summary div (e.g. <code>&lt;div id="error_summary_top" class="error-summary" style="display:none" role="alert"&gt;&lt;/div&gt;</code>) that will list all validation errors.</li>
        <li>Give each input an <code>id</code> (e.g. <code>id="title"</code>, <code>id="author"</code>). Add an error span under each field with <code>id="fieldname_error"</code> (e.g. <code>&lt;span id="title_error" class="error"&gt;&lt;/span&gt;</code>, <code>id="author_error"</code>, etc.).</li>
        <li>Give the form an <code>id</code> (e.g. <code>book_form</code>), the submit button <code>id="submit_btn"</code>, and set <code>novalidate</code> on the form.</li>
        <li>Create <code>books-form.js</code> in the same folder. Follow the example pattern:
            <ul>
                <li>Get the form, submit button, <code>error_summary_top</code>, each input, and each error span by <code>getElementById</code>. Only attach the submit listener if the form and button exist (e.g. <code>if (bookForm && submitBtn) { submitBtn.addEventListener('click', onSubmitForm); }</code>).</li>
                <li>Use a single object to store errors by field (e.g. <code>let errors = {};</code>).</li>
                <li><code>addError(fieldName, message)</code> — set <code>errors[fieldName] = message</code>.</li>
                <li><code>showErrorSummaryTop()</code> — if there are errors, build a list from <code>Object.values(errors)</code>, set the summary div’s <code>innerHTML</code>, and show it; otherwise hide and clear it.</li>
                <li><code>showFieldErrors()</code> — set each error span’s <code>innerHTML</code> from <code>errors.title</code>, <code>errors.author</code>, etc. (or empty string if none).</li>
                <li>In the submit handler: <code>evt.preventDefault()</code>, reset <code>errors = {}</code>, validate each book field and call <code>addError</code> when invalid, then call <code>showErrorSummaryTop()</code> and <code>showFieldErrors()</code>. If <code>Object.keys(errors).length === 0</code>, call <code>form.submit()</code>.</li>
                <li>Optional: validation helpers such as <code>validateBookTitle(value)</code>, <code>validateBookAuthor(value)</code>, etc., that return an error string or <code>null</code>; the handler can call them and call <code>addError</code> when the return value is non-null.</li>
            </ul>
        </li>
    </ul>

    <h2 id="exercise-2">Exercise 09-2: Integrate validation into the books project</h2>
    <p>Apply the same pattern to your real <code>books</code> application:</p>
    <ul>
        <li>In <code>book_create.php</code> and <code>book_edit.php</code>:
            <ul>
                <li>Add an error summary div at the top of the form (<code>id="error_summary_top"</code>), as in the examples.</li>
                <li>Ensure each input has a unique <code>name</code> and <code>id</code>.</li>
                <li>Add an error span under each field with <code>id="fieldname_error"</code> (e.g. <code>id="title_error"</code>).</li><i>or use the same error span used in your server-side validation</i>
            </ul>
        </li>
        <li>In <code>books/js/book-form-validation.js</code>:
            <ul>
                <li>Use the same structure as the examples: get form, submit button, error summary div, inputs, and error spans by ID. Use an <code>errors</code> object, <code>addError(fieldName, message)</code>, <code>showErrorSummaryTop()</code>, and <code>showFieldErrors()</code>.</li>
                <li>Attach the submit handler (e.g. on <code>submit_btn</code> click) only if the form and button exist. In the handler: prevent default, reset errors, validate each field and call <code>addError</code> when invalid, then update the summary and field errors; submit only when there are no errors.</li>
            </ul>
        </li>
        <li>Include <code>book-form-validation.js</code> at the bottom of your create and edit pages.</li>
    </ul>

    <p>
        Finally, deliberately submit invalid data to confirm that both the JavaScript
        and the existing PHP validation behave as you expect.
    </p>
</body>

</html>