// ============================================
//  main.cpp — Point d'entrée C++
//  Appelé par PHP : ./emploi_du_temps '<json>'
// ============================================

#include <iostream>
#include <string>
#include "algorithms/EmploiDuTemps.h"
#include "algorithms/TriEtudiant.h"

int main(int argc, char* argv[]) {
    if (argc < 2) {
        std::cerr << "Usage: ./emploi_du_temps '<json>'" << std::endl;
        return 1;
    }

    std::string action  = argv[1];
    std::string jsonInput = (argc >= 3) ? argv[2] : argv[1];

    if (action == "tri") {
        // TODO : parser JSON, trier, retourner JSON
        std::cout << "[]" << std::endl;
    } else {
        // Génération emploi du temps
        EmploiDuTemps edt;
        // TODO : parser JSON input, créer emplois, générer
        std::cout << edt.exporterJSON() << std::endl;
    }

    return 0;
}
