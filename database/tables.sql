Create Table users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('Satici','Musteri')NOT NULL,
    remember_token VARCHAR(255) DEFAULT NULL,
    reset_token VARCHAR(255) DEFAULT NULL,
    is_admin BOOLEAN DEFAULT 0
);

Create Table products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    price DECIMAL(10.2),
    image VARCHAR(255)
);

Create Table password_resets(
    id INT AUTO_INCREMENT PRIMARY KEY
    user_id INT NOT NULL,
    token VARCHAR(64) NOT NULL,
    suresi DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

