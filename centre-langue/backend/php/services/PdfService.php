<?php
// ============================================
//  PdfService.php — PHP appelle Java
//  Rôle : déléguer la génération PDF à Java
//  Communication : exec() avec JSON en argument
// ============================================

class PdfService {

    // Chemin vers le JAR Java compilé
    private string $javaJar = __DIR__ . '/../../../../java/dist/attestation.jar';

    // Générer une attestation PDF via Java
    public function genererAttestation(array $data): ?string {
        // Préparer les données en JSON pour Java
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        $jsonEscape = escapeshellarg($jsonData);

        // Appel Java : java -jar attestation.jar '{"nom":"Ali",...}'
        $commande = "java -jar {$this->javaJar} {$jsonEscape} 2>&1";
        $output = shell_exec($commande);

        // Java retourne le chemin du PDF généré
        if ($output && file_exists(trim($output))) {
            return trim($output); // chemin vers le PDF
        }
        return null;
    }
}
