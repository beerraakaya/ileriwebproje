Create Table users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('kullanici','musteri')NOT NULL,
    remember_token VARCHAR(255) DEFAULT NULL,
    reser_token VARCHAR(255) DEFAULT NULL,
    is_admin BOOLEAN DEFAULT 0
);

Create Table products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    price DECIMAL(10.2),
    image VARCHAR(255)
);

