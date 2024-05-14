CREATE TABLE `role` (
  `role_id` int PRIMARY KEY,
  `name` varchar(20)
);

CREATE TABLE `user` (
  `user_id` int PRIMARY KEY,
  `role_id` int,
  `nama_lengkap` varchar(100),
  `no_hp` varchar(20) UNIQUE,
  `email` varchar(100) UNIQUE,
  `password` varchar(10)
);

CREATE TABLE `produk` (
  `produk_id` int PRIMARY KEY,
  `user_id` int,
  `nama` varchar(255),
  `harga` int,
  `stok` int DEFAULT 1
);

CREATE TABLE `transaksi` (
  `transaksi_id` int PRIMARY KEY,
  `user_id` int,
  `produk_id` int,
  `quantity` int DEFAULT 1,
  `tanggal` timestamp DEFAULT (now())
);

CREATE TABLE `divisi` (
  `divisi_id` int,
  `kepala_divisi_id` int,
  `user_id` int,
  `admin` boolean,
  `primary` key(divisi_id,user_id)
);

ALTER TABLE `divisi` ADD FOREIGN KEY (`divisi_id`) REFERENCES `role` (`role_id`);

ALTER TABLE `user` ADD FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

ALTER TABLE `produk` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `transaksi` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `transaksi` ADD FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`);
