# Product Requirements Document (PRD)

## Aplikasi Pencatatan Keuangan Pribadi (Personal Use - PWA)

---

## 1. Overview

Aplikasi ini adalah **Progressive Web App (PWA)** untuk pencatatan keuangan pribadi yang digunakan secara individual. Fokus utama adalah **kecepatan input, kemudahan penggunaan, dan penyimpanan data yang aman serta sinkron (near real-time)**.

Aplikasi tidak ditujukan untuk publik atau distribusi melalui App Store / Play Store.

Platform:

* Web (desktop & mobile browser)
* Installable sebagai PWA (Android & iOS)

Teknologi utama:

* Backend: Laravel (REST API)
* Frontend: React + Tailwind CSS (di folder fe-moneylog sudah say install reactnya menggunakan typescript)
* Mode: PWA (Progressive Web App)

---

## 2. Goals

### Primary Goals

* Memudahkan pencatatan transaksi harian dengan cepat
* Menyimpan data secara aman dan terstruktur
* Menyediakan sinkronisasi data antar device (HP & desktop)

### Secondary Goals

* Tampilan sederhana dan nyaman digunakan setiap hari
* Bisa diakses tanpa install dari store
* Mendukung penggunaan semi-offline

---

## 3. Target Users

* Pengguna tunggal (self-use)
* Developer (owner aplikasi)
* Tidak untuk multi-user publik

---

## 4. Core Features (MVP)

### 4.1 Transaction Management

User dapat:

* Menambahkan transaksi
* Mengedit transaksi
* Menghapus transaksi
* Melihat daftar transaksi

Field transaksi:

* Nominal (amount)
* Keterangan (description)
* Kategori
* Sumber dana (account)
* Tanggal
* Tipe (income / expense)

---

### 4.2 Categories

* Daftar kategori default (Makanan, Transport, dll)
* Tambah / edit / hapus kategori

---

### 4.3 Accounts (Sumber Dana)

Contoh:

* Cash
* Bank (Debit)
* E-wallet / QRIS

User dapat:

* Menambah akun
* Mengedit akun
* Menghapus akun

---

### 4.4 Dashboard

Menampilkan:

* Total pengeluaran bulan berjalan
* Total pemasukan
* Ringkasan sederhana per kategori
* List transaksi terbaru

---

### 4.5 Transaction History

* Daftar transaksi lengkap
* Filter berdasarkan:

  * Tanggal
  * Kategori
  * Akun

---

## 5. Realtime Behavior

### Target:

* Data langsung terlihat setelah ditambahkan
* Sinkron antar device dalam waktu singkat

### Implementasi:

* Client melakukan re-fetch data setelah perubahan
* Optional: polling setiap beberapa detik

Catatan:

* Tidak menggunakan WebSocket (overkill untuk personal use)

---

## 6. Offline & Data Persistence

### Minimal Requirement:

* Data tetap bisa dilihat saat offline (cache)

### Optional Enhancement:

* Simpan transaksi sementara di local (IndexedDB)
* Sync ke server saat online kembali

---

## 7. User Flow

### 7.1 Tambah Transaksi

1. User membuka app
2. Klik tombol "+"
3. Input nominal (prioritas utama)
4. Pilih tipe (income / expense)
5. Pilih kategori
6. Pilih akun
7. Isi keterangan (optional)
8. Pilih tanggal
9. Simpan

---

### 7.2 Dashboard View

* Langsung tampil saat app dibuka
* Menampilkan ringkasan bulan berjalan

---

### 7.3 Filter Transaksi

* User memilih filter
* Data diperbarui secara langsung

---

## 8. System Architecture

### 8.1 High-Level Architecture

```id="arch-pwa"
[ React PWA ]
      ↓
[ Laravel API ]
      ↓
[ Database ]
```

---

### 8.2 Data Flow

1. User input → React
2. React → API Laravel
3. Laravel → Database
4. Response → UI update

---

## 9. Database Design (Simplified)

### 9.1 Transactions

* id
* amount
* description
* category_id
* account_id
* type (income/expense)
* date
* created_at

---

### 9.2 Categories

* id
* name
* type

---

### 9.3 Accounts

* id
* name
* type

---

## 10. API Design (Simplified)

### Transactions

* GET /transactions
* POST /transactions
* PUT /transactions/{id}
* DELETE /transactions/{id}

### Categories

* GET /categories
* POST /categories

### Accounts

* GET /accounts
* POST /accounts

---

## 11. UI/UX Design & Theme

### 11.1 Color Palette

Tema utama:

* **Biru muda (sky blue)** + putih

#### Colors:

* Primary: `#4FC3F7`
* Secondary: `#81D4FA`
* Background: `#FFFFFF`
* Surface: `#F5F7FA`
* Text: `#333333`

---

### 11.2 Design Principles

* Clean & minimal
* Fokus pada angka (nominal)
* Input cepat (low friction)
* Mobile-first design
* Banyak whitespace

---

### 11.3 Component Guidelines

* AppBar: biru muda
* Button utama: biru
* Card: putih + shadow ringan
* Icon: simple (outline)

---

## 12. PWA Requirements

* manifest.json
* service worker
* installable ke home screen
* offline caching (basic)

---

## 13. Non-Functional Requirements

### Performance

* Load cepat (<2 detik)
* API response cepat (<500ms)

### Security

* Basic protection (optional auth)
* Sanitasi input

### Reliability

* Data tidak hilang
* Database stabil

---

## 14. Tech Stack Detail

### Backend

* Laravel
* REST API
* MySQL / PostgreSQL

### Frontend

* React (Vite)
* Tailwind CSS
* PWA plugin

---

## 15. Development Roadmap

### Phase 1 (MVP)

* CRUD transaksi
* kategori
* akun
* UI basic
* PWA setup

### Phase 2

* dashboard
* filter
* caching

### Phase 3

* offline sync
* export data

---

## 16. Risks & Considerations

* PWA di iOS memiliki keterbatasan
* Offline sync membutuhkan handling tambahan
* UX sangat menentukan kenyamanan penggunaan

---

## 17. Success Criteria

* Aplikasi digunakan secara rutin (daily use)
* Input transaksi cepat (<5 detik per entry)
* Data selalu tersimpan dengan benar

---

## 18. Future Enhancements

* Grafik pengeluaran
* Budgeting
* Notifikasi pengingat
* Multi device sync yang lebih optimal

---

END OF DOCUMENT
