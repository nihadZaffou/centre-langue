// ============================================
//  Main.java — Point d'entrée du programme Java
//  Appelé par PHP : java -jar attestation.jar '{"id":1,...}'
// ============================================

import services.AttestationService;

public class Main {
    public static void main(String[] args) {
        if (args.length == 0) {
            System.err.println("Usage: java -jar attestation.jar '<json>'");
            System.exit(1);
        }

        String jsonInput = args[0];
        AttestationService service = new AttestationService();
        String resultat = service.generer(jsonInput);

        // Afficher le résultat → PHP le récupère via shell_exec()
        System.out.println(resultat);
    }
}
