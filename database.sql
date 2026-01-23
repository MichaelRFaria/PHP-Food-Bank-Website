USE foodbank;

-- debug
DROP TABLE IF EXISTS users;

DROP TABLE IF EXISTS remembered_logins;

DROP TABLE IF EXISTS opening_hours;

DROP TABLE IF EXISTS shifts;

DROP TABLE IF EXISTS shift_registration;

-- db creation
CREATE TABLE
    users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        phone VARCHAR(11) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM ("staff", "volunteer") NOT NULL,
        is_over_18 BOOLEAN NOT NULL
    );

CREATE TABLE
    remembered_logins (
        id INT AUTO_INCREMENT,
        uid VARCHAR(255) NOT NULL,
        date DATETIME NOT NULL,
        PRIMARY KEY (id, uid)
    );

CREATE TABLE
    opening_hours (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date DATE NOT NULL UNIQUE,
        open_time TIME NOT NULL,
        close_time TIME NOT NULL
    );

CREATE TABLE
    shifts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        shift_date DATE NOT NULL,
        start_time TIME NOT NULL,
        end_time TIME NOT NULL
    );

CREATE TABLE
    shift_registration (
        id INT AUTO_INCREMENT PRIMARY KEY,
        shift_id INT NOT NULL,
        user_id INT NOT NULL,
        UNIQUE (shift_id, user_id),
        FOREIGN KEY (shift_id) REFERENCES shifts (id),
        FOREIGN KEY (user_id) REFERENCES users (id)
    );

-- insert staff account
INSERT INTO
    users (name, email, phone, password, role, is_over_18)
VALUES
    (
        "Test",
        "test@email.com",
        "12345678901",
        "$2y$12$g8HbZkrCtslS8c.GLPjTsuvKTVEw2Pjx5kabaZnC65qpFGnODNlX2",
        "staff",
        1
    ) -- password = password123
    -- insert opening hours
INSERT INTO
    opening_hours (date, open_time, close_time)
VALUES
    ("2026-01-26", "10:00:00", "19:00:00"),
    ("2026-01-27", "10:00:00", "19:00:00"),
    ("2026-01-28", "11:00:00", "15:00:00"),
    ("2026-01-29", "10:00:00", "18:00:00"),
    ("2026-01-30", "10:00:00", "19:30:00"),
    ("2026-01-31", "09:00:00", "19:30:00"),
    ("2026-02-01", "10:30:00", "16:00:00");

-- insert shift hours