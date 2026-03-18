-- ============================================
--  PROJET SYNTHESE - Centre de Langues
--  Base de données MySQL
-- ============================================

USE centrelangues;

-- TABLE UTILISATEUR (classe mère)
CREATE TABLE Utilisateur(
    id_utilisateur INT AUTO_INCREMENT,
    NomUser VARCHAR(50) NOT NULL,
    PrenomUser VARCHAR(50) NOT NULL,
    CinUser VARCHAR(50) UNIQUE,
    DateNaissanceUser DATE,
    TelephoneUser VARCHAR(15),
    EmailUser VARCHAR(100) UNIQUE NOT NULL,
    AdresseUser VARCHAR(100),
    PhotoUser VARCHAR(50),
    MotPassUser VARCHAR(255) NOT NULL,
    RoleUser VARCHAR(20) NOT NULL,
    DateCreationUser DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_utilisateur PRIMARY KEY (id_utilisateur)
);

CREATE TABLE Gerant(
    idGerant INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    CONSTRAINT fk_gerant_utilisateur FOREIGN KEY (idUser)
        REFERENCES Utilisateur(id_utilisateur)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);
CREATE TABLE Etudiant(
    idEtudiant INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    ParentNom VARCHAR(50),
    ParentPrenom VARCHAR(50),
    ParentTel VARCHAR(15),
    Paye TINYINT(1) DEFAULT 0,
    Admis TINYINT(1) DEFAULT 0,
    CONSTRAINT fk_etudiant_utilisateur FOREIGN KEY (idUser)
        REFERENCES Utilisateur(id_utilisateur)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Directeur(
    idDirecteur INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    CONSTRAINT fk_directeur_utilisateur FOREIGN KEY (idUser)
        REFERENCES Utilisateur(id_utilisateur)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Prof(
    idProf INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT NOT NULL,
    Specialite VARCHAR(50),
    CONSTRAINT fk_prof_utilisateur FOREIGN KEY (idUser)
        REFERENCES Utilisateur(id_utilisateur)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Langue(
    idLangue INT AUTO_INCREMENT,
    NomLangue VARCHAR(10) NOT NULL UNIQUE,
    CONSTRAINT pk_langue PRIMARY KEY (idLangue)
);

CREATE TABLE Niveau(
    idNiveau INT AUTO_INCREMENT,
    NomNiveau VARCHAR(10) NOT NULL UNIQUE,
    idLangue INT NOT NULL,
    CONSTRAINT pk_niveau PRIMARY KEY (idNiveau),
    CONSTRAINT fk_niveau_langue FOREIGN KEY (idLangue)
        REFERENCES Langue(idLangue) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Groupe(
    idGroupe INT AUTO_INCREMENT,
    NomGroupe VARCHAR(10) NOT NULL UNIQUE,
    Capacite INT CHECK (Capacite > 0),
    idNiveau INT NOT NULL,
    CONSTRAINT pk_groupe PRIMARY KEY (idGroupe),
    CONSTRAINT fk_groupe_niveau FOREIGN KEY (idNiveau)
        REFERENCES Niveau(idNiveau) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Annonce(
    idAnnonce INT AUTO_INCREMENT,
    TitreAnnonce VARCHAR(50) NOT NULL,
    MessageAnnonce VARCHAR(200) NOT NULL,
    DatePubAnnonce DATETIME DEFAULT CURRENT_TIMESTAMP,
    idGerant INT NOT NULL,
    CONSTRAINT pk_annonce PRIMARY KEY (idAnnonce),
    CONSTRAINT fk_Annonce_Gerant FOREIGN KEY (idGerant)
        REFERENCES Gerant(idGerant) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Annonce_Groupe(
    idGroupe INT NOT NULL,
    idAnnonce INT NOT NULL,
    CONSTRAINT pk_annonce_groupe PRIMARY KEY (idAnnonce, idGroupe),
    CONSTRAINT fk_annonce_groupe_annonce FOREIGN KEY (idAnnonce)
        REFERENCES Annonce(idAnnonce) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_annonce_groupe_groupe FOREIGN KEY (idGroupe)
        REFERENCES Groupe(idGroupe) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE AnnonceExamen(
    idAnnonceEx INT AUTO_INCREMENT,
    VilleExamen VARCHAR(20),
    DateExamen DATE,
    idAnnonce INT NOT NULL,
    CONSTRAINT pk_AnnonceExamen PRIMARY KEY (idAnnonceEx),
    CONSTRAINT fk_Annonce_AnnonceExamen FOREIGN KEY (idAnnonce)
        REFERENCES Annonce(idAnnonce) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Attestation(
    idAttestation INT AUTO_INCREMENT,
    ContenuAtt VARCHAR(200) NOT NULL,
    DateDemandeAtt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DateGenerationAtt DATETIME DEFAULT CURRENT_TIMESTAMP,
    StatutAtt VARCHAR(20) NOT NULL,
    idEtudiant INT NOT NULL,
    idNiveau INT NOT NULL,
    idGerant INT NOT NULL,
    CONSTRAINT pk_attestation PRIMARY KEY (idAttestation),
    CONSTRAINT fk_attestation_etudiant FOREIGN KEY (idEtudiant)
        REFERENCES Etudiant(idEtudiant) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_attestation_niveau FOREIGN KEY (idNiveau)
        REFERENCES Niveau(idNiveau) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_attestation_gerant FOREIGN KEY (idGerant)
        REFERENCES Gerant(idGerant) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Emploi(
    idEmploi INT AUTO_INCREMENT,
    Jour VARCHAR(20) NOT NULL,
    HeureDebut TIME NOT NULL,
    HeureFin TIME NOT NULL,
    Salle INT NOT NULL,
    idProf INT,
    idGroupe INT,
    CONSTRAINT pk_emploi PRIMARY KEY (idEmploi),
    CONSTRAINT fk_emploi_prof FOREIGN KEY (idProf)
        REFERENCES Prof(idProf) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT fk_emploi_groupe FOREIGN KEY (idGroupe)
        REFERENCES Groupe(idGroupe) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE Presence(
    idPresence INT AUTO_INCREMENT,
    DateSeance DATETIME NOT NULL,
    StatutPresence VARCHAR(50) NOT NULL,
    Justifier TINYINT(1) DEFAULT 0,
    idProf INT NOT NULL,
    idEtudiant INT NOT NULL,
    CONSTRAINT pk_presence PRIMARY KEY (idPresence),
    CONSTRAINT fk_prof_presence FOREIGN KEY (idProf)
        REFERENCES Prof(idProf) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_etudiant_presence FOREIGN KEY (idEtudiant)
        REFERENCES Etudiant(idEtudiant) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Alerte(
    idAlerte INT AUTO_INCREMENT PRIMARY KEY,
    DateAlerte DATETIME DEFAULT CURRENT_TIMESTAMP,
    TypeAlerte VARCHAR(50),
    idEtudiant INT NOT NULL,
    CONSTRAINT fk_etudiant_alerte FOREIGN KEY (idEtudiant)
        REFERENCES Etudiant(idEtudiant) ON UPDATE CASCADE ON DELETE CASCADE
);
