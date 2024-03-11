-- CREATE DATABASE db_eleves_tmp CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;  -- >mysql 8.0
-- CREATE DATABASE db_eleves_tmp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;  -- <mysql 8.0
DROP DATABASE if exists db_bases;
CREATE DATABASE db_bases CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci; -- >mariadb 10
use db_bases;

CREATE TABLE info (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  libelle varchar(100) NOT NULL,
  commentaire varchar(50) DEFAULT NULL,
  numero float DEFAULT NULL,
  datecreation datetime NOT NULL DEFAULT current_timestamp(),
  datemodification datetime NOT NULL DEFAULT current_timestamp()
);

INSERT INTO info (id, libelle, commentaire, numero, datecreation, datemodification) VALUES
(1, 'libelle 1', 'commentaire 1', 1, '2024-03-05 18:03:50', '2024-03-03 20:00:00');
INSERT INTO info (id, libelle, commentaire, numero) VALUES
(2, 'libelle 2', NULL, 2.5),
(3, 'libelle 3', NULL, null);

ALTER TABLE info
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
