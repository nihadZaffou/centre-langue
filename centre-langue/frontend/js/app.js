// ============================================
//  app.js — Point d'entrée du frontend
//  Rôle : router les vues selon l'URL
// ============================================

const API_BASE = "http://localhost/centre-langue/backend/php";

// Router simple
const routes = {
    "#etudiants"    : () => import('./views/EtudiantView.js').then(m => m.render()),
    "#groupes"      : () => import('./views/GroupeView.js').then(m => m.render()),
    "#emploi"       : () => import('./views/EmploiView.js').then(m => m.render()),
    "#annonces"     : () => import('./views/AnnonceView.js').then(m => m.render()),
    "#attestations" : () => import('./views/AttestationView.js').then(m => m.render()),
};

function naviguer() {
    const hash = window.location.hash || "#etudiants";
    const vue  = routes[hash];
    if (vue) vue();
}

window.addEventListener("hashchange", naviguer);
window.addEventListener("load", naviguer);

// Utilitaire global : appel API
window.apiFetch = async (endpoint, methode = "GET", body = null) => {
    const options = {
        method  : methode,
        headers : { "Content-Type": "application/json" },
    };
    if (body) options.body = JSON.stringify(body);
    const resp = await fetch(`${API_BASE}/${endpoint}`, options);
    return resp.json();
};
