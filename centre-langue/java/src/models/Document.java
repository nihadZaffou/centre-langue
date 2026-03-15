// ============================================
//  Document.java — Classe abstraite (Java)
//  Rôle : classe mère de tous les documents générés
//  OO   : classe abstraite, polymorphisme
// ============================================

package models;

import java.time.LocalDateTime;

public abstract class Document {
    // Attributs communs à tout document
    protected int           id;
    protected String        contenu;
    protected LocalDateTime dateGeneration;
    protected String        statut;

    // Constructeur
    public Document(int id, String contenu) {
        this.id             = id;
        this.contenu        = contenu;
        this.dateGeneration = LocalDateTime.now();
        this.statut         = "EN_ATTENTE";
    }

    // Getters
    public int    getId()             { return id; }
    public String getContenu()        { return contenu; }
    public String getStatut()         { return statut; }
    public void   setStatut(String s) { this.statut = s; }

    // Méthode abstraite : chaque document sait comment se générer
    public abstract String generer();

    // Méthode commune : valider le document
    public boolean valider() {
        if (contenu == null || contenu.isEmpty()) return false;
        this.statut = "VALIDE";
        return true;
    }

    @Override
    public String toString() {
        return "Document{id=" + id + ", statut=" + statut + "}";
    }
}
