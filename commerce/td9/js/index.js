function detail(id_produit) {
	location = `detail.php?id_produit=${id_produit}`;
}
function redirection(id_categorie){
        location = `editer.php?id_categorie=${id_categorie}`;
 }
function editerProduit(evt,id_produit){
        evt.stopPropagation();
        location = `editer.php?id_produit=${id_produit}`;
   }     
