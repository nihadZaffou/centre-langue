// ============================================
//  TriEtudiant.h — Algorithmes de tri/recherche
//  OO : template, STL, fonctions statiques
// ============================================

#ifndef TRIETUDIANT_H
#define TRIETUDIANT_H

#include <vector>
#include <string>
#include <algorithm>

struct EtudiantSimple {
    int         id;
    std::string nom;
    std::string prenom;
    bool        admis;
    bool        paye;
};

class TriEtudiant {
public:
    // Tri alphabétique par nom (quicksort via std::sort)
    static void trierParNom(std::vector<EtudiantSimple>& etudiants);

    // Recherche binaire par id (liste triée)
    static int rechercherParId(const std::vector<EtudiantSimple>& etudiants, int id);

    // Filtrer les admis seulement
    static std::vector<EtudiantSimple> filtrerAdmis(const std::vector<EtudiantSimple>& etudiants);

    // Filtrer les non-payés (pour alertes)
    static std::vector<EtudiantSimple> filtrerNonPayes(const std::vector<EtudiantSimple>& etudiants);
};

#endif
