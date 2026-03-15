// ============================================
//  EtudiantView.js — Vue liste des étudiants
//  Rôle : afficher et interagir avec les étudiants
// ============================================

export async function render() {
    const app = document.getElementById("app");
    app.innerHTML = "<p>Chargement...</p>";

    const etudiants = await window.apiFetch("etudiants");

    app.innerHTML = `
        <h2>Étudiants</h2>
        <button onclick="afficherFormulaireAjout()">+ Ajouter</button>
        <table id="table-etudiants">
            <thead>
                <tr>
                    <th>ID</th><th>Nom</th><th>Prénom</th>
                    <th>Email</th><th>Payé</th><th>Admis</th>
                </tr>
            </thead>
            <tbody>
                ${etudiants.map(e => `
                    <tr>
                        <td>${e.id_utilisateur}</td>
                        <td>${e.NomUser}</td>
                        <td>${e.PrenomUser}</td>
                        <td>${e.EmailUser}</td>
                        <td>${e.Paye ? '✅' : '❌'}</td>
                        <td>${e.Admis ? '✅' : '❌'}</td>
                    </tr>
                `).join('')}
            </tbody>
        </table>
    `;
}
