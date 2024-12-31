/*
 * Name: Ha Nhu Y Tran, Cheng Qian - Group 9
 * Assignment 2
 * Date: Nov 23, 2024
 * Description: This script is to create the database for BookSpace which is a platform that manages a catalog of books, user preferences, and reviews. 
 * It includes user roles and preferences for genre-based recommendations, while also supporting book reviews and ratings.
 * Foreign key relationships are established between the tables to ensure data integrity, and sample data is inserted for all the tables. 
 */

CREATE DATABASE IF NOT EXISTS bookspace;
GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON bookspace.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

USE bookspace;

CREATE TABLE IF NOT EXISTS genres (
    genre_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    genre_name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO genres (genre_name) VALUES
('Fiction'),
('Biography'),
('History'),
('Technology');

CREATE TABLE covers (
    cover_id INT AUTO_INCREMENT PRIMARY KEY,
    cover_url VARCHAR(255),
    alt_text VARCHAR(255),
    caption TEXT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO covers (cover_url, alt_text, caption) VALUES
('images/cover1.jpeg', 'Cover of Where the Crawdads Sing', 'Cover of Where the Crawdads Sing, source: https://biblioottawalibrary.ca/'),
('images/cover2.jpeg', 'Cover of The Silent Patient', 'Cover of The Silent Patient, source: https://biblioottawalibrary.ca/'),
('images/cover3.jpeg', 'Cover of The Vanishing Half', 'Cover of The Vanishing Half, source: https://biblioottawalibrary.ca/'),
('images/cover4.jpeg', 'Cover of Patriot: a Memoir', 'Cover of Patriot: a Memoir, source: https://biblioottawalibrary.ca/'),
('images/cover5.jpeg', 'Cover of Uncommon: Simple Principles for An Extraordinary Life', 'Cover of Uncommon: Simple Principles for An Extraordinary Life, source: https://biblioottawalibrary.ca/'),
('images/cover6.jpeg', 'Cover of Dorothy Parker in Hollywood', 'Cover of Dorothy Parker in Hollywood, source: https://biblioottawalibrary.ca/'),
('images/cover7.jpeg', 'Cover of The Silk Roads: A New History of the World', 'Cover of The Silk Roads: A New History of the World, source: https://biblioottawalibrary.ca/'),
('images/cover8.jpeg', 'Cover of The Missing Thread', 'Cover of The Missing Thread, source: https://biblioottawalibrary.ca/'),
('images/cover9.jpeg', 'Cover of Stealing History: Tomb Raiders, Smugglers, and the Looting of the Ancient World', 'Cover of Stealing History: Tomb Raiders, Smugglers, and the Looting of the Ancient World, source: https://biblioottawalibrary.ca/'),
('images/cover10.jpeg', 'Cover of C++ Data Structures and Algorithms', 'Cover of C++ Data Structures and Algorithms, source: https://biblioottawalibrary.ca/'),
('images/cover11.jpeg', 'Cover of API Design Patterns', 'Cover of API Design Patterns, source: https://biblioottawalibrary.ca/'),
('images/cover12.jpeg', 'Cover of Hacking APIs: Breaking Web Application Programming Interfaces', 'Cover of Hacking APIs: Breaking Web Application Programming Interfaces, source: https://biblioottawalibrary.ca/');


CREATE TABLE IF NOT EXISTS books (
book_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100) NOT NULL,
author VARCHAR(100) NOT NULL,
isbn VARCHAR(13) NOT NULL UNIQUE,
cover_id INT,
genre_id INT NOT NULL,
publication_year INT,
summary TEXT,
reference_source TEXT,
FOREIGN KEY (genre_id) REFERENCES genres(genre_id) ON DELETE CASCADE,
FOREIGN KEY (cover_id) REFERENCES covers(cover_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Insert 12 example book records, 3 books for each genre
INSERT INTO books (title, author, isbn, cover_id, genre_id, publication_year, summary, reference_source) VALUES
('Where the Crawdads Sing', 'Delia Owens', '9780735219090', 1, 1, 2018, 'For years, rumors of the "Marsh Girl" have haunted Barkley Cove, a quiet town on the North Carolina coast. She''s barefoot and wild; unfit for polite society. So in late 1969, when handsome Chase Andrews is found dead, the locals immediately suspect Kya Clark. But Kya is not what they say. Abandoned at age ten, she has survived on her own in the marsh that she calls home. A born naturalist with just one day of school, she takes life lessons from the land, learning from the false signals of fireflies the real way of this world. But while she could have lived in solitude forever, the time comes when she yearns to be touched and loved. Drawn to two young men from town, who are each intrigued by her wild beauty, Kya opens herself to a new and startling world-- until the unthinkable happens.', 'https://biblioottawalibrary.ca/'),
('The Silent Patient', 'Alex Michaelides', '9781250230782', 2, 1, 2019, 'Alicia Berenson''s life is seemingly perfect. A famous painter married to an in-demand fashion photographer, she lives in a grand house with big windows overlooking a park in one of London''s most desirable areas. One evening her husband Gabriel returns home late from a fashion shoot, and Alicia shoots him five times in the face, and then never speaks another word. Alicia''s refusal to talk, or give any kind of explanation, turns a domestic tragedy into something far grander, a mystery that captures the public imagination and casts Alicia into notoriety. The price of her art skyrockets, and she, the silent patient, is hidden away from the tabloids and spotlight at the Grove, a secure forensic unit in North London. Theo Faber is a criminal psychotherapist who has waited a long time for the opportunity to work with Alicia. His determination to get her to talk and unravel the mystery of why she shot her husband takes him down a twisting path into his own motivations--a search for the truth that threatens to consume him...', 'https://biblioottawalibrary.ca/'),
('The Vanishing Half', 'Brit Bennett', '9780525536291', 3, 1, 2020, 'The Vignes twin sisters will always be identical. But after growing up together in a small, southern black community and running away at age sixteen, it''s not just the shape of their daily lives that is different as adults, it''s everything: their families, their communities, their racial identities. Ten years later, one sister lives with her black daughter in the same southern town she once tried to escape. The other secretly passes for white, and her white husband knows nothing of her past. Still, even separated by so many miles and just as many lies, the fates of the twins remain intertwined. What will happen to the next generation, when their own daughters'' storylines intersect?', 'https://biblioottawalibrary.ca/'),
('Patriot: a Memoir', 'Alexei Navalny', '9780593320969', 4, 2, 2024, 'A political freedom fighter who paid the ultimate price for his convictions recounts his political career, the many attempts on his life and the lives of the people closest to him and the relentless campaign he and his team waged against an increasingly dictatorial regime.', 'https://biblioottawalibrary.ca/'),
('Uncommon: Simple Principles for An Extraordinary Life', 'Mark Divine', '9781250331908', 5, 2, 2024, 'From former Navy SEAL, entrepreneur, father, and New York Times bestselling author Mark Divine comes Uncommon- an inspirational book following Mark Divine''s trademark warrior monk philosophy that will lead you to the summit of personal development.', 'https://biblioottawalibrary.ca/'),
('Dorothy Parker in Hollywood', 'Gail Crowther', '9781982185794', 6, 2, 2024, 'The glamorous extravagances and devastating lows of her time in Hollywood are revealed as never before in this fresh new biography of Dorothy Parker--from leaving New York City to work on numerous classic screenplays such as the 1937 A Star Is Born to the devastation of alcoholism, a miscarriage, and her husband''s suicide.', 'https://biblioottawalibrary.ca/'),
('The Silk Roads: A New History of the World', 'Peter Frankopan', '9781101912379', 7, 3, 2017, 'By way of events as disparate as the American Revolution and the horrific world wars of the twentieth century, Peter Frankopan realigns the world, orientating us eastwards, and illuminating how even the rise of the West 500 years ago resulted from its efforts to gain access to and control these Eurasian trading networks.', 'https://biblioottawalibrary.ca/'),
('The Missing Thread', 'Daisy Dunn', '9780593299661', 8, 3, 2024, 'A dazzlingly ambitious history of the ancient world that places women at the center--from Cleopatra to Boudica, Sappho to Fulvia, and countless other artists, writers, leaders, and creators of history.', 'https://biblioottawalibrary.ca/'),
('Stealing History: Tomb Raiders, Smugglers, and the Looting of the Ancient World', 'Roger Atwood', '9780312324063', 9, 3, 2004, 'In this fascinating book, Atwood takes readers on a journey through Iraq, Peru, Hong Kong, and across America, showing how the worldwide antiquities trade is destroying what''s left of the ancient sites before archaeologists can reach them, and thus erasing their historical significance.', 'https://biblioottawalibrary.ca/'),
('C++ Data Structures and Algorithms', 'Wisnu Anggoro', '9781788835213', 10, 4, 2018, 'C++ is a general purpose programming language which has evolved over the years and is used to develop software for many different sectors. This book will be your companion as it takes you through implementing classic data structures and algorithms to help you get up and running as a confident C++ programmer.', 'https://biblioottawalibrary.ca/'),
('API Design Patterns', 'J. J. Geewax', '9781617295850', 11, 4, 2021, 'A collection of best practices and design standards for web and internal APIs. In API Design Patterns you will learn: Guiding principles for API patterns; Fundamentals of resource layout and naming; Handling data types for any programming language; Standard methods that ensure predictability.', 'https://biblioottawalibrary.ca/'),
('Hacking APIs: Breaking Web Application Programming Interfaces', 'Corey Ball', '9781718502444', 12, 4, 2022, 'Teaches how to penetration-test APIs, make APIs more secure, set up a streamlined API testing lab with Burp Suite and Postman, and master tools for reconnaissance, endpoint analysis, and fuzzing.', 'https://biblioottawalibrary.ca/');



CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'testuser1', 'testuser1@example.com', 'testuser1', 'user'),
(2, 'testuser2', 'testuser2@example.com', 'testuser2', 'user'),
(3, 'cheng.qian', 'qian0042@algonquinlive.com', 'qian0042', 'user'),
(4, 'bookworm', 'bookworm@example.com', 'bookworm', 'user');


CREATE TABLE IF NOT EXISTS user_preferences (
    preference_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    genre_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id) ON DELETE CASCADE,
	UNIQUE (user_id, genre_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_preferences` (`preference_id`, `user_id`, `genre_id`) VALUES
(2, 1, 1),
(1, 1, 2),
(3, 2, 4),
(4, 3, 1),
(5, 3, 3),
(6, 4, 1),
(7, 4, 3),
(8, 4, 4);

CREATE TABLE IF NOT EXISTS reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    user_id INT NOT NULL,
    rating TINYINT CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `reviews` (`review_id`, `book_id`, `user_id`, `rating`, `review_text`, `review_date`) VALUES
(1, 4, 1, 5, 'Really love this one.', '2024-11-23 03:29:55'),
(2, 10, 1, 1, 'Do not wanna learn it.', '2024-11-23 03:30:18'),
(3, 9, 1, 4, 'So interesting.', '2024-11-23 03:30:45'),
(4, 7, 1, 4, 'Good to read.', '2024-11-23 03:31:32'),
(5, 5, 1, 1, 'Nonsense.', '2024-11-23 03:31:55'),
(6, 9, 2, 5, 'I wanna try.', '2024-11-23 03:33:33'),
(7, 8, 2, 5, 'Amazing.', '2024-11-23 03:33:52'),
(8, 11, 2, 5, 'Good reference.', '2024-11-23 03:34:15'),
(9, 12, 2, 3, 'Just fine.', '2024-11-23 03:34:34'),
(10, 10, 2, 4, 'Good enough.', '2024-11-23 03:35:03'),
(11, 9, 3, 5, 'Learning so much from it!', '2024-11-23 03:37:41'),
(12, 11, 3, 5, 'Great guide, really helpful!!!', '2024-11-23 03:38:10'),
(13, 3, 3, 4, 'Heartbreaking story.', '2024-11-23 03:38:56'),
(14, 2, 3, 2, 'Ridiculous', '2024-11-23 03:39:45'),
(15, 8, 3, 4, 'Enjoyed reading this.', '2024-11-23 03:41:16'),
(16, 10, 3, 3, 'I love programming.', '2024-11-23 03:41:36'),
(17, 4, 4, 5, 'Who wants to live forever', '2024-11-23 03:43:05'),
(18, 5, 4, 5, 'An Extraordinary Life!', '2024-11-23 03:43:23'),
(19, 6, 4, 1, 'Not worth any time.', '2024-11-23 03:43:44'),
(20, 1, 4, 1, 'A waste of time.', '2024-11-23 03:44:02'),
(21, 2, 4, 4, 'Like this story anyway.', '2024-11-23 03:44:24'),
(22, 3, 4, 3, '......why', '2024-11-23 03:44:39'),
(23, 7, 4, 1, 'too boring', '2024-11-23 03:44:56'),
(24, 12, 4, 3, 'Wish I can learn to hack.', '2024-11-23 03:45:59');


