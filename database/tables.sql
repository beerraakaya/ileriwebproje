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
    aciklama TEXT,
    fiyat DECIMAL(10.2) NOT NULL,
    image VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE urunler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT,
    urun_adi VARCHAR(255),
    aciklama TEXT,
    fiyat DECIMAL(10,2),
    resim_yolu VARCHAR(255),
    eklenme_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

