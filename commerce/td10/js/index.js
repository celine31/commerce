function detail(id_produit) {
    location = `detail.php?id_produit=${id_produit}`;
}
function redirection(id_categorie) {
    location = `editer.php?id_categorie=${id_categorie}`;
}
function editerProduit(evt, id_produit) {
    evt.stopPropagation();
    location = `editer.php?id_produit=${id_produit}`;
}
function supprimerProduit(evt, id_produit) {
    evt.stopPropagation();
    if (confirm("êtes vous d’accord")) {
        location = `supprimer.php?id_produit=${id_produit}`;
    } else {
        location = `index.php?`;
    }
}       