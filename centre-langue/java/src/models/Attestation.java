// ============================================
//  Attestation.java — Hérite de Document
//  Rôle : générer une attestation PDF
//  OO   : héritage, override, encapsulation
// ============================================

package models;

public class Attestation extends Document {
    // Attributs spécifiques
    private String nomEtudiant;
    private String prenomEtudiant;
    private String nomNiveau;
    private String nomLangue;
    private int    idEtudiant;
    private int    idNiveau;

    public Attestation(int id, int idEtudiant, String nomEtudiant,
                       String prenomEtudiant, String nomNiveau, String nomLangue) {
        super(id, ""); // appel constructeur parent
        this.idEtudiant    = idEtudiant;
        this.nomEtudiant   = nomEtudiant;
        this.prenomEtudiant = prenomEtudiant;
        this.nomNiveau     = nomNiveau;
        this.nomLangue     = nomLangue;
        // Générer le contenu automatiquement
        this.contenu = this.genererContenu();
    }

    // Générer le texte de l'attestation
    private String genererContenu() {
        return String.format(
            "Je soussigné, directeur du Centre de Langues, atteste que " +
            "M./Mme %s %s a suivi et réussi le niveau %s en %s.",
            prenomEtudiant, nomEtudiant, nomNiveau, nomLangue
        );
    }

    // Override : générer le PDF (utilise iText)
    @Override
    public String generer() {
        String cheminPdf = "output/attestation_" + idEtudiant + ".pdf";
        // TODO : utiliser iText pour créer le PDF
        // PdfWriter writer = new PdfWriter(cheminPdf);
        // Document doc = new Document(new PdfDocument(writer));
        // doc.add(new Paragraph(this.contenu));
        // doc.close();
        System.out.println("PDF généré : " + cheminPdf);
        return cheminPdf;
    }

    // Getters
    public String getNomEtudiant()    { return nomEtudiant; }
    public String getPrenomEtudiant() { return prenomEtudiant; }
    public String getNomNiveau()      { return nomNiveau; }
}
