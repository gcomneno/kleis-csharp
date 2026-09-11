CREATE TABLE autori (
    autore_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE generi (
    genere_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE brani (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(150) NOT NULL,
    autore_id INT NOT NULL,
    genere_id INT NULL,
    durata_minuti DECIMAL(4,2) NULL,
    anno INT NULL,
    prezzo DECIMAL(6,2) NOT NULL DEFAULT 0.99,
    CONSTRAINT fk_brani_autori
        FOREIGN KEY (autore_id) REFERENCES autori(autore_id),
    CONSTRAINT fk_brani_generi
        FOREIGN KEY (genere_id) REFERENCES generi(genere_id)
) ENGINE=InnoDB;

CREATE TABLE carrello (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_brano INT NOT NULL,
    sessionid VARCHAR(128) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_carrello_brani
        FOREIGN KEY (id_brano) REFERENCES brani(id)
        ON DELETE CASCADE,
    INDEX idx_carrello_sessionid (sessionid)
) ENGINE=InnoDB;
