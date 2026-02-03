# Books Application Project

## Overview

Build a complete CRUD (Create, Read, Update, Delete) application for managing books. Your application should follow the same structure and patterns as the Games example application in `../games/`.

This project is completed in two phases:

- **Phase 1 (PHP):** Complete after finishing the PHP exercises (01-05)
- **Phase 2 (JavaScript):** Complete after finishing the JavaScript exercises (06-09)

## Database

Your application uses the `books` database tables, which are already set up via `src/sql/books.sql`. The schema includes:

| Table | Description |
|-------|-------------|
| `books` | Main table with id, title, author, publisher_id, year, isbn, description, cover_filename |
| `publishers` | Lookup table (one-to-many with books) |
| `formats` | Lookup table (many-to-many with books) |
| `book_format` | Junction table for books-formats relationship |

For this project, focus on the `books` table. Advanced students may extend the application to manage `publishers` and `formats` as well.

## Project Structure

Your application should follow this folder structure:

```
books/
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
    └── lib/               # Configuration and utility functions
```

Refer to the `../games/` folder to see how these files and folders are organised.

---

## Phase 1: PHP

Complete this phase after finishing the PHP exercises (01-05).

### Suggested Build Order

We recommend building in this order, as each step builds on the previous one. You may deviate if you are confident, but this sequence will minimise frustration.

#### Step 1: Database Connection

Create the database connection class.

- [ ] Create `php/lib/config.php` with database credentials
- [ ] Create `php/classes/DB.php` with a singleton database connection class
- [ ] Test the connection works

#### Step 2: Book Class

Create the Book Active Record class.

- [ ] Create `php/classes/Book.php`
- [ ] Implement `findAll()` method to retrieve all books
- [ ] Implement `findById($id)` method to retrieve a single book
- [ ] Implement `save()` method to insert a new book
- [ ] Implement `update()` method to update an existing book
- [ ] Implement `delete()` method to delete a book

#### Step 3: List Page

Create the page that displays all books.

- [ ] Create `book_list.php`
- [ ] Include the database connection and Book class
- [ ] Retrieve all books using `Book::findAll()`
- [ ] Display books in an HTML table or card layout
- [ ] Add links to view, edit, and delete each book
- [ ] Add a link to create a new book

#### Step 4: View Page

Create the page that displays a single book.

- [ ] Create `book_view.php`
- [ ] Get the book ID from the query string (`$_GET['id']`)
- [ ] Retrieve the book using `Book::findById($id)`
- [ ] Display the book details
- [ ] Handle the case where the book is not found
- [ ] Add navigation links (back to list, edit, delete)

#### Step 5: Create Form and Handler

Implement the ability to add new books.

- [ ] Create `book_create.php` with an HTML form
- [ ] Include fields for: title, author, year, isbn, description
- [ ] Create `book_store.php` to handle form submission
- [ ] Validate the submitted data
- [ ] Create a new Book object and save it
- [ ] Redirect to the list or view page after successful creation
- [ ] Handle validation errors (redisplay form with error messages)

#### Step 6: Edit Form and Handler

Implement the ability to edit existing books.

- [ ] Create `book_edit.php` with an HTML form
- [ ] Load the existing book data into the form fields
- [ ] Create `book_update.php` to handle form submission
- [ ] Validate the submitted data
- [ ] Update the book and save changes
- [ ] Redirect after successful update
- [ ] Handle validation errors

#### Step 7: Delete Handler

Implement the ability to delete books.

- [ ] Create `book_delete.php`
- [ ] Get the book ID from the query string or form submission
- [ ] Delete the book from the database
- [ ] Redirect to the list page after deletion

#### Step 8: Landing Page

Create the application landing page.

- [ ] Create `index.php`
- [ ] Add navigation to the book list
- [ ] Include any welcome content or application description

#### Step 9: Polish

Refine the application.

- [ ] Create reusable includes in `php/inc/` (e.g., head content, flash messages)
- [ ] Add CSS styling in `css/`
- [ ] Ensure consistent navigation across all pages
- [ ] Add flash messages for success/error feedback
- [ ] Test all CRUD operations thoroughly

### Reference

Study the `../games/` application carefully:

- Examine how each PHP file is structured
- Note how the Active Record classes are implemented
- Observe how forms handle validation and error display
- See how flash messages provide user feedback

---

## Phase 2: JavaScript

Complete this phase after finishing the JavaScript exercises (06-09).

### Goals

Enhance your PHP application with JavaScript to improve the user experience.

### Requirements

*Detailed requirements will be provided after completing the JavaScript exercises.*

### Potential Enhancements

The following are examples of how JavaScript might enhance your application:

- Client-side form validation before submission
- Confirmation dialogs for destructive actions (delete)
- Dynamic form field validation with immediate feedback
- Enhanced UI interactions

---

## Submission

*(Your submission requirements and deadlines will be provided separately.)*
