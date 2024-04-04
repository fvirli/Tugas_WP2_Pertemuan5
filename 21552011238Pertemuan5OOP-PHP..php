<?php

//Firli Setiani
//21552011238

class Book {
    private $judul;
    private $penulis;
    private $tahunTerbit;
    private $statusPinjam;

    public function __construct($judul, $penulis, $tahunTerbit) {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahunTerbit = $tahunTerbit;
        $this->statusPinjam = false;
    }

    public function getJudul() {
        return $this->judul;
    }

    public function getPenulis() {
        return $this->penulis;
    }

    public function getTahun() {
        return $this->tahunTerbit;
    }

    public function pinjam() {
        $this->statusPinjam = true;
    }

    public function mengembalikanBuku() {
        $this->statusPinjam = false;
    }

    public function getStatusPinjam() {
        return $this->statusPinjam;
    }

    public function displayInfo() {
        echo "Judul: " . $this->judul . ", Penulis: " . $this->penulis . ", Tahun Terbit: " . $this->tahunTerbit;
    }

    public function __toString() {
        return "Judul: " . $this->judul . ", Penulis: " . $this->penulis . ", Tahun Terbit: " . $this->tahunTerbit . ", Status: " . ($this->getStatusPinjam() ? "Terpinjam" : "Tersedia");
    }
}

class Library {
    private $books;
    private static $totalBooks = 0;

    public function __construct() {
        $this->books = [];
    }

    public function tambahBuku(Book $book) {
        $this->books[] = $book;
        self::$totalBooks++;
    }

    public function pinjamBuku($judul) {
        foreach ($this->books as $book) {
            if ($book->getJudul() == $judul && !$book->getStatusPinjam()) {
                $book->pinjam();
                return true;
            }
        }
        return false;
    }

    public function mengembalikanBuku($judul) {
        foreach ($this->books as $book) {
            if ($book->getJudul() == $judul && $book->getStatusPinjam()) {
                $book->mengembalikanBuku();
                return true;
            }
        }
        return false;
    }

    public function printBukuTersedia() {
        foreach ($this->books as $book) {
            if (!$book->getStatusPinjam()) {
                echo $book . "\n";
            }
        }
    }

    public function getTotalBooks() {
        return self::$totalBooks;
    }
}

// class turunan dari book
class EBook extends Book {
    private $format;

    public function __construct($judul, $penulis, $tahun, $format) {
        parent::__construct($judul, $penulis, $tahun);
        $this->format = $format;
    }

    public function getFormat() {
        return $this->format;
    }

    public function displayInfo() {
        parent::displayInfo();
        echo ", Format: " . $this->format;
    }
}

// class turunan dari book
class AudioBook extends Book {
    private $narator;

    public function __construct($judul, $penulis, $tahun, $narator) {
        parent::__construct($judul, $penulis, $tahun);
        $this->narator = $narator;
    }

    public function getNarator() {
        return $this->narator;
    }

    public function displayInfo() {
        parent::displayInfo();
        echo ", Narator: " . $this->narator;
    }
}

$library = new Library(); // Menambahkan objek perpustakaan

$book1 = new Book("The Alchemist", "Paulo Coelho", 1988);  // Menambahkan buku ke perpustakaan
$ebook1 = new EBook("Demian", "Hermann Hesse", 1919, "PDF");  // Menambahkan e-book ke perpustakaan
$audiobook1 = new AudioBook("1984", "George Orwell", 1949, "Simon Prebble");  // Menambahkan audio book ke perpustakaan

$library->tambahBuku($book1);
$library->tambahBuku($ebook1);
$library->tambahBuku($audiobook1);

$library->pinjamBuku("The Alchemist");  // Meminjam buku

echo "Buku yang Tersedia:\n";
$library->printBukuTersedia(); // Mencetak daftar buku yang tersedia

$library->mengembalikanBuku("The Alchemist"); // Mengembalikan buku

echo "\nBuku yang Tersedia setelah Pengembalian:\n";
$library->printBukuTersedia(); // Mencetak daftar buku yang tersedia setelah pengembalian

echo "\nTotal Buku di Perpustakaan: " . $library->getTotalBooks(); // Menampilkan jumlah total buku
