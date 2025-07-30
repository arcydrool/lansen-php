CREATE TABLE contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    company VARCHAR(120),
    email VARCHAR(100) UNIQUE NOT NULL,
    mail VARCHAR(255),
    tel VARCHAR(25),
    interests VARCHAR(255),
    additional TEXT
);