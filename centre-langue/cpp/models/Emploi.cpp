// ============================================
//  Emploi.cpp — Implémentation de Emploi
// ============================================

#include "Emploi.h"
#include <iostream>

Emploi::Emploi(int id, const std::string& jour, const std::string& debut,
               const std::string& fin, int salle, int idProf, int idGroupe)
    : idEmploi(id), jour(jour), heureDebut(debut), heureFin(fin),
      salle(salle), idProf(idProf), idGroupe(idGroupe) {}

int         Emploi::getId()         const { return idEmploi; }
std::string Emploi::getJour()       const { return jour; }
std::string Emploi::getHeureDebut() const { return heureDebut; }
std::string Emploi::getHeureFin()   const { return heureFin; }
int         Emploi::getSalle()      const { return salle; }
int         Emploi::getIdProf()     const { return idProf; }
int         Emploi::getIdGroupe()   const { return idGroupe; }

void Emploi::setSalle(int s) { salle = s; }
void Emploi::setJour(const std::string& j) { jour = j; }

// Deux emplois sont en conflit si : même jour, même salle, heures qui se chevauchent
bool Emploi::estEnConflit(const Emploi& autre) const {
    if (jour != autre.jour || salle != autre.salle) return false;
    // Chevauchement : début1 < fin2 ET début2 < fin1
    return (heureDebut < autre.heureFin) && (autre.heureDebut < heureFin);
}

void Emploi::afficher() const {
    std::cout << "[Emploi " << idEmploi << "] "
              << jour << " " << heureDebut << "-" << heureFin
              << " | Salle " << salle
              << " | Prof " << idProf
              << " | Groupe " << idGroupe << std::endl;
}
