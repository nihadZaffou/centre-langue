// ============================================
//  AttestationService.java — Service principal
//  Rôle : orchestrer la génération d'attestation
//  Point d'entrée appelé par PHP via exec()
// ============================================

package services;

import models.Attestation;
import org.json.JSONObject;

public class AttestationService {

    // Générer une attestation à partir d'un JSON reçu en argument
    public String generer(String jsonInput) {
        JSONObject data = new JSONObject(jsonInput);

        Attestation att = new Attestation(
            data.getInt("id"),
            data.getInt("idEtudiant"),
            data.getString("nomEtudiant"),
            data.getString("prenomEtudiant"),
            data.getString("nomNiveau"),
            data.getString("nomLangue")
        );

        if (att.valider()) {
            return att.generer(); // retourne le chemin du PDF
        }
        return "ERREUR: attestation invalide";
    }
}
