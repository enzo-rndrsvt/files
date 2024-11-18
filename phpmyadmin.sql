DROP TABLE IF EXISTS users;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

INSERT INTO users (username, password) VALUES ('enzo', '$2y$10$56Fakx042s2r17GMZFB4/.6do8JTDNqz0Rkb.seWC2a9oa.WGB976');