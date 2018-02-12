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
/*function supprimerProduit(evt, id_produit) {
 evt.stopPropagation();
 if (confirm("vous êtes sûr de vouloir supprimer")) {
 new AjaxPromise('supprimer.php')
 .send({id_produit: id_produit})
 .then(reponse => {
 reponse === 1 ? evt.target.parentElement.parentElement.style.display = 'none' : location.reload();
 });
 }
 }
 */
// version avec async function
async function supprimerProduit(evt, id_produit) {
    evt.stopPropagation();
    if (confirm("vous êtes sûr de vouloir supprimer")) {
        var reponse = await new AjaxPromise('supprimer.php').send({id_produit: id_produit});
        reponse === 1 ? evt.target.parentElement.parentElement.style.display = 'none' : location.reload();
    }
}
