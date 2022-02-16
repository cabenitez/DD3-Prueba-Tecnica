$(document).ready(function () {

        getProperties();

        $('.change_page').click(function(){
            getProperties($(this).attr("pag"));
        });

        $('#filter-cost').on('keyup', function(e) {
            if (e.keyCode === 13) {
                getProperties();
            }
        });

        if ($('#property_name').length) {
            getProperty();
        }

});


function getProperties(page=1){

    // loader
    $('#properties-list').html('<div class="text-center "><span class="alert alert-success" role="alert">Buscando Propiedades...</span></div>');

    let cost = $('#filter-cost').val() != '' ? $('#filter-cost').val() : null;

    // ajax request
    $.ajax({
      method: "GET",
      url: "/properties",
      data: { page: page, cost: cost }
    })
    .done(function(response) {
        
        if (response.data.length > 0) {

            // init elements
            $('#properties-list').html('');
            
            // iterator
            let properties = response.data;

            // propiedades
            $.each( properties, function( key, property ) {

                let card = createCard(property);

                // append element to list
                $('#properties-list').append(card);
            });

            //paginador
            $('.pager').show();

            $('#pager_rows').html(response.per_page);
            $('#pager_from').html(response.from);
            $('#pager_to').html(response.to);
            $('#pager_total').html(response.total);
          
            if (response.current_page > 1) {
                $('#pager_prev').attr('pag',response.current_page - 1);
                $('#pager_prev').show();
            }else{
                $('#pager_prev').hide();  
            }

            if (response.current_page < response.last_page) {
                $('#pager_next').attr('pag',response.current_page + 1);
                $('#pager_next').show();
            }else{
                $('#pager_next').hide();  
            }

        }else{

            $('#properties-list').html('<div class="text-center mt-5 "><span class="alert alert-warning" role="alert">No existen Propiedades</span></div>');

        }
        
    });
    
}

function createCard(property) {
    return '<div class="property-item col-md-2">'+
                '<a href="/property/'+property.name+'">'+
                    '<img class="image" src="'+property.src+'" alt="image">'+
                    '<h3 class="name">'+property.name+'</h3>'+
                    '<div class="features">'+
                        '<span class="bed">'+
                            '<img src="/imgs/ico_bed.png" alt="bed">'+
                            '<h6 class="bed_value">'+property.bedrooms+'</h6>'+
                        '</span>'+
                        '<span class="bath">'+
                            '<img src="/imgs/ico_bath.png" alt="bath">'+
                            '<h6 class="bath_value">'+property.bathroom+'</h6>'+
                        '</span>'+
                        '<span class="slot">'+
                            '<img src="/imgs/ico_slot.png" alt="slot">'+
                            '<h6 class="slot_value">'+property.slot+'</h6>'+
                        '</span>'+
                    '</div>'+
                '</a>'                       
            '</div>';
}

function getProperty(){

    // loader
    $('#property-detail').html('<div class="text-center "><span class="alert alert-success" role="alert">Obteniendo información de la Propiedad</span></div>');

    // ajax request
    $.ajax({
      method: "GET",
      url: "/properties",
      data: { name: $('#property_name').val() }
    })
    .done(function(response) {
        
        if (response.data.length > 0) {
            
            // iterator
            let properties = response.data;

            // propiedades
            $.each( properties, function( key, property ) {

                let card = createCardDetail(property);

                // append element to list
                $('#property-list').html(card);
                $('#property-cost').html('$'+property.cost.toFixed(3));
            });
            
        }else{

            $('#properties-detail').html('<div class="text-center mt-5 "><span class="alert alert-warning" role="alert">No se encontró la Propiedad</span></div>');

        }

        
    });
}

function createCardDetail(property) {
        return '<div class="property-detail col-md-2">'+
                    
                        '<img class="image" src="'+property.src+'" alt="image">'+
                        
                        '<div class="property-item-detail">'+
                            '<h5>Detalle</h5>'+
                            '<div class="features">'+
                                '<span class="bed">'+
                                    '<img src="/imgs/ico_bed.png" alt="bed">'+
                                    '<h6 class="bed_value">'+property.bedrooms+'</h6>'+
                                '</span>'+
                                '<span class="bath">'+
                                    '<img src="/imgs/ico_bath.png" alt="bath">'+
                                    '<h6 class="bath_value">'+property.bathroom+'</h6>'+
                                '</span>'+
                                '<span class="slot">'+
                                    '<img src="/imgs/ico_slot.png" alt="slot">'+
                                    '<h6 class="slot_value">'+property.slot+'</h6>'+
                                '</span>'+
                                '<span class="gar">'+
                                    '<img src="/imgs/ico_gar.png" alt="gar">'+
                                    '<h6 class="gar_value">'+1+'</h6>'+
                                '</span>'+
                                '<span class="date">'+
                                    '<img src="/imgs/ico_date.png" alt="date">'+
                                    '<h6 class="date_value">'+property.year+'</h6>'+
                                '</span>'+
                            '</div>'+
                        '</div>'+
                                          
                '</div>';
    }