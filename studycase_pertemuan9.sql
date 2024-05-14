CREATE TABLE `users` (
  `user_id` INT PRIMARY KEY AUTO_INCREMENT,
  `nama` VARCHAR(255),
  `email` VARCHAR(255),
  `password` VARCHAR(255)
);

CREATE TABLE `divisi` (
  `divisi_id` INT PRIMARY KEY AUTO_INCREMENT,
  `kepala_divisi_id` INT,
  `nama_divisi` VARCHAR(255)
);

CREATE TABLE `admin` (
  `admin_id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT
);

CREATE TABLE `karyawan` (
  `karyawan_id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT,
  `divisi_id` INT
);

CREATE TABLE `ketua_divisi` (
  `ketua_id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT,
  `divisi_id` INT
);

ALTER TABLE `divisi` ADD FOREIGN KEY (`kepala_divisi_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `admin` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `karyawan` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `karyawan` ADD FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`divisi_id`);

ALTER TABLE `ketua_divisi` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

ALTER TABLE `ketua_divisi` ADD FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`divisi_id`);
