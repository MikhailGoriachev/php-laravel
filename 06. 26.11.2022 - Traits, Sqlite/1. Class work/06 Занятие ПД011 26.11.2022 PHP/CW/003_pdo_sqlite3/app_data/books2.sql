--
-- ���� ������������ � ������� SQLiteStudio v3.3.3 � �� ��� 28 10:05:31 2021
--
-- �������������� ��������� ������: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- �������: authors
DROP TABLE IF EXISTS authors;

CREATE TABLE authors (
    id   INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT    NOT NULL
);

INSERT INTO authors (id, name) VALUES (1, '����� �.');
INSERT INTO authors (id, name) VALUES (2, '���� ��.');
INSERT INTO authors (id, name) VALUES (3, '������� �.�.');
INSERT INTO authors (id, name) VALUES (4, '������ �.');
INSERT INTO authors (id, name) VALUES (5, '�������� �.�.');
INSERT INTO authors (id, name) VALUES (6, '�������� �.�.');
INSERT INTO authors (id, name) VALUES (7, '������ �.�.');

-- �������: books
DROP TABLE IF EXISTS books;

CREATE TABLE books (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    idAuthor   INTEGER REFERENCES authors (id) 
                       NOT NULL,
    idCategory INTEGER REFERENCES categories (id) ON UPDATE CASCADE,
    title      TEXT    NOT NULL,
    year       INTEGER CHECK (year > 0) 
                       NOT NULL,
    price      INTEGER CHECK (price > 0) 
                       NOT NULL,
    amount     INTEGER NOT NULL
                       CHECK (amount >= 0) 
                       DEFAULT (0) 
);

INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (1, 2, 1, '������������� ����������������', 2001, 150, 3);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (2, 3, 2, '�������� �� ����������������', 2005, 350, 2);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (3, 4, 3, '��� ��������������� �� Android', 2011, 520, 5);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (4, 5, 3, '��� ������ �� �����', 1988, 15, 2);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (5, 4, 1, '��� ��������������� �� C++', 1995, 590, 5);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (6, 6, 1, 'WPF - �������� � ����������', 2007, 890, 3);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (7, 7, 1, 'Android ��� ��������������', 2016, 510, 4);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (8, 4, 1, '��� ��������������� � C#.NET', 2009, 480, 2);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (9, 3, 2, '������� ����� �� LINQ', 2012, 390, 6);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (10, 5, 3, '� �������� ���� � �������', 2011, 35, 5);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (11, 1, 1, '������� ���� C++', 2010, 280, 2);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (12, 6, 1, 'WCF - ���������� ������������ ����������', 2012, 360, 3);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (13, 1, 1, '������ ����������� �� Java SE 8', 2014, 490, 3);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (14, 4, 1, '����������� �� ���������� ��� Android', 2016, 680, 2);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (15, 6, 2, '�������� ������ �� LINQ � ����������� �����', 2012, 350, 1);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (16, 4, 1, '������ �� Android ��� ��������������', 2016, 580, 2);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (19, 6, 2, '��������� �� Python 3.7', 2019, 410, 2);
INSERT INTO books (id, idAuthor, idCategory, title, year, price, amount) VALUES (25, 1, 1, '���������� �� PHP', 2012, 540, 2);

-- �������: borroweds
DROP TABLE IF EXISTS borroweds;

CREATE TABLE borroweds (
    id     INTEGER  PRIMARY KEY AUTOINCREMENT,
    idBook INTEGER  REFERENCES books (id) 
                    NOT NULL,
    borrow DATETIME NOT NULL,
    period INTEGER  NOT NULL
                    CHECK (period BETWEEN 1 AND 14) 
);

INSERT INTO borroweds (id, idBook, borrow, period) VALUES (1, 5, '2020-09-27', 5);
INSERT INTO borroweds (id, idBook, borrow, period) VALUES (2, 6, '2020-09-27', 14);

-- �������: categories
DROP TABLE IF EXISTS categories;

CREATE TABLE categories (
    id       INTEGER PRIMARY KEY AUTOINCREMENT,
    category TEXT    NOT NULL
);

INSERT INTO categories (id, category) VALUES (1, '�������');
INSERT INTO categories (id, category) VALUES (2, '��������');
INSERT INTO categories (id, category) VALUES (3, '����������');

-- �������: incomings
DROP TABLE IF EXISTS incomings;

CREATE TABLE incomings (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    idAuthor   INTEGER REFERENCES authors (id),
    idCategory INTEGER REFERENCES categories (id),
    title      TEXT    NOT NULL,
    income     DATE    NOT NULL
);

INSERT INTO incomings (id, idAuthor, idCategory, title, income) VALUES (1, 4, 3, '��� ������ �� ����� �����', '2019-09-14');
INSERT INTO incomings (id, idAuthor, idCategory, title, income) VALUES (2, 6, 1, '������ Python', '2019-08-27');
INSERT INTO incomings (id, idAuthor, idCategory, title, income) VALUES (3, 1, 2, '��������� C#', '2019-09-13');
INSERT INTO incomings (id, idAuthor, idCategory, title, income) VALUES (4, 6, 3, '��� ��������� Tango � Djano', '2019-07-01');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
