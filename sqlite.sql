DROP TABLE IF EXISTS users;

CREATE TABLE users (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL
);

INSERT INTO users (username, password) VALUES ('enzo', '$2y$10$56Fakx042s2r17GMZFB4/.6do8JTDNqz0Rkb.seWC2a9oa.WGB976');
