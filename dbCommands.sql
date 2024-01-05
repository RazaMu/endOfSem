CREATE TABLE users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    Full_Name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_Number VARCHAR(20),
    User_Name VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    UserType VARCHAR(50),
    AccessTime DATETIME,
    profile_Image BLOB,
    Address TEXT
);


CREATE TABLE articles (
    authorId INT,
    article_title VARCHAR(255) NOT NULL,
    article_full_text TEXT NOT NULL,
    article_created_date DATETIME NOT NULL,
    article_last_update DATETIME,
    article_display BOOLEAN DEFAULT TRUE,
    article_order INT,
    PRIMARY KEY (article_title),
    FOREIGN KEY (authorId) REFERENCES users(userId)
);


CREATE TABLE articles (
    authorId INT,
    article_title VARCHAR(255) NOT NULL,
    article_full_text TEXT NOT NULL,
    article_created_date DATETIME NOT NULL,
    article_last_update DATETIME,
    article_display BOOLEAN DEFAULT TRUE,
    article_order INT,
    PRIMARY KEY (article_title),
    FOREIGN KEY (authorId) REFERENCES users(userId)
);


INSERT INTO users (Full_Name, email, phone_Number, User_Name, Password, UserType, AccessTime, profile_Image, Address) VALUES ('Ele Rai', 'ele.rai@example.com', '123-456-7890', 'elerai', 'hashed_password', 'Administrator', CURRENT_TIMESTAMP, NULL, '1234 Some Address, City, Country');


-- Story 1
INSERT INTO articles (authorId, article_title, article_full_text, article_created_date, article_last_update, article_display, article_order)
VALUES (1, 'The Adventure of the Lost Key', 'Once upon a time, in a small village, a young boy named Jack found an old key in the forest. Little did he know that this key would lead him on an incredible adventure to unlock the secrets of the enchanted castle.', '2023-01-01', '2023-01-05', 'yes', 1);
