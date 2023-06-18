

# kang-parkir
Website ini dibuat Untuk Menamatkan Matkul Pemrograman Lanjut 

## Fitur Website
List fitur dari aplikasi ini adalah sebagai berikut: 
1.  Tampilan aplikasi terkait dengan parkir motor.
2.  Database MySQL untuk menyimpan dan mengelola data.
3.  Terdapat halaman login dengan dua hak akses yaitu admin dan user.
4.  Terdapat berbagai hak admin, yaitu:
	-	Admin dapat mengelola hak akses admin dan user.
	-	Admin dapat memasukkan nomor plat motor saat masuk parkir dan menentukan lokasi parkir.
3.  Hak akses user terbuat secara otomatis saat nomor plat motor dimasukkan oleh admin.
4.  Sistem menyediakan informasi lokasi parkir yang tersedia dan jumlah parkir yang tersedia.
5.  Admin dapat melihat data grafik jumlah motor yang parkir secara periodik.
5.  Fitur grafik (column chart) untuk visualisasi jumlah motor parkir.
6.  User dapat melihat lokasi motornya dan mengubah username dan password.
7.  Fitur pencarian untuk mencari informasi terkait nomor plat motor atau data lainnya.
8.  Fitur laporan untuk menghasilkan laporan berdasarkan data parkir motor.
9.  Fitur dark dan light mode.

## Struktur Folder

**Kang-Parkir**
-   **admin** (Tempat halaman utama admin dan laporan)
-   **api** (Tempat file yang menghandle logic AJAX)
-   **components** (Tempat folder dan file komponen HTML yang digunakan pada project)
	-   **admin**
	-   **konten-dialog**
-   **db** (Tempat file SQL dan koneksi database MySQL pada PHP)
	-   **sql**
-   **lib** (Tempat file yang menghandle form action dan query ke database)
	-   **action**
	-   **histori-parkiran**
	-   **motor**
	-   **parkiran**
	-   **user**
-   **public** (Tempat file yang bisa diakses publik seperti gambar dan file Javascript)
	-   **img**
	-   **js**

## Menjalankan Project Di Komputer Anda
Untuk menjalankan secara lokal, anda membutuhkan:
- XAMPP versi 8.x.x
- Text editor seperti VSCode, Sublime Text, Neovim, atau yang lain.
- Browser modern seperti Chrome, Edge, Firefox, atau yang lain. 

Kemudian jika sudah mendownload folder ini, anda harus meletakkannya di folder `HTDOCS` atau tempat lain anda meletakkan project PHP.

Selanjutnya anda bisa membuat database baru pada PHPMyAdmin, lalu melakukan import SQL yang terdapat pada folder `db/sql` dan pilih file SQL `parkiran-dua-x.sql`  dengan nomor terbesar.

Jika sudah anda bisa pergi ke http://localhost/parkiran-dua dan pada halaman login anda bisa masuk sebagai admin menggunakan:

> **![](https://lh4.googleusercontent.com/qm1EAnnp3ExNI_iRMT5qUDRvsb707TXKyp1pXWFFVONlnWGgOLIJmqmUR5WkDLc7O9KcsL2Gn3YbobjB6E_SfHC_bCumEWy4V_Y3dhAjDCAgXhBiBdwG9r3i3tHtDWGO0sSglUIN0Jy6YZ8d_qFVlpc)**
> 
> Username: admin dan Password: admin

## Preview Halaman Pada Website

> **![](https://lh5.googleusercontent.com/ggoA9MMiNChNrL0rBHbs0V6ij-FbvDgnZpBrEHLwP_tnqbi5Io81veFjyvl0jrVET2N9xA64rD9kFe8mte_6EXPmfxoraC5df74nYRjsMRvyZjPLMjDxdHnwx0P3IC00n7bAIyiiFyMebm7p_bZ9K9g)**
> Halaman Utama Admin

> **![](https://lh4.googleusercontent.com/zo2YxQoR0XSCbRINBRsCSUzS2zrOjW2eOrHFIZGU1_q0GyX2jJUqj00jwItfcvgOBn_Qb3R-c7dxHeqtZutJIolWksOlrw7xWb--C_i_jTM_f7moRuahCy09JCF3T8UXxDZzT9djO4F78AG-2d7J56I)**
> Halaman Laporan Admin

> **![](https://lh3.googleusercontent.com/Tky99i4g_rwGrkqQDZee8scbsRx7o8xgsPeOUk_nMmoXkKaYKgM_Aa1vTBIggmngp-ZwgLWShus7Z0fi7gh7j_5VNISM4SfpKsFg93Ss5rVmYXggk8LW5wvamiFY2Ev46lZWs7bTH8iDOPjsCz0dlLM)**
> Halaman Utama User

> **![](https://lh5.googleusercontent.com/hf3k6rzl0880RIb4txtogWKGMFaEhYV1bHjzpYud_T8hU0fnltXS9bTPMJgpnxyp3WajEKG1JzpF-UITaRtf9nLuEmQQpJhiYv3jKTqRveaJZfTEYMKcZ8GgsFI6dfLw7P7tWdNyUSiWkhG88oYwLNo)**
> Halaman Pengaturan User
