<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Project Instructions</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <style>
        .instructions {
            max-width: 900px;
            margin: 0 auto;
            padding: 1rem;
        }
        .instructions h1 {
            border-bottom: 2px solid #333;
            padding-bottom: 0.5rem;
        }
        .instructions h2 {
            margin-top: 2rem;
            border-bottom: 1px solid #ccc;
            padding-bottom: 0.3rem;
        }
        .instructions h3 {
            margin-top: 1.5rem;
            color: #444;
        }
        .instructions h4 {
            margin-top: 1.2rem;
            color: #555;
        }
        .instructions pre {
            background: #f4f4f4;
            padding: 1rem;
            border-radius: 4px;
            overflow-x: auto;
            font-size: 0.9rem;
            line-height: 1.4;
        }
        .instructions code {
            background: #f4f4f4;
            padding: 0.15rem 0.4rem;
            border-radius: 3px;
            font-size: 0.9em;
        }
        .instructions pre code {
            background: none;
            padding: 0;
        }
        .instructions table {
            border-collapse: collapse;
            width: 100%;
            margin: 1rem 0;
        }
        .instructions th,
        .instructions td {
            border: 1px solid #ddd;
            padding: 0.6rem;
            text-align: left;
        }
        .instructions th {
            background: #f4f4f4;
        }
        .instructions ul.checklist {
            list-style: none;
            padding-left: 0;
        }
        .instructions ul.checklist li {
            padding: 0.3rem 0;
            padding-left: 1.8rem;
            position: relative;
        }
        .instructions ul.checklist li::before {
            content: "☐";
            position: absolute;
            left: 0;
            color: #666;
        }
        .instructions .phase {
            background: #f9f9f9;
            border-left: 4px solid #007bff;
            padding: 1rem;
            margin: 1rem 0;
        }
        .instructions .phase.phase-js {
            border-left-color: #f0ad4e;
        }
        .instructions hr {
            border: none;
            border-top: 2px solid #eee;
            margin: 2rem 0;
        }
        .instructions .note {
            background: #fff3cd;
            border: 1px solid #ffc107;
            padding: 1rem;
            border-radius: 4px;
            margin: 1rem 0;
        }
        .back-link {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="instructions">
        <p class="back-link"><a href="/index.php">&larr; Back to Module Home</a></p>

        <h1>Books Application Project</h1>

        <h2>Overview</h2>
        <p>
            Build a complete CRUD (Create, Read, Update, Delete) application for managing books.
            Your application should follow the same structure and patterns as the
            <a href="../games/">Games example application</a>.
        </p>
        <p>This project is completed in two phases:</p>
        <ul>
            <li><strong>Phase 1 (PHP):</strong> Complete after finishing the PHP exercises (01-05)</li>
            <li><strong>Phase 2 (JavaScript):</strong> Complete after finishing the JavaScript exercises (06-09)</li>
        </ul>

        <h2>Database</h2>
        <p>
            Your application uses the <code>books</code> database tables, which are already set up
            via <code>src/sql/books.sql</code>. The schema includes:
        </p>
        <table>
            <thead>
                <tr>
                    <th>Table</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>books</code></td>
                    <td>Main table with id, title, author, publisher_id, year, isbn, description, cover_filename</td>
                </tr>
                <tr>
                    <td><code>publishers</code></td>
                    <td>Lookup table (one-to-many with books)</td>
                </tr>
                <tr>
                    <td><code>formats</code></td>
                    <td>Lookup table (many-to-many with books)</td>
                </tr>
                <tr>
                    <td><code>book_format</code></td>
                    <td>Junction table for books-formats relationship</td>
                </tr>
            </tbody>
        </table>
        <p>
            For this project, focus on the <code>books</code> table. Advanced students may extend
            the application to manage <code>publishers</code> and <code>formats</code> as well.
        </p>

        <h2>Project Structure</h2>
        <p>Your application should follow this folder structure:</p>
        <pre><code>books/
├── index.php              # Landing page / navigation
├── book_list.php          # Display all books
├── book_view.php          # Display a single book
├── book_create.php        # Form to create a new book
├── book_store.php         # Handle create form submission
├── book_edit.php          # Form to edit an existing book
├── book_update.php        # Handle edit form submission
├── book_delete.php        # Handle book deletion
├── css/                   # Stylesheets
├── images/                # Book cover images
├── js/                    # JavaScript files (Phase 2)
└── php/
    ├── classes/           # Active Record classes (Book.php, DB.php, etc.)
    ├── inc/               # Reusable HTML snippets (head, flash messages, etc.)
    └── lib/               # Configuration and utility functions</code></pre>
        <p>Refer to the <a href="../games/">games</a> folder to see how these files and folders are organised.</p>

        <hr>

        <h2>Phase 1: PHP</h2>
        <div class="phase">
            <strong>Complete this phase after finishing the PHP exercises (01-05).</strong>
        </div>

        <h3>Suggested Build Order</h3>
        <p>
            We recommend building in this order, as each step builds on the previous one.
            You may deviate if you are confident, but this sequence will minimise frustration.
        </p>

        <h4>Step 1: Database Connection</h4>
        <p>Create the database connection class.</p>
        <ul class="checklist">
            <li>Create <code>php/lib/config.php</code> with database credentials</li>
            <li>Create <code>php/classes/DB.php</code> with a singleton database connection class</li>
            <li>Test the connection works</li>
        </ul>

        <h4>Step 2: Book Class</h4>
        <p>Create the Book Active Record class.</p>
        <ul class="checklist">
            <li>Create <code>php/classes/Book.php</code></li>
            <li>Implement <code>findAll()</code> method to retrieve all books</li>
            <li>Implement <code>findById($id)</code> method to retrieve a single book</li>
            <li>Implement <code>save()</code> method to insert a new book</li>
            <li>Implement <code>update()</code> method to update an existing book</li>
            <li>Implement <code>delete()</code> method to delete a book</li>
        </ul>

        <h4>Step 3: List Page</h4>
        <p>Create the page that displays all books.</p>
        <ul class="checklist">
            <li>Create <code>book_list.php</code></li>
            <li>Include the database connection and Book class</li>
            <li>Retrieve all books using <code>Book::findAll()</code></li>
            <li>Display books in an HTML table or card layout</li>
            <li>Add links to view, edit, and delete each book</li>
            <li>Add a link to create a new book</li>
        </ul>

        <h4>Step 4: View Page</h4>
        <p>Create the page that displays a single book.</p>
        <ul class="checklist">
            <li>Create <code>book_view.php</code></li>
            <li>Get the book ID from the query string (<code>$_GET['id']</code>)</li>
            <li>Retrieve the book using <code>Book::findById($id)</code></li>
            <li>Display the book details</li>
            <li>Handle the case where the book is not found</li>
            <li>Add navigation links (back to list, edit, delete)</li>
        </ul>

        <h4>Step 5: Create Form and Handler</h4>
        <p>Implement the ability to add new books.</p>
        <ul class="checklist">
            <li>Create <code>book_create.php</code> with an HTML form</li>
            <li>Include fields for: title, author, year, isbn, description</li>
            <li>Create <code>book_store.php</code> to handle form submission</li>
            <li>Validate the submitted data</li>
            <li>Create a new Book object and save it</li>
            <li>Redirect to the list or view page after successful creation</li>
            <li>Handle validation errors (redisplay form with error messages)</li>
        </ul>

        <h4>Step 6: Edit Form and Handler</h4>
        <p>Implement the ability to edit existing books.</p>
        <ul class="checklist">
            <li>Create <code>book_edit.php</code> with an HTML form</li>
            <li>Load the existing book data into the form fields</li>
            <li>Create <code>book_update.php</code> to handle form submission</li>
            <li>Validate the submitted data</li>
            <li>Update the book and save changes</li>
            <li>Redirect after successful update</li>
            <li>Handle validation errors</li>
        </ul>

        <h4>Step 7: Delete Handler</h4>
        <p>Implement the ability to delete books.</p>
        <ul class="checklist">
            <li>Create <code>book_delete.php</code></li>
            <li>Get the book ID from the query string or form submission</li>
            <li>Delete the book from the database</li>
            <li>Redirect to the list page after deletion</li>
        </ul>

        <h4>Step 8: Landing Page</h4>
        <p>Create the application landing page.</p>
        <ul class="checklist">
            <li>Create <code>index.php</code></li>
            <li>Add navigation to the book list</li>
            <li>Include any welcome content or application description</li>
        </ul>

        <h4>Step 9: Polish</h4>
        <p>Refine the application.</p>
        <ul class="checklist">
            <li>Create reusable includes in <code>php/inc/</code> (e.g., head content, flash messages)</li>
            <li>Add CSS styling in <code>css/</code></li>
            <li>Ensure consistent navigation across all pages</li>
            <li>Add flash messages for success/error feedback</li>
            <li>Test all CRUD operations thoroughly</li>
        </ul>

        <h3>Reference</h3>
        <p>Study the <a href="../games/">games</a> application carefully:</p>
        <ul>
            <li>Examine how each PHP file is structured</li>
            <li>Note how the Active Record classes are implemented</li>
            <li>Observe how forms handle validation and error display</li>
            <li>See how flash messages provide user feedback</li>
        </ul>

        <hr>

        <h2>Phase 2: JavaScript</h2>
        <div class="phase phase-js">
            <strong>Complete this phase after finishing the JavaScript exercises (06-09).</strong>
        </div>

        <h3>Goals</h3>
        <p>Enhance your PHP application with JavaScript to improve the user experience.</p>

        <h3>Requirements</h3>
        <div class="note">
            <em>Detailed requirements will be provided after completing the JavaScript exercises.</em>
        </div>

        <h3>Potential Enhancements</h3>
        <p>The following are examples of how JavaScript might enhance your application:</p>
        <ul>
            <li>Client-side form validation before submission</li>
            <li>Confirmation dialogs for destructive actions (delete)</li>
            <li>Dynamic form field validation with immediate feedback</li>
            <li>Enhanced UI interactions</li>
        </ul>

        <hr>

        <h2>Submission</h2>
        <p><em>Your submission requirements and deadlines will be provided separately.</em></p>

        <p class="back-link" style="margin-top: 2rem;"><a href="/index.php">&larr; Back to Module Home</a></p>
    </div>
</body>
</html>
