# [Sistem Absensi - Nusabot](https://nusabot.id)

**Nusabot Absensi** adalah sistem absensi gratis yang dapat diterapkan untuk berbagai kepentingan absensi seperti pabrik, toko, kantor, dan sebagainya. Sistem ini termasuk manajemen absensi dan mesin absensi yang dapat dipelajari oleh siapapun.
Sistem ini dibuat tanpa framework dan menggunakan bahasa struktural sehingga mudah dipelajari oleh pemula.

Proyek ini adalah bagian dari proyek **Nusabot FOSS** sebagai wujud kepedulian Nusabot terhadap pendidikan teknologi di Indonesia yang bertujuan untuk membuat dan mengembangkan proyek-proyek *open source*  yang memiliki kualitas baik sehingga dapat diterapkan secara real di industri sekaligus dapat dipelajari oleh seluruh masyarakat Indonesia. 

**Demo di [http://absensi.nusabot.id](https://absensi.nusabot.id/)**
Nomor Induk: *123*
Password: *123*

Untuk *source code* dan skematik dapat mengunjungi repo berikut:
https://github.com/lorenzadam/NusabotMesinAbsensi

## Fitur Nusabot Absensi

Nusabot Absensi memiliki fitur yang tidak dimiliki mesin absensi pada umumnya dan sistem ini adalah sistem **IoT Based** data yang direkam oleh mesin dikirimkan melalui jaringan internet secara realtime sehingga memungkinkan integrasi data dan pengolahan data secara terpusat dan dapat diakses darimana saja.

!["HomePage"](https://nusabot.id/wp-content/uploads/2021/08/Screenshot-2021-08-06-at-10-37-00-Absensi-Nusabot.png "HomePage")

!["RekapWiku"](https://nusabot.id/wp-content/uploads/2021/08/Screenshot-2021-08-06-at-10-39-12-Absensi-Nusabot.png "RekapWiku")

!["RekapLaporan"](https://nusabot.id/wp-content/uploads/2021/08/Screenshot-2021-08-06-at-10-39-25-Absensi-Nusabot.png "RekapLaporan")

- Web based sehingga aplikasi bisa dibuka dari perangkat apapun.
- Perhitungan keterlambatan absensi (Masuk, Istirahat, Pulang).
- Multi cabang / gedung ataupun sistem shift.
- Absensi merekam MAC Address dari alat absen sehingga tidak dapat melakukan absen menggunakan alat yang belum didaftarkan ke sistem.
- Pembagian zona waktu Indonesia (WIB, WITA, WIT).
- Absensi melalui RFID (bisa dikembangkan menggunakan media lain), source code dan skematik disediakan.
- Absen masuk, mulai istirahat, selesai istirahat, dan pulang.
- Dapat digunakan secara gratis tanpa perlu izin.
- Pelaporan absensi secara realtime, dapat memilih rentang waktu.
- Pengembangan menggunakan bahasa struktural tanpa framework agar mudah dipelajari bagi pemula.

## Instalasi
Aplikasi ini membutuhkan sebuah komputer yang dijadikan sebagai server (spesifikasi rendah pun tidak masalah sama sekali) yang sudah terpasang Web Server, PHP, dan MySQL / MariaDB. Anda dapat menggunakan [XAMPP](https://www.apachefriends.org/download.html "XAMPP") untuk mempermudah instalasi dan pengembangan.
Note: XAMPP hanya digunakan untuk pengembangan, tidak direkomendasikan jika ingin digunakan untuk *production use* atau di tingkat industri.

Pada langkah ini akan dijelaskan instalasi sistem menggunakan XAMPP:
1. Unduh rilis stabil Nusabot Absensi dari laman https://github.com/lorenzadam/NusabotAbsensi/releases (jangan unduh repo nya karena bukan versi stable).
2. Buat folder baru di dalam folder htdocs dari XAMPP.
3. Ekstrak file zip yang sudah diunduh tadi ke dalam folder yang baru dibuat.
4. Buat database baru, bisa gunakan **PHPMyAdmin** yang sudah disediakan XAMPP.
5. Impor database kedalam database yang baru saja dibuat, file impor berada di **/db/absensi.sql**
6. Ubah pengaturan koneksi basis data pada file **/etc/config.php**, sesuaikan dengan pengaturan XAMPP Anda (pengaturan default yang dibuat oleh Nusabot Absensi adalah pengaturan default untuk XAMPP, Anda hanya perlu mengubah `$databaseName`menjadi nama basis data yang sudah Anda buat).
7. Ubah juga pengaturan koneksi basis data untuk melakukan absensi dari mesin pada file **machine.php**.
8. Buka app melalui web browser dan login menggunakan:
Nomor Induk: *0*
Password: *Nusabotid123*
9. Tambahkan pengguna baru, nomor induk 0 adalah pengguna kunci yang tidak bisa dihapus oleh karena itu Anda harus mengganti password nya.

## Dukungan Web Browser

| [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/edge/edge_48x48.png" alt="IE / Edge" width="24px" height="24px" />](http://godban.github.io/browsers-support-badges/)<br/>IE / Edge | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/firefox/firefox_48x48.png" alt="Firefox" width="24px" height="24px" />](http://godban.github.io/browsers-support-badges/)<br/>Firefox | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/chrome/chrome_48x48.png" alt="Chrome" width="24px" height="24px" />](http://godban.github.io/browsers-support-badges/)<br/>Chrome | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/safari/safari_48x48.png" alt="Safari" width="24px" height="24px" />](http://godban.github.io/browsers-support-badges/)<br/>Safari | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/safari-ios/safari-ios_48x48.png" alt="iOS Safari" width="24px" height="24px" />](http://godban.github.io/browsers-support-badges/)<br/>iOS Safari | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/samsung-internet/samsung-internet_48x48.png" alt="Samsung" width="24px" height="24px" />](http://godban.github.io/browsers-support-badges/)<br/>Samsung | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/opera/opera_48x48.png" alt="Opera" width="24px" height="24px" />](http://godban.github.io/browsers-support-badges/)<br/>Opera | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/vivaldi/vivaldi_48x48.png" alt="Vivaldi" width="24px" height="24px" />](http://godban.github.io/browsers-support-badges/)<br/>Vivaldi | [<img src="https://raw.githubusercontent.com/alrra/browser-logos/master/src/electron/electron_48x48.png" alt="Electron" width="24px" height="24px" />](http://godban.github.io/browsers-support-badges/)<br/>Electron |
| --------- | --------- | --------- | --------- | --------- | --------- | --------- | --------- | --------- |
| IE10, IE11, Edge| 2 versi terakhir| 2 versi terakhir| 2 versi terakhir| 2 versi terakhir| l2 versi terakhir| 2 versi terakhir| 2 versi terakhir| 2 versi terakhir

## Request Fitur Baru dan Pelaporan Bug
Anda dapat meminta fitur baru maupun melaporkan bug melalui menu **issues** yang sudah disediakan oleh GitHub (lihat menu di atas), posting issues baru dan kita akan berdiskusi disana.

## Berkontribusi

Siapapun dapat berkontribusi pada proyek ini mulai dari pemrograman, pembuakan buku manual, sampai dengan mengenalkan produk ini kepada masyarakat Indonesia agar mengurangi kesenjangan pendidikan teknologi dengan cara membuat postingan issue di repository ini.

## Terimakasih Kepada Para Kontributor
- Nusabot
- Wiku

# Lisensi

Nusabot Absensi dilisensikan diatas **[Creative Common BY-NC-SA](https://creativecommons.org/licenses/by-nc-sa/4.0/deed.id "Creative Common BY-NC-SA")** dimana Anda diperbolehkan:
- **Berbagi** - Menyalin dan menyebarluaskan kembali produk ini dalam bentuk format apapun
- **Adaptasi** - Menggubah, mengubah, dan membuat turunan dari proyek ini.

### Berdasarkan ketentuan berikut:

- **Atribusi** - Anda harus mencantumkan nama pencipta dan para kontributor serta mencantumkan tautan lisensi **CC BY-NC-SA** (tautan sudah ada di *footer* pada aplikasi).
- **NonKomersial** - Anda tidak dapat menggunakan produk ini untuk kepentingan komersial (yaitu penggunaan yang ditujukan untuk memperoleh keuntungan komersial atau kompensasi dalam bentuk uang), kecuali jika Anda menjadikan produk ini untuk bahan ajar atau memberikan pelatihan penggunaan produk dan Anda menerima upah.
- **Berbagi Serupa** - Apabila Anda menggubah, mengubah, atau membuat turunan dari proyek ini, Anda harus menyebarluaskan kontribusi Anda dibawah lisensi yang sama dengan produk ini

Anda tidak dapat menggunakan ketentuan hukum yang secara hukum membatasi orang lain untuk melakukan hal-hal yang diizinkan oleh lisensi CC BY-NC-SA.

Bagi Anda yang ingin melakukan komersialisasi pada proyek ini dapat menghubungi Nusabot untuk mendapatkan lisensi ekslusif.
