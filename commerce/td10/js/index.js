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
    if (confirm("vous êtes sûr de vouloir supprimer")) {
        new AjaxPromise('supprimer.php')
                .send({id_produit : id_produit})
                .then(reponse => {
                    reponse = parseInt(reponse);
                    if (reponse !== false) {
                        evt.target.parentElement.parentElement.style.display = 'none';
                    }
                })
                .catch(erreur => console.log(`ERREUR : ${erreur}`));
    }
}