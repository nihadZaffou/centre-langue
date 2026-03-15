// ============================================
//  EmploiDuTemps.cpp — Implémentation algo
// ============================================

#include "EmploiDuTemps.h"
#include <algorithm>
#include <iostream>
#include <sstream>

bool EmploiDuTemps::aUnConflit(const Emploi& nouveau) const {
    for (const auto& e : emplois) {
        if (e.estEnConflit(nouveau)) return true;
    }
    return false;
}

bool EmploiDuTemps::ajouterEmploi(const Emploi& emploi) {
    if (aUnConflit(emploi)) {
        std::cerr << "Conflit détecté pour l'emploi " << emploi.getId() << std::endl;
        return false;
    }
    emplois.push_back(emploi);
    planningParJour[emploi.getJour()].push_back(emploi);
    return true;
}

std::vector<Emploi> EmploiDuTemps::getPlanningProf(int idProf) const {
    std::vector<Emploi> result;
    for (const auto& e : emplois) {
        if (e.getIdProf() == idProf) result.push_back(e);
    }
    return result;
}

std::vector<Emploi> EmploiDuTemps::getPlanningGroupe(int idGroupe) const {
    std::vector<Emploi> result;
    for (const auto& e : emplois) {
        if (e.getIdGroupe() == idGroupe) result.push_back(e);
    }
    return result;
}

void EmploiDuTemps::trierEmplois() {
    // Trier par jour puis heure de début (std::sort + lambda)
    std::sort(emplois.begin(), emplois.end(), [](const Emploi& a, const Emploi& b) {
        if (a.getJour() != b.getJour()) return a.getJour() < b.getJour();
        return a.getHeureDebut() < b.getHeureDebut();
    });
}

void EmploiDuTemps::afficherTout() const {
    for (const auto& e : emplois) e.afficher();
}

// Export JSON simple pour communication avec PHP
std::string EmploiDuTemps::exporterJSON() const {
    std::ostringstream json;
    json << "[";
    for (size_t i = 0; i < emplois.size(); ++i) {
        const auto& e = emplois[i];
        json << "{\"id\":" << e.getId()
             << ",\"jour\":\"" << e.getJour() << "\""
             << ",\"debut\":\"" << e.getHeureDebut() << "\""
             << ",\"fin\":\"" << e.getHeureFin() << "\""
             << ",\"salle\":" << e.getSalle()
             << ",\"idProf\":" << e.getIdProf()
             << ",\"idGroupe\":" << e.getIdGroupe() << "}";
        if (i + 1 < emplois.size()) json << ",";
    }
    json << "]";
    return json.str();
}
