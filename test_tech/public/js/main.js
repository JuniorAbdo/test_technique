

$(document).ready(function(){
  //specifier badge de coleur pour chaque type de statut
    $('.statut').each(function() {
      if($(this).text().trim()=="CLIENT"){
        $(this).css('background-color','#45F15A');
      }
      if($(this).text().trim()=="LEAD"){
        $(this).css('background-color','#50B1F7');
      }
      if($(this).text().trim()=="PROSPECT"){
        $(this).css('background-color','#F59C70');
      }
      
  });
  //afficher le modal pour confirmer la suppression ou l'annuler
  $('.delete_contact').on('click',function(e){
    e.preventDefault();
    let contact_id=$(this).val();
    $('#id_deleted').val(contact_id);
     $('#supprimer-contact').modal('show');
    console.log(contact_id);
});

});