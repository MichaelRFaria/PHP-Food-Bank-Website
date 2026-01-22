USE foodbank;

-- debug
DROP TABLE IF EXISTS users;

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
-- insert opening hours
-- insert shift hours