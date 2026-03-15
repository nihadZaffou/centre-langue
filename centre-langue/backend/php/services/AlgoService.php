<?php
// ============================================
//  AlgoService.php — PHP appelle C++
//  Rôle : déléguer les algorithmes à C++
//  Communication : exec() avec JSON en argument
// ============================================

class AlgoService {

    // Chemin vers l'exécutable C++ compilé
    private string $executable = __DIR__ . '/../../../../cpp/build/emploi_du_temps';

    // Générer l'emploi du temps via l'algo C++
    public function genererEmploiDuTemps(array $profs, array $groupes): ?array {
        $jsonData   = json_encode(['profs' => $profs, 'groupes' => $groupes]);
        $jsonEscape = escapeshellarg($jsonData);

        $commande = "{$this->executable} {$jsonEscape} 2>&1";
        $output   = shell_exec($commande);

        // C++ retourne un JSON avec l'emploi du temps
        if ($output) {
            $result = json_decode(trim($output), true);
            return $result ?? null;
        }
        return null;
    }

    // Trier les étudiants par nom via C++
    public function trierEtudiants(array $etudiants): ?array {
        $jsonData   = json_encode($etudiants);
        $jsonEscape = escapeshellarg($jsonData);

        $commande = "{$this->executable} tri {$jsonEscape} 2>&1";
        $output   = shell_exec($commande);

        return $output ? json_decode(trim($output), true) : null;
    }
}
