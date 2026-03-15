// ============================================
//  Emploi.h — Déclaration de la classe Emploi
//  Correspond à la table Emploi (SQL)
//  OO : classe, encapsulation, getters/setters
// ============================================

#ifndef EMPLOI_H
#define EMPLOI_H

#include <string>

class Emploi {
private:
    int         idEmploi;
    std::string jour;
    std::string heureDebut;
    std::string heureFin;
    int         salle;
    int         idProf;
    int         idGroupe;

public:
    // Constructeur
    Emploi(int id, const std::string& jour, const std::string& debut,
           const std::string& fin, int salle, int idProf, int idGroupe);

    // Getters
    int         getId()         const;
    std::string getJour()       const;
    std::string getHeureDebut() const;
    std::string getHeureFin()   const;
    int         getSalle()      const;
    int         getIdProf()     const;
    int         getIdGroupe()   const;

    // Setters
    void setSalle(int s);
    void setJour(const std::string& j);

    // Vérifier si deux emplois sont en conflit (même salle, même heure)
    bool estEnConflit(const Emploi& autre) const;

    // Afficher l'emploi
    void afficher() const;
};

#endif
