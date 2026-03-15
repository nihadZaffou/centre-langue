// ============================================
//  EmploiDuTemps.h — Algorithme de planification
//  OO : classe, STL (vector, map), templates
// ============================================

#ifndef EMPLOIDUTEMPS_H
#define EMPLOIDUTEMPS_H

#include <vector>
#include <map>
#include <string>
#include "../models/Emploi.h"

class EmploiDuTemps {
private:
    std::vector<Emploi>                        emplois;
    std::map<std::string, std::vector<Emploi>> planningParJour;

    // Vérifier les conflits avant d'ajouter
    bool aUnConflit(const Emploi& nouveau) const;

public:
    EmploiDuTemps() = default;

    // Ajouter un créneau (vérifie les conflits)
    bool ajouterEmploi(const Emploi& emploi);

    // Obtenir le planning d'un prof
    std::vector<Emploi> getPlanningProf(int idProf) const;

    // Obtenir le planning d'un groupe
    std::vector<Emploi> getPlanningGroupe(int idGroupe) const;

    // Trier les emplois par jour puis heure
    void trierEmplois();

    // Afficher tout le planning
    void afficherTout() const;

    // Exporter en JSON (pour PHP)
    std::string exporterJSON() const;
};

#endif
