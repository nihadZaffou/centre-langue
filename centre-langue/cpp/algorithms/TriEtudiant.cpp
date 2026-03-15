// ============================================
//  TriEtudiant.cpp — Implémentation
// ============================================

#include "TriEtudiant.h"

void TriEtudiant::trierParNom(std::vector<EtudiantSimple>& etudiants) {
    std::sort(etudiants.begin(), etudiants.end(),
        [](const EtudiantSimple& a, const EtudiantSimple& b) {
            return a.nom < b.nom;
        });
}

int TriEtudiant::rechercherParId(const std::vector<EtudiantSimple>& etudiants, int id) {
    int gauche = 0, droite = (int)etudiants.size() - 1;
    while (gauche <= droite) {
        int milieu = (gauche + droite) / 2;
        if (etudiants[milieu].id == id)      return milieu;
        else if (etudiants[milieu].id < id)  gauche = milieu + 1;
        else                                  droite = milieu - 1;
    }
    return -1; // non trouvé
}

std::vector<EtudiantSimple> TriEtudiant::filtrerAdmis(const std::vector<EtudiantSimple>& etudiants) {
    std::vector<EtudiantSimple> result;
    std::copy_if(etudiants.begin(), etudiants.end(), std::back_inserter(result),
        [](const EtudiantSimple& e) { return e.admis; });
    return result;
}

std::vector<EtudiantSimple> TriEtudiant::filtrerNonPayes(const std::vector<EtudiantSimple>& etudiants) {
    std::vector<EtudiantSimple> result;
    std::copy_if(etudiants.begin(), etudiants.end(), std::back_inserter(result),
        [](const EtudiantSimple& e) { return !e.paye; });
    return result;
}
