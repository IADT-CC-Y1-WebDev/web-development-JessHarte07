-- Books Database Schema for PDO Exercises
-- Run this script to create the tables and sample data

-- Drop existing tables (in reverse order of dependencies)
DROP TABLE IF EXISTS book_format;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS formats;
DROP TABLE IF EXISTS publishers;

-- Create publishers table (one-to-many relationship with books)
CREATE TABLE publishers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create formats table (many-to-many relationship with books)
CREATE TABLE formats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Create books table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255),
    publisher_id INT,
    year INT,
    isbn VARCHAR(20),
    description TEXT,
    cover_filename VARCHAR(255),
    FOREIGN KEY (publisher_id) REFERENCES publishers(id) ON DELETE SET NULL
);

-- Create junction table for books and formats (many-to-many)
CREATE TABLE book_format (
    book_id INT NOT NULL,
    format_id INT NOT NULL,
    PRIMARY KEY (book_id, format_id),
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (format_id) REFERENCES formats(id) ON DELETE CASCADE
);

-- Insert sample publishers
INSERT INTO publishers (name) VALUES
    ('Penguin Random House'),
    ('HarperCollins'),
    ('Simon & Schuster'),
    ('Hachette Book Group'),
    ('Macmillan Publishers'),
    ('Scholastic'),
    ('O''Reilly Media');

-- Insert formats
INSERT INTO formats (name) VALUES
    ('Hardcover'),
    ('Paperback'),
    ('Ebook'),
    ('Audiobook');

-- Insert sample books
INSERT INTO books (title, author, publisher_id, year, isbn, description, cover_filename) VALUES
    ('To Kill a Mockingbird', 'Harper Lee', 2, 1960, '978-0061120084', 'A gripping tale of racial injustice and childhood innocence in the American South.', 'mockingbird.jpg'),
    ('1984', 'George Orwell', 1, 1949, '978-0451524935', 'A dystopian novel about totalitarianism and surveillance.', '1984.jpg'),
    ('Pride and Prejudice', 'Jane Austen', 1, 1813, '978-0141439518', 'A romantic novel about the Bennet family and the proud Mr. Darcy.', 'pride-prejudice.jpg'),
    ('The Great Gatsby', 'F. Scott Fitzgerald', 3, 1925, '978-0743273565', 'A story of decadence and excess in Jazz Age America.', 'gatsby.jpg'),
    ('Harry Potter and the Philosopher''s Stone', 'J.K. Rowling', 6, 1997, '978-0747532743', 'The first book in the beloved Harry Potter series.', 'hp-stone.jpg'),
    ('Learning PHP, MySQL & JavaScript', 'Robin Nixon', 7, 2018, '978-1491978917', 'A comprehensive guide to web development with PHP and MySQL.', 'learning-php.jpg'),
    ('Clean Code', 'Robert C. Martin', 1, 2008, '978-0132350884', 'A handbook of agile software craftsmanship.', 'clean-code.jpg'),
    ('The Hobbit', 'J.R.R. Tolkien', 2, 1937, '978-0547928227', 'A fantasy novel about Bilbo Baggins'' unexpected adventure.', 'hobbit.jpg'),
    ('Dune', 'Frank Herbert', 1, 1965, '978-0441172719', 'An epic science fiction novel set on the desert planet Arrakis.', 'dune.jpg'),
    ('The Catcher in the Rye', 'J.D. Salinger', 4, 1951, '978-0316769488', 'A coming-of-age story following Holden Caulfield in New York City.', 'catcher-rye.jpg');

-- Insert book-format relationships
-- To Kill a Mockingbird: All formats
INSERT INTO book_format (book_id, format_id) VALUES (1, 1), (1, 2), (1, 3), (1, 4);

-- 1984: All formats
INSERT INTO book_format (book_id, format_id) VALUES (2, 1), (2, 2), (2, 3), (2, 4);

-- Pride and Prejudice: Paperback, Ebook
INSERT INTO book_format (book_id, format_id) VALUES (3, 2), (3, 3);

-- The Great Gatsby: All formats
INSERT INTO book_format (book_id, format_id) VALUES (4, 1), (4, 2), (4, 3), (4, 4);

-- Harry Potter: All formats
INSERT INTO book_format (book_id, format_id) VALUES (5, 1), (5, 2), (5, 3), (5, 4);

-- Learning PHP: Paperback, Ebook
INSERT INTO book_format (book_id, format_id) VALUES (6, 2), (6, 3);

-- Clean Code: Paperback, Ebook
INSERT INTO book_format (book_id, format_id) VALUES (7, 2), (7, 3);

-- The Hobbit: All formats
INSERT INTO book_format (book_id, format_id) VALUES (8, 1), (8, 2), (8, 3), (8, 4);

-- Dune: All formats
INSERT INTO book_format (book_id, format_id) VALUES (9, 1), (9, 2), (9, 3), (9, 4);

-- The Catcher in the Rye: Hardcover, Paperback, Ebook
INSERT INTO book_format (book_id, format_id) VALUES (10, 1), (10, 2), (10, 3);
